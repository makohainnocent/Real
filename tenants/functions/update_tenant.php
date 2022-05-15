<?php
require("../../db_config.php");
$id = $_POST['id'];
$unames = $_POST['name'];
$ucontact = $_POST['contact'];
$unin = $_POST['nin'];
$sql = "UPDATE tenants SET names='$unames',contact='$ucontact',nin='$unin' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
}
else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
?>