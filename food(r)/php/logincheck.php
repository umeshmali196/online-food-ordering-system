<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
     include 'database.php'; 
     if(isset($_POST['pass']) and isset($_POST['email'])) {
         $email=$_POST['email'];
         $pass=$_POST['pass'];
         $sql = "SELECT * FROM `restaurants` WHERE email='$email' and pass='$pass'";
         $result = mysqli_query($conn, $sql);
         if(mysqli_num_rows($result) > 0)
         {
         $row = mysqli_fetch_assoc($result);
         $_SESSION["resid"] =$row['res_id'];        
         echo "1";
         }
         else{
            echo "wrong Email or Password";
         }
     } 
     else {
      $email=$_POST['email'];
      

      $sql = "SELECT * FROM `restaurants` WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
         if(mysqli_num_rows($result) > 0)
         { 
             $row=mysqli_fetch_assoc($result);
             $pass=$row['pass'];
             $email=$row['email'];
             $ciphering = "AES-128-CTR"; 
             $iv_length = openssl_cipher_iv_length($ciphering); 
             $options = 0;
             $encryption_iv = '1234567891011121';
             $encryption_key = "Ravi786"; 
             $encryption = openssl_encrypt($email, $ciphering, 
                                                 $encryption_key, $options, $encryption_iv); 
             $url="localhost/Food%20Project/food(r)/resetPassword.php?email=".$encryption;
             require_once "../../include/vendor/autoload.php";

            //PHPMailer Object
            $mail = new PHPMailer(true);
           
            //From email address and name
            $mail->From = "ravinavadiya374@gmail.com";
            $mail->FromName = "Spiffy";

            //To address and name
            $mail->addAddress($_POST['email']); 

            //Address to which recipient will reply
            $mail->addReplyTo("ravinavadiya374@gmail.com", "Reply");

            //Send HTML or Plain Text email
            $mail->isHTML(true);
            $mail->Subject = 'Forgot Password';
            $mail->Body    = 'Reset Password Link <a  target="_blank" href="'.$url.'">Reset Password</a>';
            try {
                $mail->send();
                echo "1";
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            
         }
         else{
            echo "Email Address Is Not Register";
         }
      } 

	  
    mysqli_close($conn);
?>