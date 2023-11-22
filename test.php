<?php

$mobile = '8052984430';
$email = 'jr.amaya062023@gmail.com';
$total_leads = getLeads($mobile, $email);
$id = getLeads($mobile, $email)->id_lead;
$int_id = (int)filter_var($id, FILTER_SANITIZE_NUMBER_INT);
$int_id;

if ($total_leads){
    updateLead($int_id);
} else {
    saveLead($name, $lastName, $mobile, $email);
}

function updateLead($lead_id) {
    $id = $lead_id;
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
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

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "select id_lead, lead_name, last_name, phone_number, email from save_leads where phone_number = '" . $number . "' or email = '" . $email . "' order by id_lead desc";
    $result = pg_query($sql);

    return pg_fetch_object($result);
    // return $result;
}