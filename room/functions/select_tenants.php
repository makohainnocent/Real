<?php
require("../../db_config.php");

$sql = "SELECT id,names FROM tenants";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    echo '<option selected value="">SELECT</option>';
    while ($row = mysqli_fetch_assoc($query)) {

        echo '<option value="' . $row['id'] . '">' . $row['names'] . '</option>';
    }
} else {
    echo "<option selected value=''>No Tenats in this Estate</option>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);