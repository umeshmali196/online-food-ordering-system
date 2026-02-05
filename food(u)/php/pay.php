<?php

require('php/config.php');
require('../include/razorpay-php/Razorpay.php');

// Create the Razorpay Order
$total=0;
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    $total = $total + ($values["item_quantity"] * $values["item_price"]);
    $resid=$values['res_id'];
    $sql    = "SELECT * FROM `restaurants` where res_id=$resid";
    $result = mysqli_query($conn, $sql);
    $row    = mysqli_fetch_assoc($result);
}
if(isset($_SESSION['promocode'])){
    $dcharge=$row['delivery_charge'];
    $total=$total+$dcharge-$_SESSION['promoamount'];
}else{
    $dcharge=$row['delivery_charge'];
    $total=$total+$dcharge;
}



$orderData = [
    'receipt'         => 3456,
    'amount'          => $total * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 0 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}
$sql = "SELECT * FROM `user` where u_id=" . $_SESSION['uid'] . "";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $row['name'],
    "description"       => "",
    "image"             => "https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433_960_720.png",
    "prefill"           => [
    "name"              => $row['name'],
    "email"             => $row['email'],
    "contact"           => $row['moblie'],
    ],
    "notes"             => [
    "address"           => $_SESSION['selAddess'],
    "merchant_order_id" => "",
    ],
    "theme"             => [
    "color"             => "#3b3d3f"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
?>
<form action="php/verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    value=20
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <!-- <input type="submit" value="Pay Now" class="razorpay-payment-button"> -->
  <input type="hidden" name="shopping_order_id" value="3456">
</form>
<script>
$(document).ready(function() {
    $('.razorpay-payment-button').prop("value", "PAY  ₹<?php echo $total; ?>");
});
</script>

<?php
?>
