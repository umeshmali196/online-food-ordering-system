<?php
include('database.php');
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    if($_GET['action'] == 1){
        $sql = "UPDATE item SET availability=1 WHERE id=$id";
    
    }
    if($_GET['action'] == 0){
        $sql = "UPDATE item SET availability=0 WHERE id=$id";
    
    }
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT * FROM item where availability=0 and res_id=$resid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($result);
        echo "<button 
                class='text-right p-2 text-uppercase border bg-blue text-white font-weight-bold float-right border-0'>
                Out Of Stock Items ( $row )
             </button>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
if(isset($_GET['resaction'])){
    if($_GET['resaction'] == 1){
        $sql = "UPDATE `restaurants` SET availability=1 WHERE res_id=".$_SESSION['resid']."";
    
    }
    if($_GET['resaction'] == 0){
        $sql = "UPDATE `restaurants` SET availability=0 WHERE res_id=".$_SESSION['resid']."";
    
    }
    if (mysqli_query($conn, $sql)) {
        echo "1";
    }else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>