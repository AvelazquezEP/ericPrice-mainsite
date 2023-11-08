<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT");

try {

    $name = $_POST['FirstName'];
    $lasName = $_POST['LastName'];
    $email = $_POST['Email'];
    $mobile = $_POST['MobilePhone'];
    $language = $_POST['Language'];
    $leadID = $_POST['leadID'];
    $question = $_POST['question'];    

    if(empty($question)){
        $question = "-";
    }
    
    $sendEmail = sendEmail($language, $email, $name, $lasName, $mobile, $question, $leadID);
    
    echo $sendEmail;
} catch (Exception $ex) {
    echo "****Email Error****";
}

function sendEmail($language, $email, $name, $lastName, $number, $question, $leadID)
{            
    $mail = new PHPMailer(true);

    $message = file_get_contents('mailTemplate.html');
    $message = str_replace('%language%', $language, $message);
    $message = str_replace('%email%', $email, $message);
    $message = str_replace('%name%', $name, $message);
    $message = str_replace('%lastName%', $lastName, $message);
    $message = str_replace('%mobile%', $number, $message);
    $message = str_replace('%message%', $question, $message);
    $message = str_replace('%leadID%', $leadID, $message);

    if($leadID == "" || $leadID == null || $leadID == undefined) {
        $leadID = 'This lead may already have an account with us';
        $message = str_replace('%duplicate%','This lead may already have an account with us', $message);
    } else {
        $message = str_replace('%duplicate%','-', $message);
    }
    
    //  $mail->SMTPDebug = SMTP::DEBUG_SERVER; <-- show the process when try to send the email and print all steps the serves need to make
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'support56@abogadoericprice.com';
    $mail->Password = 'M3xicali56';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('no-reply@abogadoericprice.com', 'No Reply');
    
    // All emails to send the Lead notification
    $mail->addAddress('no-reply@abogadoericprice.com');
    $mail->addReplyTo('no-reply@abogadoericprice.com', 'No Reply');
    
    // Main emails to send notification
    $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    $mail->addAddress('fmartinez@greencardla.com', 'Floriberta Martinez');
    $mail->addAddress('support56@abogadoericprice.com', 'Paola Carolina');
    $mail->addCC('rterrazas@greencardla.com', 'Robert Terrazas');
    $mail->addCC('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Martinez');
    
    $mail->Encoding = 'base64';
    $mail->CharSet = "UTF-8";

    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to contact form web site';
    $mail->msgHTML($message); 
    $mail->AltBody = 'Sending email';
    $mail->send();
}

function cleanData($val)
{
    return pg_escape_string($val);
}
