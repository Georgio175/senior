<?php
require './connection.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email']; 
$password = $data['password'];

$sql="SELECT * FROM users WHERE email='$email' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $data=[];
  while($rows = $result->fetch_assoc()){
    $data []= $rows;
  }

    $response = array(
        "status" => "success",
        "message" => "Success",
        "user" => $data[0],
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