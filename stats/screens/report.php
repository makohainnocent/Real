<?php
session_start();

if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
    }
    else {
        
    }
    require('../../ui/obj_header.php');
    
    //get company name
    require("../../db_config.php");
    $get_filled="SELECT COUNT(id) as num FROM rooms WHERE vacancy=1 and user_id=".$_SESSION['id'];
    $get_filled_query=mysqli_query($conn,$get_filled);
    
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

    <?php require('../functions/stats.php'); ?>


    <div class="d-flex flex-row pt-3 justify-content-between">
        
        
       
        <div class="flex-fill m-2 card mb-3 border-0" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
  <div class="card-header">Occupancy</div>
  <div class="card-body">
    <div class="d-flex flex-row justify-content-between">
      <div>
        <h5 class="card-title"><span class="badge rounded-pill bg-success"> 1 of 10</span></h5>
        <small class="text-muted">Occupied</small>
      </div>

      <div>

        <h5 class="card-title"><span class="badge rounded-pill bg-danger">1 of 10</span></h5>
        <small class="text-muted">Empty</small>
      </div>
      
    </div>
    
    <p class="card-text">
    
    <canvas id="myChart" style="width:100%;max-width:600px;margin:30px auto"></canvas>

    </p>
  </div>
</div>
        
     

        

       
        <div class="flex-fill m-2 card mb-3 border-0" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
        


    </div>
        <div name="magin bottom" style="height:20px;"></div>

        <script>
          var data = {
  labels: [
    "Occupied",
    "Empty",
    
  ],
  datasets: [
    {
      data: [300, 50],
      backgroundColor: [
        "#FF6384",
        "#36A2EB",
        
      ],
      hoverBackgroundColor: [
        "#FF6384",
        "#36A2EB",
        
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

    var text = "70%",
        textX = Math.round((width - ctx.measureText(text).width) / 2),
        textY = height / 2;

    ctx.fillText(text, textX, textY);
    ctx.save();
  }
});

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