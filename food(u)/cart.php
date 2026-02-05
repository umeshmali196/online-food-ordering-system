<html>
<head>
  <title>FOODIFY</title>
  <?php include 'php/database.php'; ?>
  <?php include_once ('include/links.php'); ?>
  <link rel="stylesheet" href="css/cart.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <?php include ('include/scripts.php'); ?>

</head>

<body class="bg-color">
  <?php include_once ("include/header.php"); ?>
  <div class="px-2 mx-4 p-0" style="margin-top:6%;">
    <?php
if (!empty($_SESSION["shopping_cart"]))
{
?>
    <div class="row">
      <div class="col-lg-8 ">
        <ul class="timeline">
          <?php
    if (!isset($_SESSION['uid']))
    {
?>
          <li>
            <div class="card">
              <div class="heading mt-3 ml-3">
                <h3>Login</h3>
              </div>
              <div class="card-body">
                <button type="button" class="btn btn-outline-dark font-weight-bold w-50 mt-3"
                  style="background-color: #fc8019;" data-toggle="modal" data-target="#loginmodal">LOGIN</button>
              </div>
            </div>
          </li> <?php
    } ?>


          <li>
            <div class="card">
              <!-- <div class="heading">
                                    <h3 id="deliveryhead1">Choose a delivery address</h3>
                                </div> -->
              <div class="card-body">
                <?php if (isset($_SESSION['selAddess']))
    { ?>
                <div class='d-flex'>
                  <h3 class="card-title">Delivery Address</h3>
                  <i class="fas fa-check-circle text-success ml-3 mt-2 fa-lg"></i>
                  <a class="ml-auto px-4 text-warning" onclick="unsetaddress()">Change</a>
                </div>
                <?php
    }
    else
    { ?>
    <div class='d-flex'>
      <h3 class="card-title heading " id='addHead1'>Choose a delivery address</h3>
      <!-- <a class="ml-auto px-4 text-warning font-weight-bold"  data-toggle="modal" data-target="#addmodal">Add New Address</a> -->
    </div>
    <?php
    }
    echo "<div class='row' id='setAddrow'>";
    if (isset($_SESSION['uid']) and !isset($_SESSION['selAddess']))
    {
        $sql = "SELECT * FROM `user_address` where u_id=" . $_SESSION['uid'] . "";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_assoc($result))
            { ?>
                <div class="col-lg-6">
                  <div class="card address-card" style="width:90%;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['add_name']; ?></h5>
                      <p class="card-text">
                        <?php echo $row['add_line'] . "," . $row['landmark'] . "," . $row['city'] . "," . $row['state'] . "-" . $row['pincode']; ?>
                      </p>
                      <button type="button" name="btnadd" id="btnadd" class="btn btn-outline-orange"
                        onclick="setAddress(<?php echo $row['a_id']; ?>)">
                        Deliver Here
                      </button>
                    </div>
                  </div>
                </div>
                <?php
            }
        }
        else
        {
          ?>
           <button type="button" class="ml-5 mt-4 btn btn-outline-orange text-white font-weight-bold text-uppercase" data-toggle="modal" data-target="#addmodal">
                ADD NEW ADDRESS</button>
            
          <?php
            //echo "<a class='btn btn-success mt-4 ml-5' href='profile.php'>Add Address</a>";
        }
    }
    echo "<div id='seletedAddrow'>";
    if (isset($_SESSION['selAddess']))
    {
?>
      <div class="row">
                  <?php
            $sql = "SELECT * FROM `user_address` where a_id=" . $_SESSION['selAddess'] . "";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {
            while ($row = mysqli_fetch_assoc($result))
            { ?>
                  <div class="col-lg-12">
                    <div class="card" style="width:90%;">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['add_name']; ?></h5>
                        <p class="card-text">
                          <?php echo $row['add_line'] . "," . $row['landmark'] . "\n" . $row['city'] . "<br>" . $row['state'] . "-" . $row['pincode']; ?>
                        </p>

                      </div>
                    </div>
                  </div>
                  <?php
            }
        }
        echo "</div>";
    }
    echo "</div>";
