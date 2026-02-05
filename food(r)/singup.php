<!DOCTYPE html>
<html lang="en">

<head>
   <title>Login V1</title>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <!--===============================================================================================-->
   <link rel="stylesheet" href="../include/bootstrap/bootstrap.min.css">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="css/login.css" />
   <!--===============================================================================================-->
   <link href="../include/fontawesome-free-5.12.1/css/fontawesome.css" rel="stylesheet">
   <link href="../include/fontawesome-free-5.12.1/css/regular.css" rel="stylesheet">
   <link href="../include/fontawesome-free-5.12.1/css/brands.css" rel="stylesheet">
   <link href="../include/fontawesome-free-5.12.1/css/solid.css" rel="stylesheet">
</head>

<body>
   <div class="limiter">
      <div class="container-login100">
         <div class="wrap-login100">
            <form class="validate-form" name="resForm" id="resForm" method="post" enctype="multipart/form-data">
               <span class="login100-form-title">
                Register Store
               </span>
               <!-- <div class="alert alert-success" role="alert" id="success" style="display:none;"></div> -->
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">Store Name</label>
                     <div class="wrap-input100 validate-input" data-validate="Restaurant Name is required">
                        <input class="input100" type="text" name="rname" id="rname" placeholder="Store Name" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="far fa-user"></i>
                        </span>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">Store Owner Name</label>
                     <div class="wrap-input100 validate-input" data-validate="Restaurant Owner Name is required">
                        <input class="input100" type="text" name="roname" id="roname" placeholder="Store Owner Name" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-user-tie"></i>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">Email</label>
                     <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" id="email" placeholder="Email" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">Moblie No</label>
                     <div class="wrap-input100 validate-input" data-validate="MoblieNo must have 10 digits">
                        <input class="input100" type="number" name="moblie" id="moblie" placeholder="Moblie No" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-mobile-alt"></i>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">Address</label>
                     <div class="wrap-input100 validate-input" data-validate="Address is required">
                        <input class="input100" type="text" name="add" id="add" placeholder="Address" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-address-card"></i>
                        </span>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">City</label>
                     <div class="wrap-input100 validate-input" data-validate="City is required">
                        <input class="input100" type="text" name="city" id="city" placeholder="City" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-city"></i>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">Password</label>
                     <div class="wrap-input100 validate-input" data-validate="Password mitchmatch">
                        <input class="input100" type="text" name="pass" id="pass" placeholder="Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-lock"></i>
                        </span>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">Confirm Password</label>
                     <div class="wrap-input100 validate-input" data-validate="Password mitchmatch">
                        <input class="input100" type="text" name="pass2" id="pass2" placeholder="Confirm Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-lock"></i>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-5">
                     <label for="inputEmail4">Delivery Charge</label>
                     <div class="wrap-input100 validate-input" data-validate="Delivery Charge is required">
                        <input class="input100" type="text" name="dcharge" id="dcharge" placeholder="Delivery Charge" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                           <i class="fas fa-lock"></i>
                        </span>
                     </div>
                  </div>
                  <div class="form-group col-md-7">
                     <label class="mt-2"><b>Upload Image:</b></label>
                        <div class="custom-file">
                           <input type="file" class="custom-file-input " id="file" name="file" onclick="dispfname()" >
                           <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                  </div>             
               </div>
               <div class="alert alert-danger" role="alert" id="err" style="display:none;"></div>

               <div class="container-login100-form-btn">
                  <input type="submit" class="login100-form-btn"  id="btnsubmit" name="submit" value="Register">
               </div>
               <div class="text-center  pt-1">
                  <a class="txt2" href="index.php">
                     Already Account login?
                     <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                  </a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--===============================================================================================-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <!--===============================================================================================-->
   <!-- <script src="include/jquery/tilt.jquery.min.js"></script> -->
   <!--===============================================================================================-->
   <!--===============================================================================================-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <!--===============================================================================================-->
   <script src="js/login.js"></script>
   <script>
    function dispfname() {
      $(".custom-file-input").on("change", function () {
    var fileName = $(this)
      .val()
      .split("\\")
      .pop();
    $(this)
      .siblings(".custom-file-label")
      .addClass("selected")
      .html(fileName);
  });
    }
   </script>
</body>

</html>