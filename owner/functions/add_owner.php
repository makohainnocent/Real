<?php
require("../../db_config.php");

$names = clean($_POST['names']);
$contact = clean($_POST['contact']);
$nin = clean($_POST['nin']);
$bank = clean($_POST['bank']);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO owners (names, contact, nin,bank)
VALUES ('$names','$contact','$nin','$bank')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
}
else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
?>