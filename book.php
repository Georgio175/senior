<?php
require './connection.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id']; 
$date = $data['date'];
$service_id = $data['service_id'];

$sql="SELECT * FROM booking WHERE service_id = '$service_id' AND from_date = '$date'";
$result = $conn->query($sql);
$res=[];
if ($result->num_rows > 0) {
    while($rows = $result->fetch_assoc()){
        $res []= $rows;
    }
}

if(sizeof($res) > 0){
    echo json_encode(array("status" => "error", "message" => "Already Booked"));die;
}

if($date !='' ){
    $sql="INSERT INTO booking(user_id,service_id,from_date,to_date)VALUES('$user_id','$service_id','$date','$date')";
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