<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "senior_db";
$port = "3308";
$conn = new mysqli($servername, $username, $password, $dbname,$port);


if(!$conn){
    // var_dump('no connection');die;
    echo json_encode("no connection");die;
}
?>