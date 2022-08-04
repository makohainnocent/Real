<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
    }
    else {
        $user_id=$_SESSION['id'];
    }
    require('../../ui/obj_header.php');
    
    //get company name
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
    <title>Stats</title>
    
</head>

<body id="body-pd" style="background-color:#f6efe5 !important;">

    <header class="header" id="header" style="background-color: #f6efe5 !important;">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        

        <span class="h5 " style="font-weight:800;color:#3ab36e;"><?php echo strtoupper($_SESSION['company_name']); ?></span> 
        <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <?php require('../../sidebar.php') ?>
    <!--Container Main start-->
    <div class="height-100 bg-light mt-3" style="background-color:#f6efe5 !important">

    <?php 
    require('../functions/stats.php');


    $get_filled="SELECT (SELECT COUNT(id) FROM rooms WHERE user_id='$user_id' and vacancy=0) as vacant_rooms, (SELECT COUNT(id) FROM rooms WHERE user_id='$user_id') as total_rooms,COUNT(id) as num_filled FROM rooms WHERE vacancy=1 and user_id=".$_SESSION['id'];
    $get_filled_query=mysqli_query($conn,$get_filled);

    if ($get_filled_query) {
      $row=mysqli_fetch_assoc($get_filled_query);
    }


     ?>


    <div class="d-flex flex-wrap flex-row pt-3 justify-content-between">
        
        
       
        <div class="flex-fill m-2 card mb-3 border-0" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
  <div class="card-header">Occupancy</div>
  <div class="card-body">
    <div class="d-flex flex-row justify-content-between">
      <div>
        <h5 class="card-title"><span class="badge rounded-pill bg-success"> <?php echo $row['num_filled'].' of '.$row['total_rooms']; ?></span></h5>
        <small class="text-muted">Occupied</small>
      </div>

      <div>

        <h5 class="card-title"><span class="badge rounded-pill bg-danger"><?php echo $row['vacant_rooms'].' of '.$row['total_rooms']; ?></span></h5>
        <small class="text-muted">Empty</small>
      </div>
      
    </div>
    
    <p class="card-text">
    
    <center><canvas id="myChart" style="width:100%;max-width:600px;margin-20px auto;"></canvas></center>

    </p>
  </div>
</div>
        
     

        

       
        <div class="flex-fill m-2 card mb-3 border-0" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
  <div class="card-header">Rent Collected</div>
  <div class="card-body">
    
    <p class="card-text text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    
    <div class="month border-bottom my-5" >
      <div class="d-flex flex-row justify-content-between">
        <h6 class="text-muted">Outstanding</h6><h6 class="text-muted">Total Due</h6>
      </div>

      <div class="d-flex flex-row justify-content-between mb-2">
        <h4>2000</h4><h4>3000</h4>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h4 class="mt-3">3000</h4>

    </div>


    <div class="month border-bottom my-5" >
      <div class="d-flex flex-row justify-content-between">
        <h6 class="text-muted">Outstanding</h6><h6 class="text-muted">Total Due</h6>
      </div>

      <div class="d-flex flex-row justify-content-between mb-2">
        <h4>2000</h4><h4>3000</h4>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h4 class="mt-3">3000</h4>

    </div>



  </div>
</div>
        


    </div>
        <div name="magin bottom" style="height:20px;"></div>

        <script>
          <?php 

          $percentage_filled=number_format((($row['num_filled']/$row['total_rooms'])*100),2);
          echo 'var data = {
  labels: [
    "Empty",
    "Occupied"
    
  ],
  datasets: [
    {
      data: ['.$row['vacant_rooms'].','.$row['num_filled'].'],
      backgroundColor: [
        "#FF6384",
        "#41b271",
        
      ],
      hoverBackgroundColor: [
        "#FF6384",
        "#41b271",
        
      ]
    }]
};

Chart.pluginService.register({
  beforeDraw: function(chart) {
    var width = chart.chart.width,
    height = chart.chart.height,
    ctx = chart.chart.ctx;
    
    ctx.restore();
    var fontSize = (height / 114).toFixed(2);
    ctx.font = fontSize + "em sans-serif";
    ctx.textBaseline = "middle";
    
    var text = "'.$percentage_filled.'%",
    textX = Math.round((width - ctx.measureText(text).width) / 2),
    textY = height / 2;
    
    ctx.fillText(text, textX, textY);
    ctx.save();
  }
});';
    ?>

var chart = new Chart(document.getElementById('myChart'), {
  type: 'doughnut',
  data: data,
  options: {
  	responsive: true,
    legend: {
      display: false
    }
  }
});
        </script>

    




</body>

</html>