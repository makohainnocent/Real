<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
    }
    else {
        $user_id = $_SESSION['id'];
    }

require("../../db_config.php");


    $get_numbers_query="SELECT COUNT(id) as num_estates  FROM estates WHERE user_id=1";
    $get_users_query="SELECT COUNT(id) as num_owners FROM owners WHERE user_id=1";
    $get_room_numbers="SELECT COUNT(id) as num_rooms  FROM rooms WHERE estate_id IN (SELECT id FROM estates WHERE user_id=1) ";
    $query=mysqli_query($conn,$get_numbers_query) or die("Error");
    $query1=mysqli_query($conn,$get_room_numbers) or die("Error1");
    $query2=mysqli_query($conn,$get_users_query) or die("Error1");

    if ($query) {
        $row=mysqli_fetch_assoc($query);
        $row1=mysqli_fetch_assoc($query1);
        $row2=mysqli_fetch_assoc($query2);
        echo ' <div class="d-flex p-2 mt-5 justify-content-around">

        <div class="card card-box">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column align-self-center">
                        <span class="h2 font-weight-bold" style="color:#41b271">'.$row1['num_rooms'].'</span>
                        <span class="h6">Housing Units</span>
                    </div>
                    <div><i class="bx bxs-building-house nav_icon rounded-circle h2" style="padding:15px;background-color:#3ab36e12;color:#3ab36e" aria-hidden="true"></i></div>
                </div>
                <small class="text-muted">This is some text within a card body.</small>
            </div>
        </div>


        <div class="card card-box">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column align-self-center">
                        <span class="h2 font-weight-bold" style="color:#41b271">'.$row['num_estates'].'</span>
                        <span class="h6">Estates</span>
                    </div>
                    <div><i class="bx bxs-grid-alt nav_icon rounded-circle h2" style="padding:15px;background-color:#3ab36e12;color:#3ab36e" aria-hidden="true"></i></div>
                </div>
                <small class="text-muted">This is some text within a card body.</small>
            </div>
        </div>


        <div class="card card-box">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column align-self-center">
                        <span class="h2 font-weight-bold" style="color:#41b271">'.$row2['num_users'].'</span>
                        <span class="h6">Property Owners</span>
                    </div>
                    <div><i class="bx bxs-user nav_icon rounded-circle h2" style="padding:15px;background-color:#3ab36e12;color:#3ab36e" aria-hidden="true"></i></div>
                </div>
                <small class="text-muted">This is some text within a card body.</small>
            </div>
        </div>

        

        <div class="card card-box">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>


    </div>';
     
    }
    else{
        
    }
    
    ?>