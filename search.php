<?php
include "header.php";
include "cities.php";
include 'db_connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL & ~E_NOTICE);
?>

<div class="col-lg-12">
    <h4>Enter data in the fields</h4>
</div>

<div class="col-lg-12">
    <div class="row">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off"
            class="col-lg-4">
            <div class="form-group ">
                <label for="formGroupExampleInput">Search</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="search" placeholder="Search"
                    value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ?>">
            </div>
            <div class="aditional-parameters ">
                <label for="inlineFormInputGroup">Min price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="minPrice" placeholder="Min"
                        value="<?php echo isset($_POST['minPrice']) ? $_POST['minPrice'] : '' ?>">
                </div>
                <label for="inputMax">Max price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="inputMax" name="maxPrice" placeholder="Max"
                        value="<?php echo isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '' ?>">
                </div>
                <div class="form-group ">
                    <label for="inputMake">Make and model</label>
                    <input type="text" class="form-control" id="inputMake" name="make" placeholder="Make / model"
                        value="<?php echo isset($_POST['make']) ? $_POST['make'] : '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <button class="btn btn-primary btn-big" name="trySearch">Try search</button>
                    <button class="btn btn-primary save-search btn-big" name="saveSearch">Save search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

if (isset($_POST['trySearch']) && !empty($_POST['search'])) {
    $links = array(
        'min_price' => !empty($_POST['minPrice']) ? trim($_POST['minPrice']) : null,
        'max_price' => !empty($_POST['maxPrice']) ? trim($_POST['maxPrice']) : null,
        'auto_make_model' => !empty($_POST['make']) ? trim($_POST['make']) : null,
    );
    new ParallelGet($cities, $_POST['search'], http_build_query($links));
    ebay($_POST['search'], $_POST['minPrice'], $_POST['maxPrice'], $_POST['make']);
}

if (isset($_POST['saveSearch']) && !empty($_POST['search'])) {
    saveSearch($_POST);
}

function saveSearch($data)
{
    $conn = OpenCon();

    $search = $_POST['search'];
    $minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : "";
    $maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : "";
    $model = isset($_POST['make']) ? $_POST['make'] : "";
    $time = time();

    $sql = "INSERT INTO saved_search (searchField,minPrice,maxPrice,model,dateCreated,isActive) VALUES ('$search', '$minPrice','$maxPrice','$model',$time,1)";

    if (mysqli_query($conn, $sql)) {
        echo "Search saved! ";

    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    CloseCon($conn);
}

class ParallelGet
{
    //$cities get from cities.php
    public function __construct($cities, $searchString, $link)
    {
        $searchString = preg_replace('/\s+/', '+', $searchString);
        if (strlen($searchString) != 0) {
            // Create get requests for each URL
            $mh = curl_multi_init();
            //$searchString = preg_replace('/\s+/', '+', $searchString);
            foreach ($cities as $i => $url) {
                if (empty($link)) {
                    $ch[$i] = curl_init("https://$url.craigslist.org/search/cta?query=$searchString&sort=rel&format=rss&postedToday=1");
                } else {
                    $ch[$i] = curl_init("https://$url.craigslist.org/search/cta?query=$searchString&sort=rel&format=rss&postedToday=1&$link");
                }

                curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch[$i], CURLOPT_HEADER, 0);

                curl_multi_add_handle($mh, $ch[$i]);
            }

            // Start performing the request
            do {
                $execReturnValue = curl_multi_exec($mh, $runningHandles);
            } while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);

            // Loop and continue processing the request
            while ($runningHandles && $execReturnValue == CURLM_OK) {
                // !!!!! changed this if and the next do-while !!!!!

                if (curl_multi_select($mh) != -1) {
                    usleep(100);
                }

                do {
                    $execReturnValue = curl_multi_exec($mh, $runningHandles);
                } while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);
            }

            // Check for any errors
            if ($execReturnValue != CURLM_OK) {
                trigger_error("Curl multi read error $execReturnValue\n", E_USER_WARNING);
            }

            // Extract the content
            foreach ($cities as $i => $url) {
                // Check for errors
                $curlError = curl_error($ch[$i]);

                if ($curlError == "") {
                    $responseContent = curl_multi_getcontent($ch[$i]);
                    //echo count($responseContent);
                    $res[$i] = new SimpleXMLElement($responseContent, LIBXML_NOCDATA);

                } else {
                    print "Curl error on handle $i: $curlError\n";
                }
                // Remove and close the handle
                curl_multi_remove_handle($mh, $ch[$i]);
                curl_close($ch[$i]);
            }

            // Clean up the curl_multi handle
            curl_multi_close($mh);

            $data = array();

            foreach ($res as $key => $value) {

                $value = $value->item;
                foreach ($value as $k => $v) {
                    $image_url = $v->xpath('enc:enclosure/@resource');
                    $data[] = array(
                        'title' => $v->title,
                        'link' => $v->link,
                        'image' => $image_url,
                    );
                }
            }

            $json_string = json_encode($data);
            $result_array = json_decode($json_string, true);

            printTable($result_array);
        }
    }
}

