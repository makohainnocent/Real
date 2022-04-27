<?php
require("../../db_config.php");

$sql = "SELECT id,names FROM owners";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    echo '<option selected>SELECT</option>';
    while ($row = mysqli_fetch_assoc($query)) {

        echo '<option id="owner_id" value="' . $row['id'] . '">' . $row['names'] . '</option>';
    }
} else {
    echo "<option selected>No owners</option>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
