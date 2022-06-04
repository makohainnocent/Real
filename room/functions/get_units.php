<?php
require("../../db_config.php");

//$reminder_sql="SELECT DATEDIFF(DAY,last_receipt_date,GETDATE())";

$sql = "SELECT DATEDIFF(CURDATE(),last_receipt_date) as days,rooms.balance as balance,rooms.estate_id as estate_id,rooms.vacancy as room_status,rooms.id as id,unit_name,monthly_rent,tenants.names as tenant_names,tenants.contact as tenant_contact FROM rooms LEFT JOIN tenants ON rooms.tenant_id=tenants.id ORDER BY rooms.vacancy";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        
        //notifier
        if ($row['days']==30) {
            $rent=$row['monthly_rent'];
            $room_id=$row['id'];

            $sql2="UPDATE rooms SET balance=balance-'$rent' WHERE id='$room_id'";
            
            if (mysqli_query($conn, $sql2)) {

            }
        }



        $number += 1;
        if ($row['room_status']==1) {
            $room_status='checked';
            $description='Occupied';
            $disabled='';
        }
        else{
            $room_status='';
            $description='Empty';
        }

        if (!empty($row['tenant_contact'])) {
            $tenant_contact='<i class="fas fa-phone    "></i> '.$row['tenant_contact'];
        }
        else{
            $tenant_contact='This house is vacant';
            $room_status='';
            //disable receipt butto when house is vacant
            $disabled='disabled';

        }
        echo '
        <tr class="" id="'.$row['id'].'">
            <th scope="row">' . $number . '</th>
                <td>
                    <i class="bx bxs-home text-primary h3"></i> '.$row['unit_name'].'<br>
                            <small><span class="text-muted">UGX '.number_format($row['monthly_rent']).'</span></small>
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
                <td><span class="fw-bold text-danger">UGX '.number_format($row['balance']).'</span>'.$row['days'].'</td>
                        <td><button data-estate-id="'.$row['estate_id'].'" data-room-id="'.$row['id'].'" '.$disabled.' data-tenant-names="'.$row['tenant_names'].'" id="triger_receipt_popup" type="button" class="btn btn-success btn-sm"><i class="fas fa-receipt"></i> RECEIPT</button> 
                        <button data-room-id="'.$row['id'].'" id="show_all_receipts_for_this_house" type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-eye"></i> VIEW</button></td>
        </tr>
        ';
    }
} else {
    echo "<h2>No Units to display,please add new</h2>";
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
