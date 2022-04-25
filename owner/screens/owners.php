<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="../../ui/css/bootstrap.min.css">
    <link href="../../ui/icons/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../ui/cutom.css"></link>
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

    <div class="container-fluid !direction !spacing " >
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
              <div class="table-wrapper mt-5" style="background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);" >

               
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_owner"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>     
             

                <table  class="table  table-bordered table-hover mt-3 mx-auto ">
                  <thead class="border-0">
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
                  <tbody id="owners">
                 
                  </tbody>
                </table>
              </div>

            </div>

        </div>
        
    </div>
    


    






<?php
require("../screens/modals.html");
?>
<script>
  //buttons logic

  function displayOwners() { 
    $.ajax({
      url: "../functions/get_owners.php",
      type: "POST",
      cache: false,
      success: function(data){
        $('#owners').html(data);
      }
    });
  }

 function deleteOwner(id) {
   $.ajax(
     {
       url:'../functions/delete_owner.php',
       type:'post',
       data:{
         id:id
       },
       success:function(){
         displayOwners();
       }
       
        }); 
 }
 
 var id;
 var name;
 var contact;
 var nin;
 var bank;
 $(document).ready(function() {
      $(document).on('click', '#updatebutton', function() {
        id = $(this).attr('data-id');
        name = $(this).attr('data-names');
        contact = $(this).attr('data-contact');
        nin = $(this).attr('data-nin');
        bank = $(this).attr('data-bank');
        
        $('#updateModal').modal('show');
        $('#ownerName').val(name);
        $('#ownerContact').val(contact);
        $('#ownerNin').val(nin);
        $('#ownerBank').val(bank);



      });

      $(document).on('click','#realupdate',function () {
        $.ajax(
     {
       url:'../functions/update_owner.php',
       type:'post',
       data:{
         id:id,
         name:$('#ownerName').val(),
         contact:$('#ownerContact').val(),
         nin:$('#ownerNin').val(),
         bank:$('#ownerBank').val()
       },
       success:function(dataResult){
        var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					
					alert(name+" Has been updated!");
          displayOwners();
        }
        else{
          alert('error ');
        }
       }
       
        });
        
      });


    });

  function addOwners() {
    $('#addowner').click(
        function() {
          $('#addowner').attr('disabled','disabled');
          var names = $('#names').val();
          var contact = $('#contact').val();
          var nin = $('#nin').val();
          var bank = $('#bank').val();

          if(names!="" && contact!="" && nin!="" && bank!=""){
            $.ajax({
              url: "../functions/add_owner.php",
              type: "POST",

              data: {
                names: names,
                contact: contact,
                nin: nin,
                bank: bank
              },
              
              cache: false,
              success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                  $("#addowner").removeAttr("disabled");
                  alert(names+' was sucessfully added as an owner!');
                  //redisplay data
                  displayOwners();
                  $('#add_user_form').find(':input').val('');					
                }
                else if(dataResult.statusCode==201){
                  alert("Error occured !");
                }
              }
            });
          }
        else{
          alert('Please fill all the fields!');
          $("#addowner").removeAttr("disabled");
        }
      }
      );  
  }
</script>
    
</body>
</html>