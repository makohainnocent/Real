<?php
require("../../db_config.php");

$sql = "SELECT unit_name,monthly_rent FROM rooms";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $number += 1;
        echo '<tr><th scope="">' . $number . '</th>
        ';
    }
} else {
    echo "<h2>No Estate to display,please add new</h2>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
