<?php
header('Access-Control-Allow-Origin: *');
// header('Content-type: application/json');

$location_code = ['a' => 1, 'b' => 2, 'c' => 3];
echo json_encode($location_code);
// echo $location_code[0];