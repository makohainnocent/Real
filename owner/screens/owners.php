<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:/real/index.php');
}
else {
    $user_id = $_SESSION['id'];
}

require("../../db_config.php");
$get_num_of_owners="SELECT COUNT(id) as num_owners FROM owners WHERE user_id=$user_id";
$query=mysqli_query($conn,$get_num_of_owners);
if ($conn) {
    
    $row=mysqli_fetch_assoc($query);
}
else {
    die('Erro');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Owners</title>
    <?php require('../../ui/obj_header.php') ?>
</head>

<body id="body-pd" style="background-color:#f6efe5 !important;">

    <header class="header" id="header" style="background-color: #f6efe5 !important;">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <span class="h5 " style="font-weight:800;color:#3ab36e;"><?php echo strtoupper($_SESSION['company_name']); ?></span>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <?php require('../../sidebar.php') ?>
    <!--Container Main start-->
    <div class="height-100 bg-light mt-3" style="background-color:#f6efe5 !important">


    <div class="d-flex pt-5 mt-5 justify-content-around">
       
        

<div class="card card-box">
    <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
            <div class="d-flex flex-column align-self-center">
                <span class="h2"><?php echo $row['num_owners']; ?></span>
                <span class="h5">Property Owners</span>
            </div>
            <div><i class='bx bx-user nav_icon font-size-lg rounded-circle' style='padding:15px;background-color:#3ab36e12;color:#3ab36e' aria-hidden="true"></i></div>
        </div>
        <small class="text-muted text-small">Property owners are directly associated to estates</small>
    </div>
</div>




</div>


        <div class="table-wrapper mt-5" style="background: #fff;padding: 20px;box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
        
        <div class="header-container d-flex flex-row justify-content-end">
        <div>
             <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#add_owner"><i class="fa fa-plus" aria-hidden="true"></i>  New Owner</button>
         </div>

         <div class="flex-fill">
                <h2 style="text-align:center" >
                    Owners
                </h2>
            </div>
         </div>


            <table class="table table-hover mt-3 mx-auto ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        
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
                success: function(data) {
                    $('#owners').html(data);
                }
            });
        }



        //delete owner
        $(document).on('click', '#deletebutton', function() {
            var name=$(this).val();
            var id = $(this).attr('data-id');
            if (confirm("Are sure you Want to delete " + name + "?!") == true) {
                $.ajax({
                    url: '../functions/delete_owner.php',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function() {
                        displayOwners();
                    }
                });
            }
        })

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

            $(document).on('click', '#realupdate', function() {
                $.ajax({
                    url: '../functions/update_owner.php',
                    type: 'post',
                    data: {
                        id: id,
                        name: $('#ownerName').val(),
                        contact: $('#ownerContact').val(),
                        nin: $('#ownerNin').val(),
                        bank: $('#ownerBank').val()
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {

                            alert(name + " Has been updated!");
                            displayOwners();
                        } else {
                            alert('error ');
                        }
                    }

                });

            });


        });

        function addOwners() {
            $('#addowner').click(
                function() {
                    $('#addowner').attr('disabled', 'disabled');
                    var names = $('#names').val();
                    var contact = $('#contact').val();
                    var nin = $('#nin').val();
                    var bank = $('#bank').val();

                    if (names != "" && contact != "" && nin != "" && bank != "") {
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
                            success: function(dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    $("#addowner").removeAttr("disabled");
                                    alert(names + ' was sucessfully added as an owner!');
                                    //redisplay data
                                    displayOwners();
                                    $('#add_user_form').find(':input').val('');
                                } else if (dataResult.statusCode == 201) {
                                    alert("Error occured !");
                                    alert(dataResult.err);
                                    $("#addowner").removeAttr("disabled");
                                }
                            }
                        });
                    } else {
                        alert('Please fill all the fields!');
                        $("#addowner").removeAttr("disabled");
                    }
                }
            );
        }
    </script>





</body>

</html>