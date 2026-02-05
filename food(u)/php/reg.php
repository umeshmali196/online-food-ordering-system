<?php
include 'database.php';

if (isset($_POST['moblie'])) {
    $name = $_POST['name'];
    $moblie = $_POST['moblie'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if ($name == "" or $moblie == "" or $email == "" or $pass == "") {
        echo "All Flied Are Required";
    } else {
        if(preg_match('/^[0-9]{10}+$/', $moblie) and filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = "SELECT * FROM `user` where email='$email' or moblie=$moblie";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) == 0){
                $sql = "INSERT INTO `user`( `name`, `email`, `moblie`, `pass`)values('$name','$email','$moblie','$pass')";
                if (mysqli_query($conn, $sql)) {
                    $sql2 = "SELECT * FROM `user` WHERE email='$email' and pass='$pass'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $_SESSION['uid'] = $row2['u_id'];
                    echo "1";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }else{
                echo "Moblie No Or Email Id Already Taken";
            }
           
        }else{
            echo "Invalid Moblie No Or Email Id";
        }
        
    }
}
if (isset($_POST['addname'])) {
    $uid = $_SESSION['uid'];
    $addname = $_POST['addname'];
    $addline = $_POST['addline'];
    $landmark = $_POST['landmark'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

        $sql = "INSERT INTO `user_address`(`u_id`,`add_name`, `add_line`, `landmark`, `city`, `state`, `pincode`)
                                values($uid,'$addname','$addline','$landmark','$city','$state','$pincode')";
        if (mysqli_query($conn, $sql)) {
            echo "1";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}
if (isset($_POST['Update_add_name'])) {
    $aid = $_POST['aid'];
    $addname = $_POST['Update_add_name'];
    $addline = $_POST['addline'];
    $landmark = $_POST['landmark'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

    $sql = "  
           UPDATE user_address   
           SET add_name='$addname',   
           add_line='$addline',   
           landmark='$landmark',   
           city = '$city',   
           state = '$state', 
           pincode = '$pincode'     
           WHERE a_id=$aid";  
           if (mysqli_query($conn, $sql)) {
            echo "1";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}
if (isset($_POST['Update_email'])){
    $name = $_POST['update_name'];
    $email = $_POST['Update_email'];
    $moblie = $_POST['Update_moblie'];
    $sql = "UPDATE user SET name='$name',email='$email',moblie='$moblie' WHERE u_id=".$_SESSION['uid'];  
        if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['deleteaddress'])){
    $aid=$_GET['deleteaddress'];
    $sql = "DELETE FROM user_address WHERE a_id=$aid";
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
if(isset($_GET['getAdd'])){
    $aid=$_GET['getAdd'];
    $query = "SELECT * FROM user_address WHERE a_id=$aid";  
    $result = mysqli_query($conn, $query);  
    $row = mysqli_fetch_array($result);  
    echo json_encode($row); 
}
if(isset($_GET['setAddSession'])){
    $_SESSION['selAddess']=$_GET['setAddSession'];
}
if(isset($_GET['unsetAddSession'])){
    unset($_SESSION['selAddess']);
}
if(isset($_GET['setfavrid'])){
    $rid=$_GET['setfavrid'];
    $uid=$_SESSION['uid'];
    $sql = "INSERT INTO `favourite`( `res_id`, `u_id`)values($rid,$uid)";

    if (mysqli_query($conn, $sql)) {
       echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['unsetfavrid'])){
    $fid=$_GET['unsetfavrid'];
    // $uid=$_SESSION['uid'];
    $sql = "DELETE FROM `favourite` WHERE f_id=$fid";

    if (mysqli_query($conn, $sql)) {
       echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['setrate'])){
    $rid=$_GET['raterid'];
    $rate=$_GET['setrate'];
    $oid=$_GET['rateoid'];

    $sql = "INSERT INTO `feedback`( `res_id`, `o_id`, `rate`)values($rid,$oid,$rate)";

    if (mysqli_query($conn, $sql)) {
       echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
