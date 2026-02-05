<?php
session_start();
include 'database.php';

$email = $_POST['email'];
$pass  = $_POST['pass'];

$sql = "SELECT * FROM s_admin WHERE email='$email' AND pass='$pass'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['aid'] = $row['id'];
    echo "1";
    header("Location: dashboard.php");  // तुमचं actual dashboard file नाव असेल तर तिथे बदला
} else {
    echo "Wrong Email or Password";
}

mysqli_close($conn);
?>