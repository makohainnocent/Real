<?php
require("../../db_config.php");

$names = clean($_POST['names']);
$contact = clean($_POST['contact']);
$nin = clean($_POST['nin']);


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO tenants (names, contact, nin)
VALUES ('$names','$contact','$nin')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
}
else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
?>