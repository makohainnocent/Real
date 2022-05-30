<?php
require("../../db_config.php");

$room_id = clean($_POST['room_id']);

$sql = "SELECT * FROM receipts WHERE house_id='$room_id'";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
       
        echo '
        <tr>
        <td>'.$row['date'].'</td>
        <td>'.$row['payment_method'].'</td>
        <td>'.$row['amount'].'</td>
        <td>'.$row['description'].'</td>
        </tr>
        ';
    }
} else {
    echo "<h4>No Receipts to display</h2>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);