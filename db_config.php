<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real";



$conn = @mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {



}

//data cleanser
function clean($data)
{
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = stripcslashes($data);
    $data = trim($data);
    $data = htmlentities($data);
    return $data;
}

?>