<?php
require './connection.php';
header('Content-Type: application/json');

$filter = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $filter = " AND id = '$id'";
}

$sql="SELECT b.* 
        ,u.name as username
        ,s.name as service_name
        FROM booking b
        JOIN users u ON(u.id = b.user_id)
        JOIN services s ON(s.id = b.service_id)
        WHERE 1=1 $filter";
$result = $conn->query($sql);
$data=[];
if ($result->num_rows > 0) {
    while($rows = $result->fetch_assoc()){
        $data []= $rows;
    }
}
echo json_encode($data);

$conn->close();
?> 