<?php
include('database.php');
$keyId = 'rzp_test_2ihJwukcUV5kBI';
$keySecret = '2IizfyMQdnRD2QaMZGHj8gcl';
$displayCurrency = 'INR';

require('../../include/razorpay-php/Razorpay.php');
require __DIR__ . '/../../include/pusher/vendor/autoload.php';
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);

if(isset($_GET['orderaccept'])){
  $oid= $_GET['orderaccept'];
  $sql = "SELECT * FROM `payment`  WHERE o_id=$oid";
  $result=mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);


  $payment = $api->payment->fetch($row['rozarpay_id']);
  $payment->capture(array('amount' => $payment['amount'], 'currency' => 'INR'));
  $sql = "UPDATE tbl_order SET order_status='preparing' WHERE o_id=$oid";
  $data['message'] =  "Your Order Accepted And Now It Preparing.";
}
if(isset($_GET['orderreject'])){
  $oid= $_GET['orderreject'];

  $sql = "SELECT * FROM `payment`  WHERE o_id=$oid";
  $result=mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);


  $payment = $api->payment->fetch($row['rozarpay_id']);
  $payment->capture(array('amount' => $payment['amount'], 'currency' => 'INR'));
  $refund = $payment->refund();

  $sql = "UPDATE payment SET status='refunded' WHERE o_id=$oid";
  mysqli_query($conn, $sql);

  $sql = "UPDATE tbl_order SET order_status='rejected' WHERE o_id=$oid";
  $data['message'] =  "Your Previous Order is  Rejected.";
}
if(isset($_GET['orderready'])){
  $oid= $_GET['orderready'];
  $sql = "UPDATE tbl_order SET order_status='ontheway' WHERE o_id=$oid";
  $data['message'] = "Your Order is Now out for Delivery.";
}
if(isset($_GET['deliverd'])){
  $oid= $_GET['deliverd'];
  $sql = "UPDATE tbl_order SET order_status='deliverd' WHERE o_id=$oid";
  $data['message'] =  "Your Order is Deliverd Enjoy Food And Rate The Order.";
}

if (mysqli_query($conn, $sql)) {
  echo "1";
  $query = "SELECT * FROM tbl_order WHERE o_id=$oid";  
  $result = mysqli_query($conn, $query);  
  $row = mysqli_fetch_array($result);

  $data['id'] = $row['u_id'];
  
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
  $pusher->trigger('user-channel', 'user-event', $data);
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
?>