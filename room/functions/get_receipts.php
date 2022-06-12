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
        <td ><small style="white-space: nowrap;" class="text-muted">'.date("D, jS M Y",strtotime($row['date'])).'</small><br> '.$row['amount'].'</td>
        <td style="vertical-align: middle;"><small class="text-danger">'.$row['amount'].'<small></td>
        <td style="vertical-align: middle;"><small class="text-muted">'.$row['description'].'<small></td>
        <td  style="vertical-align: middle;white-space: nowrap;">
        <i style="cursor:pointer" title="Download this receipt" class="fa fa-download p-1 text-warning"></i>
        <i style="cursor:pointer" title="Send via Email" class="fa fa-envelope p-1 text-success" ></i>
        <i style="cursor:pointer" title="Print this receipt" class="fa fa-print p-1 text-primary"></i>
        </td>
        </tr>
        ';
    }
} else {
    echo "<h4>No Receipts to display</h2>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);