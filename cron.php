<?php

include 'db_connect.php';
include "cities.php";
include 'mail.php';
ini_set('display_errors', 1);

$findData = array();
$emailData = array();
$mail = "";
//$cities get from cities.php
function Search($cities, $link)
{
    if (!empty($link)) {
        $mh = curl_multi_init();
        $aCurlHandles = array();
        foreach ($link as $l) {
            $l = http_build_query($l);
            foreach ($cities as $i => $url) {
                $ch[] = ("https://$url.craigslist.org/search/cta?&sort=rel&postedToday=1&format=rss&$l");
            }
        }

        $aCurlHandles[] = $ch;

        foreach ($aCurlHandles[0] as $id => $data) {
            $ch = curl_init($data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_multi_add_handle($mh, $ch);
            $aCurlHandles[0][$id] = $ch;
        }

        $active = null;
        //execute the handles
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }
        foreach ($aCurlHandles[0] as $i => $ch) {
            $curlError = curl_error($ch);
            $html = curl_multi_getcontent($ch); // get the content
            // do what you want with the HTML
            $res[$i] = new SimpleXMLElement($html, LIBXML_NOCDATA);

            //$res[$i] = new SimpleXMLElement($html);
            curl_multi_remove_handle($mh, $ch); // remove the handle (assuming  you are done with it);
        }
    }

    global $mail;
    $mail .= "<h2><b>Craigslist result:</b></h2>";
    foreach ($res as $key => $value) {
        $value = $value->item;
        foreach ($value as $k => $v) {
            $dcDate = $v->xpath('//dc:date');
            $image_url = $v->xpath('enc:enclosure/@resource');
            $time = strtotime(date("y-m-d\TH:i:s", time()));
            $price = substr($v->title, strpos($v->title, "&#x0024;"));
            
            $mail .= "<div style='width:100%'>$v->title</div>";
            $mail .= "<div><b>Price:&nbsp;</b>$price</div>";
            $mail .= "<div style='border-bottom:1px solid #lightgrey;margin-bottom:15px;padding-bottom:5px;'>$v->link</div>";
        }
    }

    ebay($link);
    curl_multi_close($mh);
}

$city = $cities;

function startCron($city)
{
    $conn = OpenCon();
    $sql = "SELECT * FROM saved_search";
    $result = $conn->query($sql);
    $links = array();
    if ($result->num_rows > 0) {
        $num_rows = $result->num_rows;
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $i++;
            $links[] = array(
                "query" => $row['searchField'],
                'min_price' => strlen($row['minPrice']) != 0 ? trim($row['minPrice']) : null,
                'max_price' => strlen($row['maxPrice']) != 0 ? trim($row['maxPrice']) : null,
                'auto_make_model' => strlen($row['model']) != 0 ? trim($row['model']) : null,
            );
        }
        Search($city, $links);
    }
    CloseCon($conn);
}

startCron($city);

############################EBAY#####################EBAY############################EBAY###################################

function ebay($links){
    if (!empty($links)) {
        $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';
        $aCurlHandles = array();
        $mh = curl_init();
        global $xmlrequest;
        global $mail;
        $mail .="<h2><b>ebay Results:</b></h2>";

    
    $headers = array(
    'X-EBAY-SOA-OPERATION-NAME: findItemsAdvanced',
    'X-EBAY-SOA-SERVICE-VERSION: 1.3.0',
    'X-EBAY-SOA-REQUEST-DATA-FORMAT: XML',
    'X-EBAY-SOA-GLOBAL-ID: EBAY-US',
    'X-EBAY-SOA-SECURITY-APPNAME:AntonChi-searchbo-PRD-b1979435f-f39f128b',
    'Content-Type: text/xml;charset=utf-8',
    );
       
        foreach ($links as $l) {
            $make = $l['auto_make_model'];
            $filterarray = array();
            

           
            if (!empty($l['max_price'])) {
                array_push($filterarray, array(
                    'name' => 'MaxPrice',
                    'value' => $l['max_price'],
                    'paramName' => 'Currency',
                    'paramValue' => 'USD'));
            }
            if (!empty($l['min_price'])) {
                array_push($filterarray, array(
                    'name' => 'MinPrice',
                    'value' => $l['min_price'],
                    'paramName' => 'Currency',
                    'paramValue' => 'USD',
                ));
            }
            global $xmlfilter;
            $xmlfilter = '';
            foreach ($filterarray as $itemfilter) {
              
                $xmlfilter .= "<itemFilter>\n";
                foreach ($itemfilter as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $arrayval) {
                            $xmlfilter .= " <$key>$arrayval</$key>\n";
                        }
                    } else {
                        if ($value != "") {
                            $xmlfilter .= " <$key>$value</$key>\n";
                        }
                    }
                }
                $xmlfilter .= "</itemFilter>\n";
            }
            $query = empty($make) ? $l['query'] : $l['query'] . " " . $make;
            echo $query;
            $xmlrequest = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xmlrequest .= "<findItemsAdvancedRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
    $xmlrequest .= "<categoryId>\n";
        $xmlrequest .= "6001\n";
        $xmlrequest .= "</categoryId>\n";
    $xmlrequest .= "<keywords>";
        $xmlrequest .= $l['query'];
        $xmlrequest .= "</keywords>\n";
    $xmlrequest .= $xmlfilter;
    $xmlrequest .= "<sortOrder>\n";
        $xmlrequest .= "StartTimeNewest\n";
        $xmlrequest .= "</sortOrder>\n";
    $xmlrequest .= "<paginationInput>\n <entriesPerPage>20</entriesPerPage>\n</paginationInput>\n";
    $xmlrequest .= "</findItemsAdvancedRequest>";

?>
<?php
            $ch = curl_init($endpoint);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlrequest);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


            $responsexml = curl_exec($ch);
            $responsexml = simplexml_load_string($responsexml);
            curl_close($ch);

            if ($responsexml->ack == "Success") {
                global $mail;
                foreach ($responsexml->searchResult->item as $item) {
                    $pic = $item->galleryURL;
                    $link = $item->viewItemURL;
                    $title = $item->title;
                    $price = $item->sellingStatus->currentPrice;

                    $mail .= "<div style='width:100%'>$title</div>";
                    $mail .= "<div><b>Price:&nbsp;</b>$price</div>";
                    $mail .= "<div style='border-bottom:1px solid #lightgrey;margin-bottom:15px;padding-bottom:5px;'>$link</div>";
                }
            }
        }
    }

    global $mail;
    sendEmail($mail);
}