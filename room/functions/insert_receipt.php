<?php
session_start();
require("../../db_config.php");

$room_id = clean($_POST['room_id']);
$receipt_amount = clean($_POST['receipt_amount']);
$receipt_date=clean($_POST['receipt_date']);
$receipt_method=clean($_POST['method']);
$description=clean($_POST['description']);
$estate_id=clean($_POST['estate_id']);
$user_id=$_SESSION['id'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO receipts(user_id,house_id,amount,payment_method,date,description,estate_id) 
VALUES('$user_id','$room_id','$receipt_amount','$receipt_method','$receipt_date','$description','$estate_id')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201,"error"=>mysqli_error($conn)));
}

mysqli_close($conn);