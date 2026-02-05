<?php
include "php/database.php";
if (!isset($_GET['rid'])) {

    header('Location:index.php');
}
?>
<html>

<head>
    <title>FOODIFY</title>
    <?php include_once('include/links.php'); ?>
    <link rel="stylesheet" href="css/resto.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="http://static.sasongsmat.nu/fonts/vegetarian.css" />

</head>

<body>
    <?php include_once("include/header.php"); ?>

    <div class="container_fluid mybgbbanner" style="margin-top:62px">
        <div class="card  pb-0 m-0 rounded-0 cardforresto">
            <div class="row w-100">
                <?php
                $sql = "SELECT * FROM `restaurants` where res_id=" . $_GET['rid'] . "";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-lg-2 col-12 col-ml-2">
                    <img src="../uploads/<?php echo $row['image_name']; ?>" class="card-img " style="width: 15rem;margin: 57px 0px 0px 31px;">
                </div>
                <div class="col-lg-5 col-md-5 col-12 restoinfo" style="margin-left:100px;">
                    <div class="card-body p-0">
                        <h2 class="card-title mt-5 font-weight-bolder "><?php echo $row['name']; ?></h2>
                        <p class="mb-3 text-muted font-weight-bold">FRESH FOOD </p>
                        <p class="mb-0 text-muted font-weight-bold"><?php echo $row['address']; ?></p>
                        <ul class="list-unstyled list-inline d-flex  ml-0 pt-2">
                            <li class="list-inline-item m-0">

                            <li class="list-inline-item m-0 mr-5">
                                <i class="fas fa-star"></i>
                                <b class="text-bold">4.5</b>
                                <p class="text-muted ">50+ Ratings</p>
                            </li>
                            </li>
                            <div class="vl"></div>
                            <li class="list-inline-item m-0 mx-5">
                                <b class="text-bold">28 Mins</b>
                                <p class="text-muted">Delievery Time</p>
                            </li>
                            <!-- <div class="vl"></div> -->
                            <!-- <li class="list-inline-item m-0 ml-5">
                                <b class="text-bold">₹500</b>
                                <p class="text-muted">Cost for two</p>
                            </li> -->
                        </ul>
                    </div>
                    <table class="font-weight-bold text-white  mytbl">
                        <tr>
                            <th>
                                <i class="fas fa-search position-absolute fa-lg text-muted" style="left: 2%;top: 13px;"></i>
                                <input class="form-control searchinput  border-0 pl-5"  type="text" placeholder="Search for dishes..." name="usrnm">
                            </th>
                            <!-- <th>
                                <div class=" icon ml-4 ">
                                    <i class="fa fa-seedling  text-success purevegdiv"></i>
                                    <b class="pureveg">Pure Veg</b>
                                </div>
                            </th> -->
                            <th>
                            <?php
                                if(isset($_SESSION['uid'])){
                                    $sql = "SELECT * FROM favourite WHERE res_id=".$_GET['rid']." and u_id=".$_SESSION['uid']." ";  
                                    $result = mysqli_query($conn, $sql);  
                                   // 
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                        ?>
                                        <div class=" icon ml-5">
                                            <a class="text-danger" onclick="fav(<?php echo $row['f_id']; ?>,'unset')" > 
                                                <i class="fas fa-heart purevegdiv"></i>
                                                <b class="pureveg text-danger">Favourite</b>
                                            </a>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class=" icon ml-5">
                                            <a href="" onclick="fav(<?php echo $_GET['rid']; ?>,'set')" class="text-dark"> 
                                                <i class="far fa-heart purevegdiv"></i>
                                                <b class="pureveg text-dark">Favourite</b>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    
                                ?>
                                
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class=" icon ml-5">
                                        <a href="#" onclick="alert('you are not login');" class="text-dark"> 
                                            <i class="far fa-heart  purevegdiv"></i>
                                            <b class="pureveg ">Favourite</b>
                                        </a>
                                     </div>
                                    <?php
                                }
                            ?>
                               

                            </th>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-3 col-md-3  ml-5" style="margin-top:50px;">
                    <!-- <div id="OFERS-block" class="mt-2 ml-0 w-100">
                        <section class="file-marker">
                            <div class="p-3">
                                <div class="box-title">
                                    OFFERS
                                </div>
                                <div class="box-contents">
                                    <div id="OFERS-trail">
                                        40% off up to ₹80 on orders above ₹129 | Use coupon FOODIE1
                                    </div>

                                </div>
                            </div>
                        </section>

                    </div> -->
                    <?php
                    if(isset($_GET['rid'])){
                        $rid=$_GET['rid'];
                        $sql = "SELECT * FROM `restaurants` where res_id=$rid and status='Accpted'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if($row['availability'] == 0){
                           echo "<h3 class='mt-5 text-white font-weight-bold'>Restaurant is currently colsed</h3>";
                        }
                    } 
                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="row w-100">

        <div class="menuwidth p-2  mr-3">
            <ul class="vertical-menu m-0">
                <a class="col-xs-12 btnmenu menuselected" onclick="loaditem(<?php echo $_GET['rid']; ?>)">All Items</a>
                <?php
                $sql = "SELECT * FROM `menu` where res_id=" . $_GET['rid'] . "";
                $result = mysqli_query($conn, $sql);
                $i = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <a onclick="loaditem(<?php echo $row['res_id']; ?>,<?php echo $row['m_id']; ?>)" class="col-xs-12 btnmenu "><?php echo $row['m_name'] ?></a>
                <?php
                    }
                }
                ?>
            </ul>
        </div>

            <div class="itemwidth">
                <div id="items">
                </div>

            </div>
            

    </div>
    </div>
    <?php include_once "include/footer.php"; ?>

    <?php include_once "login.php"; ?>
    <?php include_once "signup.php"; ?>
    <?php include_once "include/scripts.php";?>
    <script src="js/resto.js"></script>
    <?php mysqli_close($conn); ?>  
</body>

</html>