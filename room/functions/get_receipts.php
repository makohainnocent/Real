<?php
require("../../db_config.php");

$room_id = clean($_POST['room_id']);

$sql = "SELECT * FROM receipts WHERE house_id='$room_id' ORDER BY date DESC";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
       
        echo '
        <tr>
        <td style="vertical-align: middle;text-align:center">
        <i class="fas fa-receipt text-primary"></i>
        <small class="text-muted"> '.$row['payment_method'].'</small>
        </td>
        <td style="vertical-align: middle;text-align:center"><small class="text-muted">'.$row['date'].'</small><br> '.$row['amount'].'</td>
        <td style="vertical-align: middle;"><small>'.$row['amount'].'<small></td>
        <td style="vertical-align: middle;"><small class="text-muted">'.$row['description'].'<small></td>
        <td style="vertical-align: middle;">
        <i class="fa fa-download"></i>
        <i class="fa fa-envelope"></i>
        <i class="fa fa-print"></i>
        </td>
        </tr>
        ';
    }
} else {
    echo "<h4>No Receipts to display</h2>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);