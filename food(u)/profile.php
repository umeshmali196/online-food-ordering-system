<!DOCTYPE html>
<html>

<head>
    <title>FOODIFY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once "include/links.php"; ?>
    <?php include 'php/database.php';
    if(!isset($_SESSION['uid'])){
        header("Location:index.php");
       } ?>

    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/profile.css" />
</head>

<body style="background-color:#F3F3F3;">
    <?php include_once "include/header.php"; ?>
    <?php
    $sql = "SELECT * FROM `user` where u_id=" . $_SESSION['uid'] . "";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container-fluid" style="margin-top:5%; ">
        <div class="row ml-5">

            <span class="mt-5 col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h1 class="text-muted font-weight-bold "><?php echo $row['name']; ?></h1>
                <p class="text-muted font-weight-bold d-inline">
                    <i class="fas fa-mobile-alt px-2"></i><?php echo $row['moblie']; ?>
                    <span class="ml-3"><i class="far fa-envelope pr-1"></i> <?php echo $row['email']; ?></span>
                </p>
                <div class="d-inline">
                    <button type="button" class="ml-5 btn btn-outline-orange text-muted font-weight-bold bg-transparent"  data-toggle="modal" data-target="#editProfilemodal">EDIT
                        PROFLIE</button>
                </div>
        </div>
    </div>
    <div class="card mt-2 mx-5">
        <div class="card-body">
            <h4 class="card-title h3">Manage Address</h4>
            <div class="row">
                <?php
                $sql2 = "SELECT * FROM `user_address` where u_id=" . $_SESSION['uid'] . "";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    // output data of each row
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                        <div class="col-lg-4  px-5 py-3">
                            <div class="border py-4">
                                <i class="fas fa-home ml-4 mt-2"></i>
                                <span class="mt-2 ml-1 font-weight-bold"><?php echo $row2['add_name']; ?></span>
                                <p class="card-text ml-5  mx-4 mt-1">
                                    <?php echo $row2['add_line'] . "," . $row2['landmark'] . "," . $row2['city'] . "," . $row2['state'] . "-" . $row2['pincode']; ?>
                                </p>
                                <span class="ml-5 editdelete text-uppercase" onclick="getAddDetail(<?php echo $row2['a_id']; ?> )" data-toggle="modal" data-target="#editAddmodal">EDIT</span>
                                <span class="ml-3 editdelete text-uppercase" onclick="delAddress(<?php echo $row2['a_id']; ?> )">DELETE</span>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<b class='ml-4'>No Address Is Added.Add New Addess</b>";
                }
                ?>
            </div>
            <button type="button" class="ml-5 btn btn-outline-orange text-white font-weight-bold text-uppercase" data-toggle="modal" data-target="#addmodal">
                ADD NEW ADDRESS</button>
        </div>
    </div>
    </div>

    <div class="modal fade right" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addmodal" aria-hidden="true">

        <div class="modal-dialog modal-full-height modal-left" role="document">


            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button " class="close" data-dismiss="modal" aria-label="Close" class="font-weight-bold text-dark d-inline">
                        <span aria-hidden="true">&times;</span>
                    </button><br>
                </div>
                <div class="mt-3 ml-3 ">
                    <h4 class="text-dark font-weight-bold">ADD NEW ADDRESS</h4>

                </div>
                <div class="modal-body">
                    <form id="addForm" method="post">
                        <div class="md-form">
                            <input type="text"  name="addname" class="form-control" required>
                            <label for="addname">Address Name</label>
                        </div>
                        <div class="md-form">
                            <input type="text"  name="addline" class="form-control" required>
                            <label for="addline">Address Line</label>
                        </div>
                        <div class="md-form">
                            <input type="text"  name="landmark" class="form-control" required>
                            <label for="landmark">Landmark</label>
                        </div>
                        <div class="md-form">
                            <input type="text"  name="city" class="form-control" required>
                            <label for="city">City</label>
                        </div>
                        <div class="md-form">
                            <input type="text"  name="state" class="form-control" required>
                            <label for="state">State</label>
                        </div>
                        <div class="md-form">
                            <input type="number" maxlength="6"  name="pincode" class="form-control" required>
                            <label for="pincode">Pincode</label>
                        </div>

                        <div class="justify-content-center md-form">
                            <button type="submit" class="btn text-white font-weight-bold w-100 mt-3" style="background-color: #fc8019;" onclick="addAddress(event)">ADD ADDRESS</button>
                        </div>
                        <div class="alert alert-danger mt-3 " role="alert" id="alerterror2">
                            <strong id="signuperr" class="text-lowercase"></strong>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="editAddmodal" tabindex="-1" role="dialog" aria-labelledby="editAddmodal" aria-hidden="true">

        <div class="modal-dialog modal-full-height modal-left" role="document">


            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button " class="close" data-dismiss="modal" aria-label="Close" class="font-weight-bold text-dark d-inline">
                        <span aria-hidden="true">&times;</span>
                    </button><br>
                </div>
                <div class="mt-3 ml-3 ">
                    <h4 class="text-dark font-weight-bold">UPDATE ADDRESS</h4>

                </div>
                <div class="modal-body">
                    <form id="UpdateForm" method="post">
                        <div class="md-form">
                            <input type="hidden" id="aid" name="aid">
                            <input type="text" id="Update_add_name" name="Update_add_name" class="form-control" required>
                            <label for="addname" class="updatelbl">Address Name</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="addline" name="addline" class="form-control" required>
                            <label for="addline"  class="updatelbl">Address Line</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="landmark" name="landmark" class="form-control" required>
                            <label for="landmark"  class="updatelbl">Landmark</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="city" name="city" class="form-control" required>
                            <label for="city"  class="updatelbl">City</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="state" name="state" class="form-control" required>
                            <label for="state"  class="updatelbl">State</label>
                        </div>
                        <div class="md-form">
                            <input type="number" maxlength="6" id="pincode" name="pincode" class="form-control" required>
                            <label for="pincode"  class="updatelbl">Pincode</label>
                        </div>

                        <div class="justify-content-center md-form">
                            <button type="submit" class="btn text-white font-weight-bold w-100 mt-3" style="background-color: #fc8019;" onclick="updateAddress(event)">UPDATE ADDRESS</button>
                        </div>
                        <div class="alert alert-danger mt-3 " role="alert" id="alertupdateerr">
                            <strong id="updateerr" class="text-lowercase"></strong>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="editProfilemodal" tabindex="-1" role="dialog" aria-labelledby="editProfilemodal" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-left" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button " class="close" data-dismiss="modal" aria-label="Close" class="font-weight-bold text-dark d-inline">
                        <span aria-hidden="true">&times;</span>
                    </button><br>
                </div>
                <div class="mt-3 ml-3 ">
                    <h4 class="text-dark font-weight-bold">UPDATE Profile</h4>
                </div>
                <div class="modal-body">
                    <form id="UpdateProForm" method="post">
                        <div class="md-form">
                            <input type="hidden" id="aid" name="aid">
                            <input type="text" id="update_name" name="update_name" class="form-control" value="<?php  echo $row['name']; ?>" required>
                            <label for="update_name" class="updatelbl">Name</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="Update_email" name="Update_email" class="form-control" value="<?php  echo $row['email']; ?>" required>
                            <label for="Update_email"  class="updatelbl">Email Id</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="Update_moblie" name="Update_moblie" class="form-control" value="<?php  echo $row['moblie']; ?>" required>
                            <label for="Update_moblie"  class="updatelbl">Moblie</label>
                        </div>
                        

                        <div class="justify-content-center md-form">
                            <button type="submit" class="btn text-white font-weight-bold w-100 mt-3" style="background-color: #fc8019;" onclick="updateProfile(event)">UPDATE PROFILE</button>
                        </div>
                        <div class="alert alert-danger mt-3 " role="alert" id="alertupdateproerr">
                            <strong id="updateproerr" class="text-lowercase"></strong>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include_once "include/scripts.php"; ?>
    <script>
        $(document).ready(function() {
            $("#signuperr").hide();
            $("#alerterror2").hide();
            $("#alertupdateerr").hide();
            $("#updateerr").hide();
            $("#alertupdateproerr").hide();
            $("#updateproerr").hide();

            
        });

        function addAddress(e) {
            e.preventDefault();
            $.ajax({
                url: "php/reg.php",
                type: "POST",
                data: $("#addForm").serialize(),
                success: function(response) {
                    if (response == "1") {
                        Swal.fire(
                            'Good job!',
                            'Address Added Sucessfully!',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                    } else {
                        console.log(response);
                    }
                }
            });

        }
        function updateAddress(e){
            e.preventDefault();
            $.ajax({
                url: "php/reg.php",
                type: "POST",
                data: $("#UpdateForm").serialize(),
                success: function(response) {
                    if (response == "1") {
                        Swal.fire(
                            'Good job!',
                            'Address Updated Sucessfully!',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                    } else {
                        console.log(response);
                    }
                }
            });
        }
        function delAddress(aid) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Your Address Is Deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    //alert("hi");
                    $.ajax({
                        url: "php/reg.php?deleteaddress="+aid,
                        type: "GET",
                        success: function(response) {
                            if (response == "1") {
                                Swal.fire(
                                    'Deleted!',
                                    'Your Address has been deleted.',
                                    'success'
                                )
                                .then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                })
                            } else {
                                console.log(response);
                            }
                        }
                    });

                }
            })
        }
        function getAddDetail(aid){
            $(".updatelbl").addClass("active");
            
           $.ajax({  
                url: "php/reg.php?getAdd="+aid,
                type: "GET",  
                dataType:"json",  
                success:function(data){ 
                    $('#aid').val(data.a_id);  
                     $('#Update_add_name').val(data.add_name);  
                     $('#addline').val(data.add_line);  
                     $('#landmark').val(data.landmark);  
                     $('#city').val(data.city);  
                     $('#state').val(data.state);  
                     $('#pincode').val(data.pincode);  
                }  
           });  
        }
        function updateProfile(e){
            e.preventDefault();
            $.ajax({
                url: "php/reg.php",
                type: "POST",
                data: $("#UpdateProForm").serialize(),
                success: function(response) {
                    if (response == "1") {
                        Swal.fire(
                            'Good job!',
                            'Address Updated Sucessfully!',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    </script>
</body>

</html>