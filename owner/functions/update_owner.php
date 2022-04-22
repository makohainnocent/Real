<?php
require("../../db_config.php");
$id = $_POST['id'];
$unames = $_POST['name'];
$ucontact = $_POST['contact'];
$unin = $_POST['nin'];
$ubank = $_POST['bank'];
$sql = "UPDATE owners SET names='$unames',contact='$ucontact',nin='$unin',bank='$ubank' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
}
else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
?>