<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
    }else {
        $user_id = $_SESSION['id'];
    }
    
require("../../db_config.php");

$estate_name = clean($_POST['estate_name']);
$owner = clean($_POST['owner']);
$location = clean($_POST['estate_location']);
$details = clean($_POST['estate_details']);
//$bank = clean($_POST['bank']);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO estates (estate_name, location, details,owner_id,user_id)
VALUES ('$estate_name','$location','$details','$owner','$user_id')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
