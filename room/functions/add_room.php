<?php

require("../../db_config.php");

$unit_name = clean($_POST['unit_name']);
$estate_id = clean($_POST['estate_id']);
$rent = clean($_POST['rent']);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO rooms (unit_name, monthly_rent, estate_id)
VALUES ('$unit_name','$rent','$estate_id')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
