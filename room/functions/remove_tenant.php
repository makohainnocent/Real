<?php

require("../../db_config.php");


$room_id = clean($_POST['id']);
//clean($_POST['estate_id']);
//$rent = clean($_POST['rent']);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE rooms SET tenant_id=NULL,vacancy=0 WHERE id='$room_id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);