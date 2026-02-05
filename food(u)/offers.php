<?php
include "php/database.php";

?>
<html>

<head>
    <title>FOODIFY</title>
    <?php include_once('include/links.php'); ?>

    <link rel="stylesheet" href="css/offers.css" />
    <link rel="stylesheet" href="css/navbar.css" />
</head>

<body>
    <?php include_once("include/header.php"); ?>
    <div class="container-fluid" style="margin-top:4%;">
        <div class="row offerbanner ">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <h1 class="text-white font-weight-bold" style="margin-top:2%; margin-left:4%;">Offers For You</h1>
                <p class="text-light font-weight-bold" style="margin-left:4%;">Explore top deals and offers exclusively
                    for you!
                </p>
               
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <img src="img/100.png" class="imgoffer mr-5 float-right" style="width: 40%"  />
            </div>
        </div>
    </div>

    <div class="container-fluid"  style="margin-top: 6%">
        <div class="row">
            <?php
            $sql="SELECT * FROM `offers` where status=1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card text-dark font-weight-bold bg-white mb-3" style="width: 100%;">
                        <div class="card-header text-center bg-transparent">
                                <span class="offerName px-3 py-1"><?php echo $row['offer_code']; ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-dark font-weight-bold">
                            <?php echo $row['offer_text']; ?>
                            </h5>
                            <p class="text-dark mb-1 font-weight-normal">
                            <?php 
                            if($row['valid_user'] == "newuser") {
                              echo "This Offer Is Only For New  User.";
                            }else{
                              echo "This Offer Is For All User.";
                            }
                            ?>
                            </p>
                            <p class="font-weight-normal text-dark">
                            <?php echo "Use code <u class='font-weight-bold'>".$row['offer_code']."</u> & get "; 
                            if($row['discount_type'] == "flat"){
                              echo "Flat Discount of Rs ₹".$row['flat_discount_amount']; 
                            }
                            if($row['discount_type'] == "percent"){
                              echo "Discount of ".$row['discount_percentage']."% UP TO Rs ₹".$row['max_discount_amount']." ";           
                            }
                            $date=strtotime($row['expire_time']);
                            echo " On Orders Rs ₹".$row['min_amount']." & Above. Offer Expire Time is ".date("d F,Y h:i a",$date).".";
                            ?> 
                            </p>
                            <button type="button" onclick="copyToClipboard('<?php echo $row['offer_code']; ?>')"
                                class="btn border border-dark bg-transparent shadow-none font-weight-bold btn-block btn-sm p-1 btncopy mt-4"
                                style="font-size:15px;">Copy Code<i
                                    class="far fa-copy p-2"></i></button>
                        </div>
                    </div>
                </div>
           <?php
                }
            }
        ?>
        </div>   
    </div>

    <?php //include_once "include/footer.php"; ?>
    <?php include_once "login.php"; ?>
    <?php include_once "signup.php"; ?>
    <?php include_once "include/scripts.php";?>
    <script src="js/offers.js" type="text/javascript"></script>
</body>

</html>