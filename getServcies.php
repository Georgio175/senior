<?php
require './connection.php';
header('Content-Type: application/json');
// $data = json_decode(file_get_contents('php://input'), true);

// var_dump("test");die;
$filter = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $filter .= " AND s.id = '$id'";
}

if(isset($_GET['category'])){
    $category = $_GET['category'];
    $filter = " AND s.category_id = '$category'";
}

if(isset($_GET['location'])){
    $location = $_GET['location'];
    $filter = " AND s.location_id = '$location'";
}

if(isset($_GET['price'])){
    $price = $_GET['price'];
    if($price == '0_50'){
        $filter .=" AND s.price >=0 AND s.price <= 50";
    }elseif($price == '50_100'){
        $filter .=" AND s.price > 50 AND s.price <= 100";
    }elseif($price == '100_200'){
        $filter .=" AND s.price >100 AND s.price <= 200";
    }elseif($price == '200'){
        $filter .=" AND s.price > 200";
    }
}

$sql="SELECT s.*
        ,l.name as location
        FROM services s
        JOIN locations l ON(l.id = s.location_id)
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