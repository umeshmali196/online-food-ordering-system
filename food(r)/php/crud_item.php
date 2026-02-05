<?php
include 'database.php';

if(isset($_POST['insert'])){
    $target_dir = "../../uploads/";

    $name=date("(Y-m-d)(h-i-s)");

    $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
    $imagename=$name . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $cid=$_POST['catname'];
        $name=$_POST['name'];
        $desc=$_POST['desc'];
        $price=$_POST['price'];
    if($_POST['qty'] != ""){
        $qty=$_POST['qty'];
        $sql = "INSERT INTO `item`( `item_name`, `item_desc`, `m_id`, `price`,`quantity`,`res_id`,`image_name`,`availability`) 
        VALUES ('$name','$desc',$cid,$price,'$qty',$resid,'$imagename',1)";

    }else{
        $sql = "INSERT INTO `item`( `item_name`, `item_desc`, `m_id`, `price`,`res_id`,`image_name`,`availability`) 
        VALUES ('$name','$desc',$cid,$price,$resid,'$imagename',1)";
    }
    
        if (mysqli_query($conn, $sql)) {
            echo "1";
            require __DIR__ . '/../../include/pusher/vendor/autoload.php';
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
              );
              $pusher = new Pusher\Pusher(
                '7e8468813b5c9a27343c',
                'ba1207b37c0b499a60d3',
                '974010',
                $options
              );
              $data['message']='New Item Added';
              $pusher->trigger('admin-channel', 'admin-event', $data);
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    

    
}
	
if(isset($_POST['update'])){
    if($_FILES["changefile"]["error"] != 4)
    {
        $id=$_POST['id'];
        $sql = "SELECT * FROM item WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $target_dir = "../../uploads/";

        $imgname=$row['image_name'];
        $target_file = $target_dir  . $imgname;
        if (file_exists($target_file)){
            unlink($target_file);
        }
        $name=date("(Y-m-d)(h-i-s)");
        $target_file = $target_dir  . $name . basename($_FILES["changefile"]["name"]);
        $imagename=$name . basename($_FILES["changefile"]["name"]);
    
        $cid=$_POST['catname'];
        $name=$_POST['name'];
        $desc=$_POST['desc'];
        $price=$_POST['price'];
        if (move_uploaded_file($_FILES["changefile"]["tmp_name"], $target_file)) {
            if($_POST['qty'] != ""){
                $qty=$_POST['qty'];
                $sql = "UPDATE `item` SET  `item_name`='$name', `item_desc`='$desc', `m_id`=$cid, `price`=$price,`quantity`='$qty',image_name='$imagename'
                WHERE id=$id";
            }
            else{
                $sql = "UPDATE `item` SET  `item_name`='$name', `item_desc`='$desc', `m_id`=$cid, `price`=$price,image_name='$imagename'
                WHERE id=$id";
            }
            
            if (mysqli_query($conn, $sql)) {
                echo "1";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }else{
        $id=$_POST['id'];
        $cid=$_POST['catname'];
        $name=$_POST['name'];
        $desc=$_POST['desc'];
        $price=$_POST['price'];
        if($_POST['qty'] != ""){
            $qty=$_POST['qty'];
            $sql = "UPDATE `item` SET  `item_name`='$name', `item_desc`='$desc', `m_id`=$cid, `price`=$price,`quantity`='$qty'
            WHERE id=$id";
        }
        else{
            $sql = "UPDATE `item` SET  `item_name`='$name', `item_desc`='$desc', `m_id`=$cid, `price`=$price
            WHERE id=$id";
        }
            if (mysqli_query($conn, $sql)) {
                echo "1";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
    }
    
    
    
}
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $sql = "SELECT * FROM item WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $target_dir = "../../uploads/";
    $imgname=$row['image_name'];
    $target_file = $target_dir  . $imgname;
    // $target_file = $_POST['delete_file'];
    if (file_exists($target_file)) {
        unlink($target_file);
        
    } 
    $sql = "DELETE FROM item WHERE id=$id;";

        if ($conn->query($sql) === TRUE) {
            echo "1";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

}
if(isset($_GET['remove_qty'])){
    $id= $_GET['remove_qty'];
    $sql = "UPDATE `item` SET  `quantity`= NULL WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>