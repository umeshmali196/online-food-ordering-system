<?php
include('php/database.php');
if(isset($_SESSION['resid'])){
  header('Location:order.php');
}
if(!isset($_GET['email'])){
    die("Wrong Reset Password Url");
}else{
    $email=$_GET['email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login V1</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--===============================================================================================-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/login.css" />
  <!--===============================================================================================-->
  <style>
  .loader {
  border: 8px solid #f3f3f3; /* Light grey */
  border-top: 8px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 2s linear infinite;
  position: absolute;
  left:50%;
  top:50%;
  /* display: none; */
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  </style>
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="images/img-01.png" alt="IMG" />
        </div>

        <form class="login100-form validate-form" method="POST">
          <span class="login100-form-title">
          Reset PASSWORD
          </span>
          <div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>
          <div class="loader"></div>
            <input type="hidden" name="email" value="<?php echo $email; ?>" id="email"/>
          <div class="wrap-input100 validate-input" data-validate="Valid Password is required">
            <input class="input100" type="text" name="password" id="password" placeholder="password" />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          <div class="wrap-input100 validate-input" data-validate="Valid Password is required">
            <input class="input100" type="text" name="confirmpassword" id="confirmpassword" placeholder="confirmpassword" />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="btnresetPass" type="button">
            Reset
            </button>
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
  <script>
    // $(".loader").hide();
    $( document ).ready(function() {
      $(".loader").hide();
    });
    $('#btnresetPass').on('click',function(){
      $("#error").hide();
      var email = $('#email').val();   
      var password = $('#password').val();   
      var confirmpassword = $('#confirmpassword').val();   
      $(".loader").show();
          $.ajax({
            url: "php/ResetPassword.php",
            type: "POST",
            data: {email: email,password: password,confirmpassword: confirmpassword},
            success: function(dataResult){
                if (dataResult == "1") {
                 
                    Swal.fire({
                          icon: 'success',
                          text: 'Password Reset Successful',
                      })
                      $(".loader").hide();
                      window.location.replace("http://localhost/Food%20Project/food(r)/");
                        
                } else{
                  $(".loader").hide();

                  $("#error").show();
                  $('#error').html(dataResult);
                }
            }
          });
    });
  </script>
  <!-- <script src="js/login.js"></script> -->

</body>

</html>