?>


                </div>
              </div>
          </li>
          <li>
            <div class="creditCardForm">
              <div class="heading">
                <h3 class="card-title font-weight-bolder text-dark ">Confirm Purchase</h3>
              </div>
              <?php if (isset($_SESSION['selAddess']))
              {
              ?> 
             
              <?php require('php/pay.php'); ?>
              <p style="color: #93959f;font-size: 12px;margin-left:2%">Card details will be saved securely, based of the industry standard</p>
              <?php
              if(isset($_GET['orderstatus'])){
                  echo "<script>
                      location.replace('order.php?razorpay_payment_id=".$_GET['orderstatus']."');
                  </script>";
              }  
              }
            ?>
            </div>
          </li>
        </ul>
      </div>

      <div class="col-lg-4 pt-3  p-0">
        <div class="card p-0 m-0">
          <div class="card-header border pl-2 pr-0 pt-0 bg-transparent border ">
            <?php foreach ($_SESSION["shopping_cart"] as $keys => $values)       
              {
            ?>
            <div class="d-flex flex-row">
            <img class="card-img  rounded-0 mt-3" src="../uploads/<?php echo $values["res_img"]; ?>"
              style="width:25%"></img>
            <a class="h5 pt-3 font-weight-bold ml-2 mt-3" href="resto.php?rid=<?php echo $values['res_id']; ?>"><?php echo $values['res_name']; ?></a>
            <span class="ml-auto"> 
            <a href="php/addtocart.php?clearcart=1" class="btn btn-outline-dark font-weight-bold px-2 py-1 rounded-0 m-3" style="box-shadow: none!important;">Clear Cart</a>
            </span>
            </div>
            <?php
            break;
            }
            ?>

          </div>
          <div class="card-body pt-0 cartitems ">
            <ul class="list-group border-0 ">
              <?php
              $total = 0;
              $sql    = "SELECT * FROM `restaurants` where res_id=".$values["res_id"];
              $result = mysqli_query($conn, $sql);
              $row    = mysqli_fetch_assoc($result);
              $dcharge=$row['delivery_charge'];
              foreach ($_SESSION["shopping_cart"] as $keys => $values)
              {  
                ?>
              <li class="list-group-item p-0 pt-4 border-0">
                <div class="d-flex d-flex justify-content-between">
                  <span class="text-dark font-weight-bold w-100">
                    <?php echo $values["item_name"]; echo "<br>"; ?>
                    <?php echo "<small><b>".$values['menu_name']."</b></small>"; ?>
                  </span>
                  <div class="w-75">
                      <button class="text-success font-weight-bolder bg-white  border border-muted px-2 py-2 btn-shadow" style="font-size: 14px">
                      <a class="fas fa-minus pr-3 text-success font-weight-bolder" href="php/addtocart.php?subqty=<?php echo $values["item_id"]; ?>"></a> 
                      <b class="qty"><?php echo $values["item_quantity"]; ?></b> 
                      <a class="fas fa-plus pl-3 text-success font-weight-bolder" href="php/addtocart.php?addqty=<?php echo $values["item_id"]; ?>"></a>
                      </button>
                      <?php if(isset($_GET['lessqty'])){ ?>
                        <script>
                          Swal.fire({
                            icon: 'error',
                            text: 'No More Quantity in Restaurant',
                            
                          })                        
                       </script>
                     <?php } ?>
                  </div>

                  <b class="float-right ml-auto">₹<?php echo $values["item_price"]; ?></b>
                </div>
              </li>
              <?php
                       $total = $total + ($values["item_quantity"] * $values["item_price"] );
                  }
              ?>
            </ul>
            <?php 
              if(isset($_SESSION['promocode'])){ ?>
                <button class="mt-4 btn-applyoffer py-3" >
                    <img src="img/sale.png" alt="not found" class="ml-4"> 
                    <b class="ml-3 h6 font-weight-bold"><?php echo $_SESSION['promocode']; ?></b>
                    <span class="text-muted font-weight-bold ml-2">Promocode Applied</span>
                    <i class="far fa-times-circle float-right fa-2x mr-2  pb-2" style="margin-top: -4px;" onclick="checkPromocode('unsetpromocode')"></i>
                  </button>
                  <?php
              }else{
                ?>
                  <button class="mt-4 btn-applyoffer py-3" data-target="#couponModal" data-toggle="modal">
                    <img src="img/sale.png" alt="not found" class="ml-4"> 
                    <b class="ml-3 h6 font-weight-bold">Apply Coupon</b>
                  </button>
                <?php
              }
            ?>
           
            <div class="div mt-4 pb-2" style="border-bottom: 2px solid #282c3f;">
              <h6 class=" font-weight-bold border-bottom pb-2 border-muted" style="font-size: medium;">Bill Details</h6>
              <p class="mb-2 font-weight-bold " style="font-size: medium;">Item Total<b class="float-right">₹<?php echo $total; ?></b></p>
              <?php
              if(isset($_SESSION['promocode'])){ ?>
                <p class="mb-2 font-weight-bold text-success" style="font-size: small;">
                  <?php
                  $sql = "SELECT * FROM `offers` where offer_code='".$_SESSION['promocode']."'";
                  $result=mysqli_query($conn,$sql);
                  $row=mysqli_fetch_assoc($result);
                  if($row['discount_type'] == "flat"){
                    echo "<span>Discount Applied (".$_SESSION['promocode'].")</span>"; 
                  }
                  if($row['discount_type'] == "percent"){
                    echo "<span>Discount Applied (".$_SESSION['promocode'].")</span>"; 

                  }
                  ?>
                  <b class="float-right" style="font-size: medium;">-₹<?php echo $_SESSION['promoamount']; ?></b>
                </p>
              <?php
              }
              ?>

              <p class="mb-1 font-weight-bold" style="font-size: medium;">Delivery Charges<b class="float-right">₹<?php echo $dcharge; ?></b></p>
            </div>
          </div>
          <div class="card-footer bg-transparent p-0 px-4 pt-3 border-top border-light">
            <p class="card-text float-left font-weight-bold">TO PAY</p>
            <?php
            if(isset($_SESSION['promocode'])){ ?>
            <p class="card-text float-right">
              <del class="mr-2">₹<?php echo $total+$dcharge ?></del>
              <b class="mr-2">₹<?php echo $total+$dcharge-$_SESSION['promoamount']; ?></b>
              
            </p>

            <?php
            }else{ ?>
            <p class="card-text float-right"><b>₹<?php echo $total+$dcharge ?></b></p>

            <?php
            }
            ?>
          </div>

        </div>

      </div>
    </div>
    <?php
}
else
{
?>
    <div class="w-100 text-center mt-5">
      <img class="mt-5" style="width: 330px;height: 262px;" src="img/emptycart.png"></img>
      <br>
      <h4 class="card-title font-weight-normal mt-5">Your cart is empty</h4>
      <small class="text-muted">You can go to home page to view more restaurants</small>
      <br>
      <button class="gotores" onclick="window.location='index.php'">See restaurants</button>
    </div>

    <?php
}
?>
  </div>
  <div class="modal fade left" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addmodal" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-left" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button " class="close" data-dismiss="modal" aria-label="Close" class="font-weight-bold text-dark d-inline">
                    <span aria-hidden="true">&times;</span>
                </button><br>
            </div>
            <div class="mt-3 ml-3 ">
                <h4 class="text-dark font-weight-bold">ADD NEW ADDRESS</h4>

            </div>
            <div class="modal-body">
                <form id="addForm" method="post">
                    <div class="md-form">
                        <input type="text"  name="addname" class="form-control myinput" required>
                        <label for="addname">Address Name</label>
                    </div>
                    <div class="md-form">
                        <input type="text"  name="addline" class="form-control myinput" required>
                        <label for="addline">Address Line</label>
                    </div>
                    <div class="md-form">
                        <input type="text"  name="landmark" class="form-control myinput" required>
                        <label for="landmark">Landmark</label>
                    </div>
                    <div class="md-form">
                        <input type="text"  name="city" class="form-control myinput" required>
                        <label for="city">City</label>
                    </div>
                    <div class="md-form">
                        <input type="text"  name="state" class="form-control myinput" required>
                        <label for="state">State</label>
                    </div>
                    <div class="md-form">
                        <input type="number" maxlength="6"  name="pincode" class="form-control myinput" required>
                        <label for="pincode">Pincode</label>
                    </div>

                    <div class="justify-content-center md-form">
                        <button type="submit" class="btn text-white font-weight-bold w-100 mt-3" style="background-color: #fc8019;" onclick="addAddress(event)">ADD ADDRESS</button>
                    </div>
                    <div class="alert alert-danger mt-3 " role="alert" id="alerterror2">
                        <strong id="signuperr" class="text-lowercase"></strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade right" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="couponModal"
    aria-hidden="true">

    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button " class="close" data-dismiss="modal" aria-label="Close"
                    class="font-weight-bold text-dark d-inline">
                    <span aria-hidden="true">&times;</span>
                </button><br>
            </div>
            <div class=" ml-3 ">
                <h4 class="text-dark font-weight-bold">Apply Coupon</h4>
            </div>
            <div class="modal-body">
                <form class="offerForm mt-3">
                    <div class="inputDiv">
                        <input class="offerinput" type="text" id="txtcode" placeholder="Enter coupon code" maxlength="50" style="text-transform:uppercase">
                    </div>
                    <span class="text-danger ml-1 mt-2 font-weight-bold" id="offerErr" style="display: none"></span>
                    <a class="btnapplyoffer" id="btnapply">APPLY</a>
                </form>
                <h6 class="mt-5"  style="color: #7e808c;font-weight: 600;text-transform: uppercase;">Available Coupons</h6>
                <?php
                 $sql="SELECT * FROM `offers` where status=1";
                 $result = mysqli_query($conn, $sql);
                 if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="card mt-3 ">
                      <div class="card-body" style="border: 1px solid #e9e9eb;">
                        <span class="offerName px-3 py-1"><?php echo $row['offer_code']; ?></span>
                        <h6 class="font-weight-bold mt-3"><?php echo $row['offer_text']; ?></h6>
                          <p class="text-muted font-weight-bold mb-2">
                            <?php 
                              echo "This Offer is Valid On Minmum Order ₹".$row['min_amount']."";
                            ?>
                          </p>
                          <p class="text-muted font-weight-bold mb-2">
                            <?php
                            if($row['discount_type'] == "flat"){
                              echo "Flat Discount of ₹".$row['flat_discount_amount']; 
                            }
                            if($row['discount_type'] == "percent"){
                              echo "Discount of ₹".$row['discount_percentage']." UP TO ₹".$row['max_discount_amount']."";           
                            }
                            ?>
                          </p>
                          
                          <p class="text-muted font-weight-bold mb-1">
                            <?php 
                            if($row['valid_user'] == "newuser") {
                              echo "This Offer Is Only For New  User";
                            }else{
                              echo "This Offer Is For All User";
                            }
                            ?>
                          </p>
                          <p class="text-muted font-weight-bold mt-1">
                          <?php
                            $date=strtotime($row['expire_time']);
                            echo "Offer Expire Time is ".date("d F,Y h:i a",$date);
                          ?></p>
                        <button class="btn btnapply px-3 py-2 mt-2 ml-0" onclick="checkPromocode('<?php echo $row['offer_code']; ?>');">APPLY COUPON</button>
                      </div>
                    </div>
                    <?php
                    }
                  } else {
                    echo "0 results";
                  }
                ?>
            </div>
        </div>
    </div>
  </div>

  </div>
  <?php include_once "login.php"; ?>
  <?php include_once "signup.php"; ?>
  <!-- <script src="include/js/jquery.payform.min.js" charset="utf-8"></script> -->
  <script type="text/javascript" src="js/cart.js"></script>
</body>

</html>
