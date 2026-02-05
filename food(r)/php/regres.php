<?php
     include 'database.php';  
     $rname=$_POST['rname'];
	 $roname=$_POST['roname'];
	 $email=$_POST['email'];
     $moblie=$_POST['moblie'];
     $add=$_POST['add'];
     $city=$_POST['city'];
     $pass=$_POST['pass'];
     $dcharge=$_POST['dcharge'];
     $sql = "SELECT * FROM `restaurants` WHERE email='$email' or moblie='$moblie'";
     $result = mysqli_query($conn, $sql);

     if(mysqli_num_rows($result) == 0)
     {
        
        $target_dir = "../../uploads/";

        $name=date("(Y-m-d)(h-i-s)");
    
        $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
        $imagename=$name . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO `restaurants`( `name`, `city`, `address`, `email`,`pass`, `moblie`, `owner_name`,`delivery_charge`,`image_name`) 
            VALUES ('$rname','$city','$add','$email','$pass',$moblie,'$roname',$dcharge,'$imagename')";
            if (mysqli_query($conn, $sql)) {
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
                  $data['message']='New Restaurant Added';
                  $pusher->trigger('admin-channel', 'admin-event', $data);
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);

            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
     }
     else{
        echo " Email  or Moblie already Exits";
     }
	
    mysqli_close($conn);
?>