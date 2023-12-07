<?php

$date = date('Y-m-d H:i:s.uO');

$daily = 1;
$paid_search = 2;
$direct = 3;
$organic_search = 4;
$organic_social = 5;
$referral = 6;
$created_at = $date;
$week_id = 16;

// USE FUNCTIONS
// create_month("test", $date);
// create_week($date, $date, 1, $date);

create_stat($daily, $paid_search, $direct, $organic_search, $organic_social, $referral, $created_at, $week_id);

function create_month($name, $date) {
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "INSERT INTO month_report(month_name, year_report, created_at) " .  "VALUES('" . cleanData($name) . "','" . cleanData($date) . "','" . cleanData($date) ."')";
    return pg_affected_rows(pg_query($sql));
}

function create_week($start_date, $finish_date, $month_id, $created_at){
  $host = "abogadoericprice.com";
  $port = "5432";
  $dbname = "dbezl1uquldojv";
  $user = "uhgpgzxv2hhak";
  $password = "700Flower!";

  $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
  $dbconn = pg_connect($connection_string) or die('Could not reach database.');
  for ($i = 1; $i<=12; $i++){
    for($j = 0; $j<4; $j++){
      $sql = "INSERT INTO week_report(start_date, finish_date, month_id, created_at) " . "VALUES('" .cleanData($start_date) . "','" . cleanData($finish_date) . "','" . cleanData($i)  . "','" . cleanData($created_at) . "')";
      pg_affected_rows(pg_query($sql));
    }
  }
}

function create_stat($daily, $paid_search, $direct, $organic_search, $organic_social, $referral, $created_at, $week_id)
{
  $host = "abogadoericprice.com";
  $port = "5432";
  $dbname = "dbezl1uquldojv";
  $user = "uhgpgzxv2hhak";
  $password = "700Flower!";

  $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
  $dbconn = pg_connect($connection_string) or die('Could not reach database');

  for($i=1; $i<=12; $i++) {
    $sql = "INSERT INTO stats_report(daily, paid_search, direct, organic_search, organic_social, referral, created_at, week_id) " . "VALUES('" . $daily . "','" . $paid_search . "','" . $direct . "','" . $organic_search  . "','" . $organic_social . "','" . $referral . "','" . $created_at . "','" . $week_id .  "')";
    return pg_affected_rows(pg_query($sql));
  }
}

function cleanData($val)
{
    return pg_escape_string($val);
}
