<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="../../ui/css/bootstrap.min.css">
    <link href="../../ui/icons/css/all.css" rel="stylesheet">
	<script type="text/javascript" src="../../ui/js/bootstrap.min.js"></script>
  <script src="../../ui/jquery-3.6.0.min.js"></script>
</head>
<body>
   <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#16AB39;">
      <div class="container" style="background-color:#16AB39;">
         <a href="" class="navbar-brand">
           <i class="fas fa-user"></i>
         </a>
        <button 
        class="navbar-toggler" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#toggleMobileMenu" 
        aria-controls="toggleMobileMenu" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="toggleMobileMenu">
          <ul class="navbar-nav ms-auto">
            <li><a class="nav-link" href="">Home</a></li>
            <li><a class="nav-link" href="">About</a></li>
            <li><a class="nav-link" href="">Contact</a></li>
            <li><a class="nav-link" href="">People</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid !direction !spacing ">
        <div class="row">
            <div class="col-2">
            <ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>

            </div>

            <div class="col">
              <div class="container mt-5 d-flex flex-row justify-content-between">  
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#add_owner"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>     
              </div>
    
                <table class="table  table-bordered table-hover mt-5 mx-auto ">
                  <thead class="border-0 border-light table-dark">
                    <tr class="table-info">
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Units</th>
                      <th scope="col">Contact</th>
                      <th scope="col">NIN</th>
                      <th scope="col">Bank A/C</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>10</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <i class="fa fa-trash" aria-hidden="true" ></i> DELETE</button>
                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update">
                      <i class="fa fa-edit" aria-hidden="true"></i> MODIFY</button>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Mark</td>
                      <td>10</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Mark</td>
                      <td>10</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                    </tr>
                  </tbody>
                </table>
            </div>

        </div>
        
    </div>
    

    






<?php
require("../screens/modals.html");
?>
    
</body>
</html>