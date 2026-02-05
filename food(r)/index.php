<?php
include('php/database.php');
if(isset($_SESSION['resid'])){
  header('Location:order.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>RESTAURANT</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--===============================================================================================-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/login.css" />
  <!--===============================================================================================-->
</head>


<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="images/foodify-logo.png" class="m-5" alt="IMG" />
        </div>

        <form class="login100-form validate-form" method="POST">
          <span class="login100-form-title">
            Member Login
          </span>

          <div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>

          <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" id="email" placeholder="Email" />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="pass" id="pass" placeholder="Password" />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="btnlogin" type="button">
              Login
            </button>
          </div>

          <!-- <div class="text-center pt-4">
            <span class="txt1">
              Forgot
            </span>
            <a class="txt2" href="forgotPassword.php">
                Password?
            </a>
          </div> -->

          <div class="text-center  pt-1">
            <a class="txt2" href="singup.php">
              Create Account Register
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--===============================================================================================-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <!--===============================================================================================-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
  <!--===============================================================================================-->
  <script src="https://kit.fontawesome.com/81c959b8a5.js" crossorigin="anonymous"></script>
  <!--===============================================================================================-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  
  <script>
    $(".js-tilt").tilt({
      scale: 1.1
    });
  </script>
  <!--===============================================================================================-->
  <script src="js/login.js"></script>

</body>

</html>