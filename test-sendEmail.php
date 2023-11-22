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

    $total_leads = getLeads('8888222264', 'test@lead.com');

    if ($total_leads){
        updateLead(18);
    // echo "We have found another lead with this data";
    } else {
        saveLead('Test', 'Lead', '6895421358', 'test@lead.com');    
    }


    $question_detail = "Hello, I own and manage a Digital Marketing Company that can help you get more than 100% ROI for your business. We specialize in managing the digital presence of immigration attorneys and generating high value leads for them. Potential clients often respond to the advertisement and reels to find legal experts who can help them navigate the complex immigration process. Here's how we can help: Strategic Content Creation: I will curate and create compelling content that showcases your expertise, educates your audience about immigration processes, and highlights successful case studies. This content will position you as a knowledgeable and trustworthy authority in the field. Consistent Engagement: Engaging with your audience is crucial. I will manage your social media accounts by responding to comments, messages, and inquiries promptly. This active engagement will foster a sense of trust and approachability among your potential clients. Targeted Advertising: I will design and implement targeted advertising campaigns to reach individuals who are actively seeking immigration legal services. This will maximize your exposure to the right audience and increase the likelihood of generating qualified leads. Monthly Analytics Reports: You will receive detailed monthly reports that outline the growth of your social media accounts, the performance of different posts, and the engagement metrics. This will help us refine our strategy and ensure that we're on track to meet your goals. We are sure to generate 40+ leads every month through Social Media Platforms like Facebook and Instagram. Also, we are able to create youtube shorts and reels for you that can go viral and increase your brand awareness. In today's digital age, 76% of consumers look at the online presence of a business before making a purchase. We help you build that digital presence through our services mentioned below: 1. Website Designing 2. Search Engine Optimization (#1 Page of Google) 3. Social Media Management 4. Google Ads and Analytics 5. Graphic Designing and Video Development If you're interested in exploring how an effective social media strategy can elevate your immigration law practice, I would be more than happy to schedule a call at your convenience through the calendly link given below, or call at +1(714) 249-0848 and I'll be ready to discuss the possibilities. Schedule here: https://calendly.com/5coredigitalmarketing/consultation-call";
    
    $sendEmail = sendEmail('Spanish', 'test@test.com', 'Test', 'LTest', '8888222264', $question_detail, 0);
    
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

      if($leadID == "" || $leadID == null || $leadID == undefined || $leadID == 0) {
          $leadID = '***This is a weekly maintenance test';
          $message = str_replace('%duplicate%','This is a weekly maintenance test', $message);
      } else {
          $message = str_replace('%duplicate%','-', $message);
      }    

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'support56@abogadoericprice.com';
    $mail->Password = 'M3xicali56';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('no-reply@abogadoericprice.com', 'No Reply');

    // $mail->addAddress('no-reply@abogadoericprice.com');
    // $mail->addReplyTo('no-reply@abogadoericprice.com', 'No Reply');
    $mail->addCC('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Martinez');

    //Content
    $mail->Encoding = 'base64';
    $mail->CharSet = "UTF-8";
        
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to contac form web site';
    $mail->msgHTML($message); 
    $mail->AltBody = 'Sending email';
    $mail->send();    
}

// NEW FUNCTIONS
function saveLead($name, $lastName, $phoneNumber, $email)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');
    
    $sql = "INSERT INTO save_leads(lead_name, last_name, phone_number, email) " . "VALUES('" . cleanData($name) . "','" . cleanData($lastName) . "','" . cleanData($phoneNumber) . "','" . cleanData($email) . "')";
    return pg_affected_rows(pg_query($sql));
}

function updateLead($lead_id) {
    $id = $lead_id;
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');
    
    $sql = "update save_leads set repeat = '1' where id_lead={$id}";

    return pg_affected_rows(pg_query($sql));    
}

function getLeads($number, $email)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "select id_lead, lead_name, last_name, phone_number, email from save_leads where phone_number = '" . $number . "' or email = '" . $email . "' order by id_lead desc";
    $result = pg_query($sql);
    return pg_fetch_object($result);
}

function cleanData($val)
{
    return pg_escape_string($val);
}