function printTable($data)
{
    $filepath = './img/default.png';
    echo "<a href='#ebay' style='width:100%'>scroll to eBay results</a>";
    echo "<h4 class='result-block'>Craigslist results:</h4>";
    $output = "";
    foreach ($data as $key => $value) {
        $image = $value['image'][0]['@attributes']['resource'];
        if (empty($value['image'][0])) {
            $image = $filepath;

        }
        $price = substr($value['title'][0], strpos($value['title'][0], "&#x0024;"));
        $link = $value['link'][0];
        $title = $value['title'][0];

        $output .="<div class='block-result'>";
        $output .="<div>";
        $output .="<img width='150' src=\"$image\"/>";
        $output .="</div>";
        $output .="<div class='title'>";
        $output .= "<a href='$link'>$title</a>";
        $output .="<div class='price-section'>Price: <span class='price'>$price</span></div>";
        $output .="<div class='price-section'>Link: <a href='$link' class='link'>$link</a></div>";
        $output .= "</div>";
        $output .= "</div>";
    }

    echo $output;
    if (empty($data)) {
        echo "<h4 class='result-block'>&nbsp;No results! Please change search settings</h4><div class='serp'></div>";
    }
}

############################EBAY#####################EBAY############################EBAY###################################

function ebay($query, $minPrice, $maxPrice, $make)
{
    $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';
    $filterarray = array();
    if (!empty($maxPrice)) {
        array_push($filterarray, array(
            'name' => 'MaxPrice',
            'value' => $maxPrice,
            'paramName' => 'Currency',
            'paramValue' => 'USD'));
    }
    if (!empty($minPrice)) {
        array_push($filterarray, array(
            'name' => 'MinPrice',
            'value' => $minPrice,
            'paramName' => 'Currency',
            'paramValue' => 'USD',
        ));
    }

    $filter = buildItemFilter($filterarray);
    $query = empty($make) ? $query : $query . " " . $make;

    $resp = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query, $filter));

    ebayPrintTable($resp);

}

function ebayPrintTable($resp)
{
    echo "<h4 class='result-block e-bay' id='ebay'>eBay results:</h4>";
    if ($resp->ack == "Success") {
        $results = '';

        foreach ($resp->searchResult->item as $item) {
            $pic = $item->galleryURL;
            $link = $item->viewItemURL;
            $title = $item->title;
            $price = $item->sellingStatus->currentPrice;
        
        
            $results .="<div class='block-result'>";
            $results .="<div>";
            $results .="<img width='150' src=\"$pic\"/>";
            $results .="</div>";
            $results .="<div class='title'>";
            $results .= "<a href='$link'>$title</a>";
            $results .="<div class='price-section'>Price: <span class='price'>$price $</span></div>";
            $results .="<div class='price-section'>Link: <a href='$link' class='link'>$link</a></div>";
            $results .= "</div>";
            $results .= "</div>";
        }
        //print_r($results);
        if(!empty($results)){
            echo $results;
        }
        else{
            echo "<h4 class='result-block'>&nbsp;No results! Please change search settings</h4><div class='serp'></div>";
        }
    }
    else{
       echo "<h4>Try again later</h4>";
    }
}
        
    
function buildItemFilter($filterarray)
{
    global $xmlfilter;
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

    return "$xmlfilter";
}

function constructPostCallAndGetResponse($endpoint, $query, $itemFilter)
{
    global $xmlrequest;

    $xmlrequest = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xmlrequest .= "<findItemsAdvancedRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
    $xmlrequest .= "<categoryId>\n";
        $xmlrequest .= "6001\n";
        $xmlrequest .= "</categoryId>\n";
    $xmlrequest .= "<keywords>";
        $xmlrequest .= $query;
        $xmlrequest .= "</keywords>\n";
    $xmlrequest .= $itemFilter;
    $xmlrequest .= "<sortOrder>\n";
        $xmlrequest .= "StartTimeNewest\n";
        $xmlrequest .= "</sortOrder>\n";
    $xmlrequest .= "<paginationInput>\n <entriesPerPage>50</entriesPerPage>\n</paginationInput>\n";
    $xmlrequest .= "</findItemsAdvancedRequest>";

$headers = array(
'X-EBAY-SOA-OPERATION-NAME: findItemsAdvanced',
'X-EBAY-SOA-SERVICE-VERSION: 1.3.0',
'X-EBAY-SOA-REQUEST-DATA-FORMAT: XML',
'X-EBAY-SOA-GLOBAL-ID: EBAY-US',
'X-EBAY-SOA-SECURITY-APPNAME:AntonChi-searchbo-PRD-b1979435f-f39f128b',
'Content-Type: text/xml;charset=utf-8',
);
$url= "http://www.ebay.com/marketplace/search/v1/services";
$session = curl_init($endpoint);
curl_setopt($session, CURLOPT_POST, true);
curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($session, CURLOPT_POSTFIELDS, $xmlrequest);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

if(curl_exec($session) === false)
{
echo curl_error($session);
}

$responsexml = curl_exec($session);
curl_close($session);

return $responsexml;
}

include "./footer.php";
?>