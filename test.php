<?php

// var_dump(getLeads('5687456324', 'test@lead.com'));
// echo "<br />";
$total_leads = getLeads('5687456324', 'teswt@lead.com');

if ($total_leads){
echo "We have found another lead with this data";
} else {
saveLead('Test', 'Lead', '6895421358', 'test@lead.com');    
}

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

function getLeads($number, $email)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "select lead_name, last_name, phone_number, email from save_leads where phone_number = '" . $number . "' or email = '" . $email . "' order by id_lead desc";
    $result = pg_query($sql);
    return pg_fetch_object($result);
}

function cleanData($val)
{
    return pg_escape_string($val);
}
