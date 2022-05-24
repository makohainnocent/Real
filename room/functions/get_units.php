<?php
require("../../db_config.php");

$sql = "SELECT rooms.vacancy as room_status,rooms.id as id,unit_name,monthly_rent,tenants.names as tenant_names,tenants.contact as tenant_contact FROM rooms LEFT JOIN tenants ON rooms.tenant_id=tenants.id";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $number += 1;
        if ($row['room_status']==1) {
            $room_status='checked';
            $description='Occupied';
        }
        else{
            $room_status='';
            $description='Empty';
        }

        if (!empty($row['tenant_contact'])) {
            $tenant_contact='<i class="fas fa-phone    "></i>'.$row['tenant_contact'];
        }
        else{
            $tenant_contact='This house is vacant';
            $room_status='';

        }
        echo '
        <tr class="">
            <th scope="row">' . $number . '</th>
                <td>
                    <i class="bx bxs-home text-primary h3"></i> '.$row['unit_name'].'<br>
                            <small><span class="text-muted">UGX '.$row['monthly_rent'].'</span></small>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input '.$room_status.' value="'.$row['id'].'" data-name="'.$row['unit_name'].'" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label text-muted " for="flexSwitchCheckDefault"><small><i class="status">'.$description.'</i></label>
                    </div>
                </td>
                <td>
                <span class="fw-bold">'.$row['tenant_names'].'</span><br /><small class="text-muted text-success">
                '.$tenant_contact.'</small>
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
