<?php
require './connection.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name']; 
$name = $conn->real_escape_string($name);
$category_id = $data['category_id'];
$location = $data['location'];
$short_description = $data['short_description'];
$short_description = $conn->real_escape_string($short_description);
$full_description = $data['full_description'];
$full_description = $conn->real_escape_string($full_description);
3


$comment = $data['comment'];
$comment = $conn->real_escape_string($comment);


$price = $data['price'];

if($name !='' && $category_id !='' && $location !='' && $short_description !='' && $full_description !='' && $comment !=''){
    $sql="INSERT INTO services(name,category_id,location_id,short_description,full_description,comment,price) VALUES('$name','$category_id','$location','$short_description','$full_description','$comment','$price') ";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Created successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error in creation: " . $conn->error));
    }
}else{
    echo json_encode(array("status" => "error", "message" => "Some fields are required"));
}
$conn->close();
?> 