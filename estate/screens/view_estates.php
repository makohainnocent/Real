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
    <?php require('../../ui/sidebar.php') ?>
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