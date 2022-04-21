<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real";

function clean($data){
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = stripcslashes($data);
    $data = trim($data);
    $data = htmlentities($data);
    return $data;
}

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