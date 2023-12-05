  <?php



  $date = date('Y-m-d H:i:s.uO');

// create_month("test", $date);

create_week($date, $date, 1, $date);

function create_month($name, $date)
{
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

function cleanData($val)
{
    return pg_escape_string($val);
}
