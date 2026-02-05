<?php
include 'database.php';
if(isset($_POST['id']) and isset($_POST['msg'])){
    if($_POST['id'] == $_SESSION['uid']){
        // $sql="SELECT * FROM `tbl_order` where r_id=".$_SESSION['resid']." AND order_status='new'";
        // $result=mysqli_query($conn,$sql);
        // $row = mysqli_fetch_assoc($result)
        echo "1";
    }
}
?>
