<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once "include/links.php"; ?>
  <?php include 'php/database.php';
   if(!isset($_SESSION['uid'])){
    header("Location:index.php");
   }
   ?>

  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/favourite.css" />
 
</head>
<title>FOODIFY</title>
<body style="background-color:#F3F3F3;">
  <?php include_once "include/header.php"; ?>
  <?php
    $sql = "SELECT * FROM `user` where u_id=" . $_SESSION['uid'] . "";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
  <div class="container-fluid" style="margin-top:5%; ">
    <div class="row ml-2">

      <p class="mt-1 col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h1 class="text-muted font-weight-bold "><?php echo $row['name']; ?></h1>
        <p class="text-muted font-weight-bold d-inline mt-3 ml-5">
          <i class="fas fa-mobile-alt px-2"></i><?php echo $row['moblie']; ?>
          <span class="ml-3"><i class="far fa-envelope pr-1"></i> <?php echo $row['email']; ?></span>
        </p>

    </div>
  </div>
  <div class="mt-2 mx-5 rounded-0">
    <div class="card-body">
      <h4 class="text-muted font-weight-bold h4">Your Favorites Restaurants</h4>
    </div>

  </div>
  <div class="container-fluid mr-0 pr-0 px-0 ">
    <div class="row  pb-2 px-3 mr-0 pr-0">
      <?php
            $sql2 = "SELECT * FROM favourite WHERE  u_id=".$_SESSION['uid']." ";  
            $result2 = mysqli_query($conn, $sql2); 
            if(mysqli_num_rows($result2) > 0){
              while($row2 = mysqli_fetch_assoc($result2)) {
                $sql = "SELECT * FROM `restaurants` where res_id=".$row2['res_id'];
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
      <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="card  p-4 mt-4 bg-transparent" style="width: 100%;border-color: #d3d5df!important;
    box-shadow: 0 4px 7px 0 rgba(218,220,230,.6)!important;cursor:pointer!important;" onclick="resto(<?php echo $row['res_id']; ?>)">

          <div class="card-header p-0 border-0">
            <div style="position: absolute;right: 15px;top: 24px;z-index:1;">
              <div style="background-color: #fa4a5b;width: 30px;height: 25px;">
                <i class="fas fa-heart text-white ml-2"></i>
                <span class="tag"></span>
              </div>
            </div>
            <div class="view view-cascade overlay">

              <img class="card-img-top mx-auto d-block" style="cursor:pointer!important;" src="../uploads/<?php echo $row['image_name']; ?>"
                alt="Card image cap" />
              <!-- <span class="badge font-weight-bold px-4 rounded-0 py-2 promoted">PROMOTED</span> -->
            </div>
          </div>

          <div class="card-body pt-1 pl-0 pr-2">
            <div class="h5 text-uppercase"><?php echo $row['name']; ?></div>
            <p class="catname text-uppercase">Ice Cream</p>
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
          </div>
        </div>
      </div>
      <?php
                  }
                }
              }
              
            }else{     
              ?>
              <div class="col-12">
                <h5 class='text-muted font-weight-bold h5 mt-5'>
                  <i class='far fa-frown-open px-0 ml-5 fa-2x'></i>
                  <span class="ml-2">No Favorites Restaurants</span>
                </h5>
              </div>
              <div class="col-12 ml-5 mb-3">
                <button class='gotores ' onclick="window.location='index.php'">See restaurants</button>
              </div>
              <?php
          }            

      ?>
    </div>

  </div>




  <?php include_once "include/scripts.php"; ?>
  <script>
  function resto(id) {
    location.href = "resto.php?rid=" + id;
  }
  </script>
</body>

</html>