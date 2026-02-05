<?php
$servername = "localhost";
$username = "root";
$password = "umesh2004";   // इथे तुमचा phpMyAdmin password टाका
$dbname = "food";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>