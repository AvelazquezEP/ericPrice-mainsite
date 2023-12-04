<?php

  $date = date('Y-m-d H:i:s.uO');

create_month("test", $date);

function create_month($name, $date)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "INSERT INTO month_report(month_name, year_report, created_at)" .  "VALUES('" . cleanData($name) . "','" . cleanData($date) . "','" . cleanData($date) ."')";
    return pg_affected_rows(pg_query($sql));
}

function cleanData($val)
{
    return pg_escape_string($val);
}
