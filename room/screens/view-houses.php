<!DOCTYPE html>
<html lang="en">
//
<head>
    <title>Owners</title>
    <?php require('../../ui/obj_header.php') ?>
</head>

<body id="body-pd" style="background-color:#f8f9fa !important;">

    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <?php require('../../ui/sidebar.php') ?>
    <!--Container Main start-->
    <div class="height-100 bg-light mt-3">
        <h4>Main Components</h4>


        <div class="table-wrapper mt-5" style="background: #fff;padding: 20px;box-shadow: 0 1px 1px rgb(0 0 0 / 5%);">


            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_owner"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>



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
                <tbody id="estates">
                    <tr class="table-warning">
                        <th scope="row">1</th>
                        <td>
                            <i class='bx bxs-home text-primary h3'></i> Mark
                            <small><span class="text-muted">UGX 300,000</span></small>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Vacant</label>
                            </div>
                        </td>
                        <td><span class="fw-bold">Mark</span><br /><small class="text-muted text-success"><i class="fas fa-phone    "></i> 0705659353</small></td>
                        <td><span class="fw-bold text-danger">UGX 300,000</span></td>
                        <td></td>
                    </tr>

                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <i class='bx bxs-home text-primary h3'></i> Mark
                            <small><span class="text-muted"><i>UGX 300,000</i></span></small>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="text-muted form-check-label" for="flexSwitchCheckDefault"><small><i>Empty</i></small></label>
                            </div>
                        </td>
                        <td><span class="fw-bold">Mark &nbsp;</span><small class="text-muted"><i class="fas fa-phone    "></i> 0705659353</small></td>
                        <td>0</td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>



    <?php
    require("../screens/modals.html");
    ?>
    <script>
        //buttons logic

        function displayEstates() {
            $.ajax({
                url: "../functions/get_estates.php",
                type: "POST",
                cache: false,
                success: function(data) {
                    $('#estates').html(data);
                }
            });
        }

        $(document).ready(
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
                                displayEstates();
                            }
                        });
                    }
                })
            }
        );


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
                            displayEstates();
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
                                    //displayEstates();
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