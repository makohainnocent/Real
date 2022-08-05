<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
    }else {
        $user_id = $_SESSION['id'];
    }

require("../../db_config.php");

$sql = "SELECT estates.id as id ,estates.estate_name as estate_name ,estates.location as location,estates.details as details,estates.owner_id as owner_id,owners.names as owner_names FROM estates LEFT JOIN owners  ON owners.id=estates.owner_id WHERE estates.user_id = '$user_id'";
$query = mysqli_query($conn, $sql);
$number = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        //get filled number of houses
        $count_houses="SELECT COUNT(rooms.id) AS house_no FROM rooms WHERE rooms.estate_id='$row[id]'";
        $house_count_query = mysqli_query($conn, $count_houses);
        $row2=mysqli_fetch_assoc($house_count_query);


        //get empt numof houses
        $count_houses_e="SELECT COUNT(rooms.id) AS house_no_e FROM rooms WHERE rooms.estate_id='$row[id]' AND vacancy=0";
        $house_count_query_e = mysqli_query($conn, $count_houses_e);
        $row2_e=mysqli_fetch_assoc($house_count_query_e);

        $number += 1;
        echo '<tr ><th scope="">' . $number . '</th>
        <td class="this_estate" data-real-estate-id="'.$row['id'].'" style="cursor:pointer;">' . ucwords($row['estate_name']) . ' <span class="badge bg-secondary rounded-pill bg-success">
                                    <i class="fas fa-home    "></i> '.$row2['house_no'].'</span>
                                    <br/><small class="text-muted"><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> ' . ucwords($row['location']) . '  &nbsp;<i class="fas fa-user  text-warning  "></i> ' . ucwords($row['owner_names']) . '</small></td>
                                    <td>
                                    <span class="badge rounded-pill bg-primary">'.($row2['house_no']-$row2_e['house_no_e']).' of '.$row2['house_no'].'</span>
                                    </td>
                                    <td><p class="text-muted"><small>' . ucfirst($row['details']) . '</small>'.$row2['house_no'].'</p></td>
        <td><button data-id="' . $row['id'] . '" data-names="' . $row['estate_name'] . '"  type="button" class="btn btn-outline-danger btn-sm" id="deletebutton">
        <i class="fa fa-trash" aria-hidden="true"></i> DELETE</button>
        <button id="updatebutton" data-owner-names="' . $row['owner_names'] . '" data-owner-id="' . $row['owner_id'] . '" data-id="' . $row['id'] . '" data-names="' . $row['estate_name'] . '" data-location="' . $row['location'] . '" data-details="' . $row['details'] . '" type="button" class="binto btn btn-primary btn-sm">
        <i class="fa fa-edit" aria-hidden="true"></i> MODIFY</button>
        </td>	
		</tr>';
    }
} else {
    echo 0;
    //echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
