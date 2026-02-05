<?php
 include 'database.php';
if(isset($_GET['razorpay_payment_id'])){
  $flag=0;
  date_default_timezone_set('Asia/Kolkata');
  $total = 0;
  if(isset($_SESSION['promocode'])){
    $discount=$_SESSION['promoamount'];
  }else{
    $discount=0;
  }
  $uid=$_SESSION['uid'];
  $a_id= $_SESSION['selAddess'];
  
 
  foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      $total = $total + ($values["item_quantity"] * $values["item_price"]);
      $resid=$values['res_id'];
      $sql    = "SELECT * FROM `restaurants` where res_id=$resid";
      $result = mysqli_query($conn, $sql);
      $row    = mysqli_fetch_assoc($result);
  }
  $dcharge=$row['delivery_charge'];
  $total=$total+$dcharge-$discount;
  $currentTime = date( 'Y-m-d h:i:s', time () );
  $sql = "INSERT INTO tbl_order (u_id, r_id,a_id,order_status,subtotal,discount,grand_total)
          VALUES ($uid,$resid,$a_id,'new',$total,$discount,$total)";
  if (mysqli_query($conn, $sql)) {
      $last_id = mysqli_insert_id($conn);
      foreach ($_SESSION["shopping_cart"] as $keys => $values) {
          $i_id=$values["item_id"];
          $qty=$values["item_quantity"];
          $price= $values["item_price"];
          $sql2 ="INSERT INTO orderd_item_details (o_id, i_id, quantity,price)
              VALUES ($last_id,$i_id,$qty,$price)";
          if (mysqli_query($conn, $sql2)) {
            $flag=1;
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
      }
      

  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  if($flag == "1"){
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
    
    
    $rozarpayid=$_GET['razorpay_payment_id'];

    $sql="SELECT MAX(o_id) FROM tbl_order";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $o_id=$row['MAX(o_id)'];

    $sql="SELECT * FROM tbl_order where o_id=$o_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $amount=$row['subtotal'];

    $data['id'] = $row['r_id'];
    $data['message'] = 'New Order Recevied';
    $pusher->trigger('my-channel', 'my-event', $data);

    $sql="INSERT INTO payment (o_id,rozarpay_id,amount,status) VALUES ($o_id,'$rozarpayid',$amount,'success')";
    if (mysqli_query($conn, $sql)) {
        header("Location:../order.php?order=1");
    }else{
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   
  }else{
    echo "no";
  } 
}

?>