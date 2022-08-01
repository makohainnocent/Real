<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
    }
    else {
        $user_id = $_SESSION['id'];
    }

require("../../db_config.php");

$sql="SELECT SUM(balance) as total_balance ,COUNT(id) as num_of_overdue FROM receipts WHERE balance > 0 and user_id=".$_SESSION['id'];
$query=mysqli_query($conn,$sql);


if ($query) {
    $row=mysqli_fetch_assoc($query);


 echo '<div class="d-flex pt-5 mt-5 justify-content-around">

        <div class="card card-box">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column align-self-center">
                        <span class="h3 font-weight-bold" style="color:#41b271">
                        '.number_format($row['total_balance']).'
                    </span>
                        <span class="h6">'.$row['num_of_overdue'].' Overdue rent</span>
                    </div>
                    <div><i class="bx bxs-building-house nav_icon rounded-circle h2" style="padding:15px;background-color:#3ab36e12;color:#3ab36e" aria-hidden="true"></i></div>
                </div>
                <small class="text-muted">Total rent and units  that have not paid.</small>
            </div>
        </div>


        <div class="card card-box">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column align-self-center">
                        <span class="h3 font-weight-bold" style="color:#41b271">'.$row['num_of_overdue'].'</span>
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
                    <span class="h2 font-weight-bold" style="color:#41b271">UGX</span>
                    <span class="h6">2</span>
                </div>
                <div><i class="bx bxs-bar-chart-alt-2 nav_icon rounded-circle h2" style="padding:15px;background-color:#3ab36e12;color:#3ab36e" aria-hidden="true"></i></div>
            </div>
            <small class="text-muted">Collected for the month d </small>
        </div>
    </div>


    </div>';

}
else {
    echo 'haha';
}
    
    ?>