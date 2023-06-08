<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

try {
    $firstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $mobile_phone = $_POST['MobilePhone'];
    $location_name = $_POST['Location__c'];
    $Language_site = $_POST['Language__c'];
    $sms_option = $_POST['SMS_Opt_In__c'];
    $comments = $_POST['comments'];

    $response =  createLeadApi( $firstName, $LastName, $Email, $mobile_phone, $location_name, $Language_site, $sms_option);
    // sendEmail($language_site, $Email, $firstName, $lastName, $mobile_phone, $comments);    
    // var_dump($response);

    echo $response;
} catch (Exception $e) {
    header("Location: https://abogadoericprice.com/sorry.html");    // <--- show this site when something is wrong    
}

// FUNCTIONS SECTIONS
function createLeadApi($first_name, $last_name, $email, $mobile_phone, $location_name, $language_site, $sms_option) {

    $Token = getLastToken();
    $newToken = $Token->new_token;

    $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/sobjects/Lead';
    // $authorization = "Authorization: Bearer 00D5f000006OVX8!ARcAQAVcy1d2L4sPQPBqsvBoiL13tyFNS.rErqX9HCCXlfio7H2cShqeXhOlc88ybD6KhyL.5py6sqV2KHC33wQ8w4EMr7qA";
    $authorization = "Authorization: Bearer " . $newToken;

    $dataArray = [
        'FirstName' => $first_name,
        'LastName' => $last_name,
        'Email' => $email,
        'LeadSource' => "EP-CA-Website",
        'MobilePhone' => $mobile_phone,
        'Location__c' => $location_name,
        'Language__c' => $language_site,
        'SMS_Opt_In__c' => $sms_option
    ];

    $ch = curl_init($urlApi);
    $payload = json_encode($dataArray);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $jsonArrayResponse = json_decode($result);
    curl_close($ch);

    return $result;    
}

function getLastToken()
{
    // include_once('connection.inc.php');
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "select id_token, new_token from tokenacess order by id_token desc limit 1";
    $result = pg_query($sql);
    return pg_fetch_object($result);
}

function sendEmail($language, $email, $name, $lastName, $number, $question)
{
    $mail = new PHPMailer(true);
    // Email Template
    $message = file_get_contents('mailTemplate.html');
    $message = str_replace('%language%', $language, $message);
    $message = str_replace('%email%', $email, $message);
    $message = str_replace('%name%', $name, $message);
    $message = str_replace('%lastName%', $lastName, $message);
    $message = str_replace('%mobile%', $number, $message);
    $message = str_replace('%message%', $question, $message);

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //<-- imprime todos los pasos que realiza el proceso de enviar correo
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support56@abogadoericprice.com';
    $mail->Password   = '500LaTerrazaBlvd.';    
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Correo saliente
    $mail->setFrom('support56@abogadoericprice.com');    

    // Correos a quienes le llegan
    // $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    $mail->addAddress('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Velazquez');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to form AEP Google PPC';
    $mail->msgHTML($message); //Toma el template(mailTemplate.html) para construtir el contenido del correo
    $mail->AltBody = 'Sending email'; // <-- Esta linea solo funciona para algun mensaje / NO SE UTILIZA puede quedar asi o comentada

    // Toma todos los parametros anteriorres y realiza el envio del correo
    $mail->send();
}