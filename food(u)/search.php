<?php
include "php/database.php";

?>
<html>

<head>
  <title>FOODIFY</title>
  <?php include_once("include/links.php");  ?>
  <link rel="stylesheet" href="css/search.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="http://static.sasongsmat.nu/fonts/vegetarian.css" />

</head>

<body>
  <?php include_once("include/header.php");  ?>
  <div class="container-fluid" style="margin-top:5%;">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-10 col-12 mt-2 mb-2 pt-4 ">
        <div class="input-container justify-content-center">
          <div id="custom-search-input">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btnsercolor" type="button">
                  <i class="fa fa-search p-1 fa-2x text-white"></i>
                </button>
              </span>
              <input type="text" class="search-query form-control pl-5" placeholder="Search Restaurnts & Items" id="searchinput" />
              <span class="input-group-btn">
                <a id="btnclear" class="font-weight-bold text-uppercase" type="button">Clear</a>
              </span>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- tab view start  -->

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10">
          <ul class="nav nav-tabs tabsbar" role="tablist" id="mytab">
            <li class="demo1 active1"><a href="#Restaurant" role="tab" data-toggle="tab" id="Restaurants">
                RESTAURANTS
              </a></li>
            <li class="demo1"><a href="#Dishe" role="tab" data-toggle="tab" id="Dishes">
                ITEMS
              </a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!--1tab view-->
            <div class="tab-pane active" id="Restaurant">
              <div class="container-fluid"> 
                  <div class="loadres">
                    <?php
                    $sql="SELECT COUNT(*) FROM `restaurants` where status='Accpted' and availability=1";
                    $result = mysqli_query($conn, $sql);
                    $row=mysqli_fetch_assoc($result);
                    echo "<h4 class='text-dark mt-2' style='color:#ff8d0b!important;'>".$row['COUNT(*)']." Restaurants</h4>";
                    ?>
                  <div class="row mt-0">
                    <?php
                        
                        $sql = "SELECT * FROM `restaurants` where status='Accpted' and availability=1";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="card  p-4 mt-4" style="width: 100%;" onclick="resto(<?php echo $row['res_id']; ?>)">
                                        <div class="card-header p-0 border-0">
                                            <div class="view view-cascade overlay">
                                                <img class="card-img-top mx-auto d-block" src="../uploads/<?php echo $row['image_name']; ?>" alt="Card image cap" />
                                                <!-- <span class="badge font-weight-bold px-4 rounded-0 py-2 promoted">PROMOTED</span> -->
                                            </div>
                                        </div>

                                        <div class="card-body pt-1 pl-0 pr-2">
                                            <div class="h5 text-uppercase text-dark"><?php echo $row['name']; ?></div>
                                            <p class="catname text-uppercase ">FOODS</p>
                                            <ul class="list-unstyled list-inline mt-3 border-bottom mb-1 pb-2">
              <li class="list-inline-item">
                <span class="badge badge-success rounded-0 px-2 py-2"><i class="fas fa-star"></i> 
                <span>
                    <?php 
                    $sql6="SELECT AVG(rate) FROM feedback WHERE res_id=".$row['res_id'];
                    $result6 = mysqli_query($conn, $sql6);
                    $row6 = mysqli_fetch_assoc($result6);
                    if($row6['AVG(rate)'] == ""){
                        echo "0.00";
                    }else{
                         $rate=$row6['AVG(rate)'];                      
                         echo  number_format($rate, 1);
                    }

                    ?>
                  </span>
              </li>
              <!-- | -->
              <!-- <li class="list-inline-item mr-0  card-text f-md">28MINS</li> -->
              <!-- | -->
              <!-- <li class="list-inline-item card-text f-md">₹500 FOR TWO</li> -->
            </ul>
                                            <!-- <hr> -->
                                            <span class="offertext">50 % OFF |USE COUPON WELCOME50</span>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }

                    ?>
                  </div>
                </div>
              </div>
            </div>
            <!--2tab view-->
            <div class="tab-pane " id="Dishe">
              <div class="container-fluid">
                <div class="loaditem">
                 <h5 class="text-dark font-weight-bold mt-5">No Items</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <?php //include_once "include/footer.php"; ?>
    <?php include_once "login.php"; ?>
    <?php include_once "signup.php"; ?>
    <?php include_once "include/scripts.php";?>

    <script src="js/search.js" type="text/javascript">

    </script>
    
</body>

</html>