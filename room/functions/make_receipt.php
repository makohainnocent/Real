<?php

require("../../db_config.php");

$room_id = clean($_POST['room_id']);
$rent = clean($_POST['receipt_amount']);
$receipt_date=clean($_POST['receipt_date']);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE rooms SET monthly_rent='$rent',last_receipt_date='$receipt_date' WHERE id='$room_id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);