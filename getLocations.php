<?php
require './connection.php';
header('Content-Type: application/json');

$filter = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $filter = " AND id = '$id'";
}

$sql="SELECT * FROM locations WHERE 1=1 $filter";
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