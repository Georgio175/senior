<?php
require './connection.php';
header('Content-Type: application/json');

// $file_name = $_FILES["profile_image"];
// $basename = basename($file_name);
// $ext = pathinfo($basename,PATHINFO_EXTENSION);
// $file="";
// if($ext != null){
//     $file =$uniqid(). "_" .date("Y-m-d-h:i"). "." . $ext;
// }
// var_dump($file);die;

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name']; 
$name = $conn->real_escape_string($name);
$category_id = $data['category_id'];
$location = $data['location'];
$price = $data['price'];
$short_description = $data['short_description'];
$short_description = $conn->real_escape_string($short_description);
$full_description = $data['full_description'];
$full_description = $conn->real_escape_string($full_description);
$is_booked = $data['is_booked'] == true ? 1 : 0;
$from_date = $data['from_date'] == true ? 1 : 0;
$to_date = $data['to_date'] == true ? 1 :0;
$email = $data['email'] == true ? 1 :0;
$phone = $data['phone'] == true ? 1 :0;

$profile_image = $data["profile_image"];
$cover_image = $data["cover_image"];

if($name !='' && $category_id !='' && $location !='' && $short_description !='' && $full_description !='' ){
    $sql="INSERT INTO services(name,category_id,location_id
                    ,short_description,full_description
                    ,price,is_booked,phone,email,from_date,to_date,profile_image_link,cover_image_link
                    ) VALUES('$name','$category_id','$location','$short_description'
                        ,'$full_description','$price','$is_booked','$phone','$email'
                        ,'$from_date','$to_date','$cover_image','$profile_image')";
    // echo($sql);die;
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