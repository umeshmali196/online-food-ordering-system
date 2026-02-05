<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "umesh2004";
$dbname = "food";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>