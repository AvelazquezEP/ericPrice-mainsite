<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT");

try {

    $name = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $mobile = $_POST['MobilePhone'];
    $language = $_POST['Language'];
    $leadID = $_POST['leadID'];
    $question = $_POST['question'];

    if(empty($question)){
        $question = "-";
    }

    $total_leads = getLeads($mobile, $email);

    if ($total_leads){
        // We never use this part in the condition
    } else {
    saveLead($name, $lastName, $mobile, $email);
    }
    
    $sendEmail = sendEmail($language, $email, $name, $lastName, $mobile, $question, $leadID);
    
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
        
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'support56@abogadoericprice.com';
    $mail->Password = '3600LimeSt.Building!';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('no-reply@abogadoericprice.com', 'No Reply');
    
    // All emails to send the Lead notification
    $mail->addAddress('no-reply@abogadoericprice.com');
    $mail->addReplyTo('no-reply@abogadoericprice.com', 'No Reply');
    
    // Can receive the emails
    // $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    // $mail->addAddress('fmartinez@greencardla.com', 'Floriberta Martinez');
    // $mail->addAddress('support56@abogadoericprice.com', 'Paola Carolina');
    // $mail->addCC('rterrazas@greencardla.com', 'Robert Terrazas');
    $mail->addCC('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Martinez');
    
    // This its a configuration for can use the character
    $mail->Encoding = 'base64';
    $mail->CharSet = "UTF-8";

    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to contact form web site';
    $mail->msgHTML($message); 
    $mail->AltBody = 'Sending email';
    $mail->send();
}

// Save all the leads in the database is for can have a backup
function saveLead($name, $lastName, $phoneNumber, $email)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');
    
    $sql = "INSERT INTO save_leads(lead_name, last_name, phone_number, email) " . "VALUES('" . cleanData($name) . "','" . cleanData($lastName) . "','" . cleanData($phoneNumber) . "','" . cleanData($email) . "')";
    return pg_affected_rows(pg_query($sql));
}

// Can get all the leads saved on the database
function getLeads($number, $email)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "select lead_name, last_name, phone_number, email from save_leads where phone_number = '" . $number . "' or email = '" . $email . "' order by id_lead desc";
    $result = pg_query($sql);
    return pg_fetch_object($result);
}

function cleanData($val)
{
    return pg_escape_string($val);
}
