<?php
include('database.php');
if(isset($_GET['sid']))
{
    $id=$_GET['sid'];
    $sql = "SELECT COUNT(id) FROM item where m_id=$id and res_id=$resid;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $total = $row[0];
    }
    else {
        echo "0";
    }
    
    echo $total;

}
if(isset($_GET['did']))
{
    $id=$_GET['did'];
    $sql = "DELETE FROM menu WHERE m_id=$id;";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}
if(isset($_GET['uid']) and isset($_GET['ucname']))
{
    $id=$_GET['uid'];
    $cname=$_GET['ucname'];
    $sql = "UPDATE menu SET m_name='$cname' WHERE m_id=$id;";
    //echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Record Updated successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}


?>
