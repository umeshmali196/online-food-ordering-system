<?php
include 'database.php';   
unset($_SESSION['promocode']);
unset($_SESSION['promoamount']);
unset($_SESSION["uid"]);
unset($_SESSION["selAddess"]);
echo "<script>history.back();</script>";
?>