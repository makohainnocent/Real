<?php
require("../../db_config.php");

$sql = "SELECT id,unit_name,monthly_rent FROM rooms";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $number += 1;
        echo '
        <tr class="">
            <th scope="row">' . $number . '</th>
                <td>
                    <i class="bx bxs-home text-primary h3"></i> '.$row['unit_name'].'<br>
                            <small><span class="text-muted">UGX '.$row['monthly_rent'].'</span></small>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input value="'.$row['id'].'" data-name="'.$row['unit_name'].'" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label text-muted " for="flexSwitchCheckDefault"><small><i class="status">Empty</i></label>
                    </div>
                </td>
                <td>
                <span class="fw-bold">Mark</span><br /><small class="text-muted text-success">
                <i class="fas fa-phone    "></i> 0705659353</small>
                </td>
                <td><span class="fw-bold text-danger">UGX 300,000</span></td>
                        <td></td>
        </tr>
        ';
    }
} else {
    echo "<h2>No Units to display,please add new</h2>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
