<?php
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
function sendEmail($data)
{

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com.'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'searchingbotcraiglist@gmail.com'; // SMTP username
        $mail->Password = 'xc3pdvpdv'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('searchingbotcraiglist@gmail.com', 'Mailer');
        $mail->addAddress('searchingbotcraiglist@gmail.com', 'Joe User'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New search result';

        $createMessage = '<html><head></head><body><p><b>Search results:</b></p>';
        //print_r($data);
        // foreach ($data as $value) {
        //     $createMessage .= '<div style="width:50%">' . $value['title'] . '</div>';
        //     $createMessage .= '<div >' . $value['link'] . '</div>';
        //     $createMessage .= '<div style="border-bottom:1px solid #lightgrey;margin-bottom:10px;padding-bottom:5px;"><b>Price:&nbsp;</b>' . $value['price'] . '</div>';
        // }
        $createMessage .= '</body></html>';
        $mail->Body = $data;

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}