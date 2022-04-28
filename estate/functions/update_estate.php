<?php
require("../../db_config.php");
$estate_id = $_POST['estate_id'];
$estate_name = $_POST['estate_name'];
$estate_location = $_POST['estate_location'];
$estate_owner = $_POST['estate_owner'];
$estate_details = $_POST['estate_details'];
$sql = "UPDATE estates SET estate_name='$estate_name',owner_id='$estate_owner',location='$estate_location',details='$estate_details' WHERE id=$estate_id";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
