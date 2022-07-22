<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tenants</title>
    <?php require('../../ui/obj_header.php') ?>
</head>

<body id="body-pd" style="background-color:#f6efe5 !important;">

<header class="header" id="header" style="background-color:#fff0;">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        

        <span class="h5 " style="font-weight:800;color:#3ab36e;"><?php echo strtoupper($_SESSION['company_name']); ?></span> 
        <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>

    <?php require('../../sidebar.php') ?>
    <!--Container Main start-->
    <div class="height-100 bg-light mt-3" style="background-color:#f6efe5 !important;">

    <div class="d-flex pt-5 mt-5 justify-content-around"></div>
        


        <div class="table-wrapper mt-5" style="background: #fff;padding: 20px;box-shadow: 0 1px 1px rgb(0 0 0 / 5%);">

        <div class="header-container d-flex flex-row justify-content-end">

            <div>
                
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#add_owner"><i class="fa fa-plus" aria-hidden="true"></i> New Tenant</button>
            </div>
    
            <div class="flex-fill">
                <h2 style="text-align:center" >
                    Tenants
                </h2>
            </div>

        </div>  




            <table class="table table-hover mt-3 mx-auto ">
                <thead class="border-0">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">NIN</th>
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

        function displayTenants() {
            $.ajax({
                url: "../functions/get_tenants.php",
                type: "POST",
                cache: false,
                success: function(data) {
                    $('#owners').html(data);
                }
            });
        }



        $(document).on('click', '#deletebutton', function() {
            var name = $(this).val();
            var id = $(this).attr('data-id');
            if (confirm("Are sure you Want to delete dfsd " + name + "?!") == true) {
                $.ajax({
                    url: '../functions/delete_tenant.php',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function() {
                        displayTenants();
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
                    url: '../functions/update_tenant.php',
                    type: 'post',
                    data: {
                        id: id,
                        name: $('#ownerName').val(),
                        contact: $('#ownerContact').val(),
                        nin: $('#ownerNin').val(),
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {

                            alert(name + " Has been updated!");
                            displayTenants();
                        } else {
                            alert('error ');
                        }
                    }

                });

            });


        });

        function addTenants() {
            $('#addowner').click(
                function() {
                    $('#addowner').attr('disabled', 'disabled');
                    var names = $('#names').val();
                    var contact = $('#contact').val();
                    var nin = $('#nin').val();

                    if (names != "" && contact != "" && nin != "") {
                        $.ajax({
                            url: "../functions/add_tenant.php",
                            type: "POST",

                            data: {
                                names: names,
                                contact: contact,
                                nin: nin,
                                
                            },

                            cache: false,
                            success: function(dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    $("#addowner").removeAttr("disabled");
                                    alert(names + ' was sucessfully added as an owner!');
                                    //redisplay data
                                    displayTenants();
                                    $('#add_user_form').find(':input').val('');
                                } else if (dataResult.statusCode == 201) {
                                    alert("Error occured !");
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