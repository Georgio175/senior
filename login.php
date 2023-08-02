<?php
require './connection.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email']; 
$password = $data['password'];

$sql="SELECT * FROM users WHERE email='$email' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response = array(
        "status" => "success",
        "message" => "Success"
      );
      echo json_encode($response);
}else{
    $response = array(
        "status" => "error",
        "message" => "Invalid email or password"
      );
      echo json_encode($response);
}
$conn->close();
?> 