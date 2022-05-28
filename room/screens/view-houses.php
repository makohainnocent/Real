<!DOCTYPE html>
<html lang="en">

<head>
    <title>Units</title>
    <?php require('../../ui/obj_header.php') ?>
</head>

<body id="body-pd" style="background-color:#f8f9fa !important;">

    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <?php require('../../sidebar.php') ?>
    <!--Container Main start-->
    <div class="height-100 bg-light mt-3">
        <h4>Main Components</h4>


        <div class="table-wrapper mt-5" style="background: #fff;padding: 20px;box-shadow: 0 1px 1px rgb(0 0 0 / 5%);">


            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_house"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>



            <table class="table table-hover mt-3 mx-auto caption-top">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Unit Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tenant Name</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="units">
                    

                </tbody>
            </table>
        </div>
    </div>



    <?php
    require("../screens/modals.html");
    ?>
    <script>
        //buttons logic

        var room_id;
        var room_name;
        $(document).on('click', '#add_tenant_to_room', function() {
            var tenant_id=$('#tenant_id').val();
            var date=$('#date').val();
            
            alert(room_id+' '+tenant_id);
            
            $.ajax({
                url: '../functions/insert_tenant_to_room.php',
                type: 'post',
                    data: {
                        tenant_id: tenant_id,
                        id: room_id,
                        date:date
                    },
                    success: function() {
                        alert('Tenant was added to the house')
                        displayUnits();
                    }
                });
        })
        
        
        //Change text of switch and show popup to insert user
        $(document).on('change', '.form-check-input', function() {
            
            if(this.checked) {
                $(this).siblings('label').html('Occupied');
                room_name=$(this).attr('data-name');
                room_id=$(this).attr('value');
                $('.insert-tenant-modal-title').text("Add Tenant to "+room_name);
                $('#insert_tenant').modal('show');
                
                // Display the returned user names and id data in browser
                $.get("../functions/select_tenants.php", function(data) {
                    $("#tenant_id").html(data);
                });
                

                
            }
            else{
                //remove tenant from house
                room_name=$(this).attr('data-name');
                if (confirm("Are you sure you want to make this house vacant? "+room_name)) {
                    
                    room_id=$(this).attr('value');
                    $.ajax({
                    url: '../functions/remove_tenant.php',
                    type: 'post',
                        data: {
                            id: room_id
                        },
                        success: function() {
                            alert('House is now vacant')
                            displayUnits();
                        }
                    });
                    $(this).siblings('label').html('Empty');
                }
                else{
                    displayUnits();
                }
                
            }
        });

        function displayUnits() {
            $.ajax({
                url: "../functions/get_units.php",
                type: "POST",
                cache: false,
                success: function(data) {
                    $('#units').html(data);
                }
            });
        }

        /*$(document).ready(
            function() {
                $(document).on('click', '#deletebutton', function() {
                    var name = $(this).attr('data-names');
                    var id = $(this).attr('data-id');
                    if (confirm("Are sure you Want to delete " + name + "?!") == true) {
                        $.ajax({
                            url: '../functions/delete_estate.php',
                            type: 'post',
                            data: {
                                id: id
                            },
                            success: function() {
                                displayUnits();
                            }
                        });
                    }
                })
            }
        );
        8*/


        var estate_id;
        var estate_name;
        var estate_location;
        var estate_owner_id;
        var estate_details;
        $(document).ready(function() {
            $(document).on('click', '#updatebutton', function() {
                estate_id = $(this).attr('data-id');
                estate_name = $(this).attr('data-names');
                estate_location = $(this).attr('data-location');
                estate_owner_id = $(this).attr('data-owner-id');
                estate_owner_names = $(this).attr('data-owner-names');
                estate_details = $(this).attr('data-details');

                $('#updateModal').modal('show');
                $('#estateName').val(estate_name);
                $('#estateLocation').val(estate_location);
                var html_code = "<option selected value=" + estate_owner_id + ">" + estate_owner_names + "</option>";
                $('#ownerId').html(html_code);
                $('#estateDetails').val(estate_details);



            });

            $(document).on('click', '#realupdate', function() {
                $.ajax({
                    url: '../functions/update_estate.php',
                    type: 'post',
                    data: {
                        estate_id: estate_id,
                        estate_name: $('#estateName').val(),
                        estate_location: $('#estateLocation').val(),
                        estate_owner: $('#ownerId').val(),
                        estate_details: $('#estateDetails').val()
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {

                            alert(estate_name + " Has been updated!");
                            displayUnits();
                        } else {
                            alert('error ');
                        }
                    }

                });

            });


        });

        function addUnit() {
            /*$.get("../functions/get_owners.php", function(data) {
                // Display the returned data in browser
                $("#owner_id").html(data);
            });*/
            $('#addunit').click(
                function() {
                    $('#addunit').attr('disabled', 'disabled');
                    var unit_name = $('#unit_name').val();
                    var rent = $('#unit_rent').val();

                    if (unit_name != "" && rent != "") {
                        $.ajax({
                            url: "../functions/add_room.php",
                            type: "POST",

                            data: {
                                unit_name: unit_name,
                                rent: rent,

                            },

                            cache: false,
                            success: function(dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    $("#addunit").removeAttr("disabled");
                                    alert(unit_name + ' was sucessfully added to the database!');
                                    //redisplay data
                                    displayUnits();
                                    $('#add_estate_form').find(':input').val('');
                                } else if (dataResult.statusCode == 201) {
                                    alert("Error occured !");
                                }
                            }
                        });
                    } else {
                        alert('Please fill all the fields!');
                        $("#addestate").removeAttr("disabled");
                    }
                }
            );
        }
    </script>





</body>

</html>