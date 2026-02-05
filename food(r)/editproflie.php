<?php
include("php/database.php"); 
 
?>
<!doctype html>
<html lang="en">

<head>
  <?php include('include/links.php'); ?>
  <link rel="stylesheet" href="css/editproflie.css">

</head>
<title>FOODIFY</title>
<body>
  <?php
    include('include/navbar.php');
    include('include/slidebar.php');

?>
  <div class="conten-body">
    <?php
    $sql = "SELECT * FROM `restaurants` where res_id=".$_SESSION['resid']."";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_assoc($result); 
    ?>
    <div id="content-wrapper">
      <div class="container">
        <div class="mycard-design card px-2  box-shadow">
          <span
            class="text-light font-weight-bold border-bottom card-shadow h4 py-2 px-1  position-absolute  bg-shadow-blue editbanner">
            <?php  echo $row['name']; ?></span>

          <div class="card-body p-0 m-0">
            <!-- Image column -->
            <div class="row mt-3">
              <div class="col-md-3 mt-3 pt-5">
                <div class="">
                  <div class="card p-0 m-0  border-0">
                    <div class="card-body p-0">
                    <form method="post" enctype="multipart/form-data" id="changeimg" >
                      <img src="../uploads/<?php echo $row['image_name']; ?>" class="avatar img-circle card-img"
                        alt="avatar">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="mt-2">
                        <input class="btn btnadditem ml-5 mt-4" id="btncpass" type="submit" value="Update" name="btncpass"
                        onclick="updateinfo('changeimage',event)">
                    </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <form method="post" id="chgpass">
                  <div class="d-flex justify-content-between border-top border-bottom mt-3 p-2">
                    <h3 class="text-dark font-weight-bold">
                      Change Password</h3>
                    <input class="btn btnadditem mr-4" id="btncpass" type="button" value="Update" name="btncpass"
                      onclick="updateinfo('changepass',event)">
                  </div>
                  <div class="row pb-2 mt-3">
                    <div class="col">
                      <div class="row ml-4">
                        <label for="inputtext" class="col-form-label ml-2 pr-2">OLD Password</label>
                        <div class="col-sm-5">
                          <input type="password" class="form-control" id="oldpass" name="oldpass"
                            placeholder="Enter Old Password">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row pb-2">
                    <div class="col">
                      <div class="row ml-4">
                        <label for="inputtext" class="col-form-label ml-2 pr-2">New Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="newpass" name="newpass"
                            placeholder="Enter New Password">
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label pr-2">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="newpass2" name="newpass2"
                            placeholder="Enter New confirm Password">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <form method="post" id="updateresinfo">
                  <div class="d-flex justify-content-between border-top border-bottom mt-3 p-2">
                    <h3 class="text-dark font-weight-bold">
                      Restaurat info</h3>
                    <input class="btn btnadditem mr-4" id="btnrestinfo" type="button" value="Update" name="btnrestinfo"
                      onclick="updateinfo('restoinfo',event)">
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label pr-2">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="rname" name="rname"
                            value="<?php echo $row['name']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label">Owner Name</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="roname" name="roname"
                            value="<?php echo $row['owner_name']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label ">address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="radd" name="radd"
                            value="<?php echo $row['address']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label pr-2">City</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="rcity" name="rcity"
                            value="<?php echo $row['city']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3 ">
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label pr-2">Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="remail" name="remail"
                            value="<?php echo $row['email']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-sm-2 col-form-label pr-2">Moblie</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="rmoblie" name="rmoblie"
                            value="<?php echo $row['moblie']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3 pb-2">
                    <div class="col">
                      <div class="row">
                        <label for="inputtext" class="col-form-label ">Delivery Charge</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control w-50" id="dcharge" name="dcharge"
                            value="<?php echo $row['delivery_charge']; ?>">
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
  </div>
  <?php include('include/scripts.php'); ?>
  <script>
  function updateinfo(msg,e) {
    e.preventDefault();
    if (msg == "changeimage") {
        var frm = document.getElementById("changeimg");
        var formData = new FormData(frm);
        var fd = document.getElementById("fileToUpload").files[0];
        console.log(fd);
        var imgtype = fd.name.split(".").pop().toLowerCase();
        if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
        Swal.fire({
          icon: "error",
          title: "Error In Image",
          text: "Invalid File Formate!Plz Select Image File"
        });
      } else if (fd.size > 2000000) {
        Swal.fire({
          icon: "error",
          title: "Error In Image",
          text: "Image size is Large!Plz Select Image Below 2 MB"
        });
      } else {
        $.ajax({
          url: "php/edit_profile.php?changeimage=1",
          type: "post",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function (response) {
            location.reload();
          }
        });
      }
      
    }
    if (msg == "restoinfo") {
      $.ajax({
        type: "POST",
        url: "php/edit_profile.php?updateresinfo=1",
        data: $("#updateresinfo").serialize(),
        success: function(response) {
          if (response == "1") {
            Swal.fire({
              icon: 'success',
              title: 'Updated successfully',
            }).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          }
          else{

          }
        }

      });
    }
    if (msg == "changepass") {
      $.ajax({
        type: "POST",
        url: "php/edit_profile.php?cpass=1",
        data: $("#chgpass").serialize(),
        success: function(response) {
          if (response == "1") {
            Swal.fire({
              icon: 'success',
              title: 'Updated successfully',
            }).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          }else{
            Swal.fire({
              icon: 'error',
              title: ''+response,
            })
          }
        }

      });
    }
   
  }
  </script>
</body>

</html>