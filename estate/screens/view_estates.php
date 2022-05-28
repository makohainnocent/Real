<!DOCTYPE html>
<html lang="en">

<head>
    <title>Owners</title>
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


            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_owner"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>



            <table class="table table-hover mt-3 mx-auto ">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Ocuppied</th>
                        <th scope="col">Details</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="estates">

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

        function addEstate() {
            $.get("../functions/get_owners.php", function(data) {
                // Display the returned data in browser
                $("#owner_id").html(data);
            });
            $('#addestate').click(
                function() {
                    $('#addestate').attr('disabled', 'disabled');
                    var names = $('#estate_name').val();
                    var location = $('#estate_location').val();
                    var details = $('#estate_details').val();
                    var owner_id = $('#owner_id').val();




                    if (names != "" && location != "" && details != "" && owner_id !== "") {
                        $.ajax({
                            url: "../functions/add_estate.php",
                            type: "POST",

                            data: {
                                estate_name: names,
                                owner: owner_id,
                                estate_location: location,
                                estate_details: details,

                            },

                            cache: false,
                            success: function(dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    $("#addestate").removeAttr("disabled");
                                    alert(names + ' was sucessfully added to the database!');
                                    //redisplay data
                                    displayEstates();
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