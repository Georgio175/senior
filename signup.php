<?php
require './connection.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email']; 
$email = $conn->real_escape_string($email);
$password = $data['password'];
$password = $conn->real_escape_string($password);
$name = $data['name'];
$name = $conn->real_escape_string($name);
$lastName = $data['lastName'];


if($name !='' && $email !='' && $password !=''){
    $sql="INSERT INTO users(name,email,password,lastName) VALUES('$name','$email','$password','$lastName') ";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Registration successful"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error registering user: " . $conn->error));
    }
}else{
    echo json_encode(array("status" => "error", "message" => "Some fields are required"));
}
$conn->close();
?> 