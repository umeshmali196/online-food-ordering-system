<?php
include("database.php"); 


if(isset($_GET['cpass'])){
  $oldpass=$_POST['oldpass'];
  $newpass=$_POST['newpass'];
  $newpass2=$_POST['newpass2'];
  $sql = "SELECT * FROM restaurants where res_id=".$_SESSION['resid']."";  
  $result = mysqli_query($conn, $sql);  
  $row = mysqli_fetch_assoc($result);
  if($oldpass == $row['pass'])
  {
      if($newpass == $newpass2)
      {
          $sql = "UPDATE restaurants SET pass='$newpass' WHERE res_id=".$_SESSION['resid']."";
            if (mysqli_query($conn, $sql)) 
            {
              echo "1";
            }
            else
            {
                echo "Error updating record: " . mysqli_error($conn);
            }      
      }
      else
      {
          echo "Password is Mitmatch";
      }
  }
  else
  {
    echo "Old Password Is wroung";
  }
}
if(isset($_GET['updateresinfo'])){
  $rname=$_POST['rname'];
  $roname=$_POST['roname'];
  $email=$_POST['remail'];
  $moblie=$_POST['rmoblie'];
  $add=$_POST['radd'];
  $city=$_POST['rcity'];
  $dcharge=$_POST['dcharge'];
  $sql = "UPDATE restaurants SET name='$rname',owner_name='$roname',email='$email',moblie='$moblie',address='$add',city='$city',delivery_charge=$dcharge WHERE res_id=".$_SESSION['resid']."";
  if (mysqli_query($conn, $sql)) {
      echo "1";
  } else {
      echo "Error updating record: " . mysqli_error($conn);
  }
}
if(isset($_GET['changeimage'])){

    $target_dir = "../../uploads/";

    $sql = "SELECT * FROM restaurants WHERE res_id=".$_SESSION['resid'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $imgname=$row['image_name'];

      $target_file = $target_dir  . $imgname;
        if (file_exists($target_file)){
            unlink($target_file);
        }


        $name=date("(Y-m-d)(h-i-s)");
        $target_file = $target_dir  . $name . basename($_FILES["fileToUpload"]["name"]);
        $imagename= $name . basename($_FILES["fileToUpload"]["name"]);
        // $imagename= basename($_FILES["fileToUpload"]["name"]);


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $sql = "UPDATE restaurants SET image_name='$imagename' WHERE res_id=".$_SESSION['resid']."";
      if (mysqli_query($conn, $sql)) {
        echo "1";
      } 
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
}
?>