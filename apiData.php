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

    echo $response;
} catch (Exception $e) {
    header("Location: https://abogadoericprice.com/sorry.html");
}

// FUNCTIONS SECTIONS
function createLeadApi($first_name, $last_name, $email, $mobile_phone, $location_name, $language_site, $sms_option) {

    $Token = getLastToken();
    $newToken = $Token->new_token;

    $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/sobjects/Lead';
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