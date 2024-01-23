<!-- CRON FILE / it will automatically activate every 3 hours (7am, 10pm, 1pm, 4pm, 7pm, 10pm, 1am, 4am) -->
<?php

session_start();
$newToken = $_SESSION["newKey"];

try {    
    $typeRequest = "refresh_token";
    $client_id = "3MVG9p1Q1BCe9GmCTLOrzG0fy.Avu0cWom1hzgSzlZpvn.md7wGghadvLfkDKFVcYzeeeA7S23b8emt5JCbIq";
    $secret_id = "67EE826292B731BD3EB70D7780FA9BE7A7055E9D066E31C7805319CE549441AC";
    $refresh_token = '5Aep861FpKlGRwv8KAiV.sa3q6sPXVzio_hrVzMwc15tmOyIN1R2WLBImVQQKuEEVVij7ZAaKv.TLzVsmVcJDtz';

    $response = refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token);

    // we get only the token and not the complete json structure
    $newToken = $response->access_token;
    $_SESSION["newKey"] = $response;
    var_dump($response);
} catch (Exception $e) {
    echo "Error: " . $e;
}

function refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token)
{
    $urlApi = 'https://login.salesforce.com/services/oauth2/token';
    
    $dataArray = [
        'grant_type' => $typeRequest,
        'client_id' => $client_id,
        'client_secret' => $secret_id,
        'refresh_token' => $refresh_token
    ];

    $curl = curl_init($urlApi);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dataArray));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    $jsonArrayResponse = json_decode($result);
    curl_close($curl);

    $new_token = strval($jsonArrayResponse->access_token);

    $date = date('Y-m-d H:i:s.uO');
    
    saveToken($new_token, $date);

    return $jsonArrayResponse;
}

function saveToken($tokenString, $dateToken)
{
    $host = "abogadoericprice.com";
    $port = "5432";
    $dbname = "dbezl1uquldojv";
    $user = "uhgpgzxv2hhak";
    $password = "700Flower!";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');
        
    $sql = "INSERT INTO tokenacess(new_token, newToken_date) " . "VALUES('" . cleanData($tokenString) . "','" . cleanData($dateToken) . "')";
    return pg_affected_rows(pg_query($sql));
}

function cleanData($val)
{
    return pg_escape_string($val);
}
