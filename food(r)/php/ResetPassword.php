<?php
include 'database.php';
$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0;
$encryption_key = "Ravi786";
$decryption_iv = '1234567891011121'; 
// Store the decryption key 
$decryption_key = "Ravi786"; 
$encryption=$_POST['email'];
// Use openssl_decrypt() function to decrypt the data 
$decryption=openssl_decrypt ($encryption, $ciphering,  
        $decryption_key, $options, $decryption_iv); 

// // Display the decrypted string 
// echo "Decrypted String: " . $decryption;

$sql = "SELECT * FROM `restaurants` WHERE email='$decryption'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    if($_POST['password'] == $_POST['confirmpassword']){
        $pass=$_POST['password'];
        $sql2 = "UPDATE restaurants SET pass='$pass' WHERE email='$decryption'";
        if (mysqli_query($conn, $sql2)) {
            echo "1";
        }else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }else{
        echo "Password & confirm Password Are Not Match";
    }
}else{
    echo "Worng Email";
}
?>