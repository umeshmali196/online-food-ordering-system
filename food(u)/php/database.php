<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food";
$cert_path = './cacert.pem'; 

// Create connection
//$conn = mysqli_connect($servername, $username, $password, $dbname);

$conn = mysqli_connect($servername, $username, $password, $dbname, 3306, $cert_path);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>