<?php
require('config.php');
include 'database.php';
require('../../include/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    // $html = "<p>Your payment was successful</p>
    //          <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
    $rozarpayid=$_POST['razorpay_payment_id'];

    header("Location:insert_order.php?razorpay_payment_id=$rozarpayid");
}
else
{
    //$rozarpayid=$_POST['razorpay_payment_id'];
    //$sql="INSERT INTO payment (rozarpay_id, status)VALUES ($rozarpayid, 'faild')";
    //if (mysqli_query($conn, $sql)) {
        $html = "<p>Your payment failed</p>
        <p>{$error}</p>";
         echo $html;

    // }else{
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
    
}


