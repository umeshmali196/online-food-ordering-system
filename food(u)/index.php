<!DOCTYPE html>

<head>
  <?php include_once 'include/links.php'; ?>
  <?php include 'php/database.php'; ?>
  
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/mainslider.css">
  <!-- <link rel="stylesheet" href="css/about.css"> -->
  <!-- <link rel="stylesheet" href="contectus.css"> -->
</head>
 <title>FOODIFY</title>

<body>
  <?php include_once "include/header.php"; ?>
  <!-- slider  -->
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" >
      <div class="carousel-item active">
        <!-- <img class="d-block w-100" src="img/s1.jpg" alt="First slide"> -->
        <video class="d-block w-100" src="img/Foodify (2).mp4" autoplay loop muted type="mp4"></video>
      </div>
      <div class="carousel-item">
        <!-- <img class="d-block w-100" src="img/s2.jpg" alt="Second slide"> -->
        <video class="d-block w-100" src="img/Foodify (3).mp4" autoplay loop muted type="mp4"></video>
      </div>
      <div class="carousel-item">
        <!-- <img class="d-block w-100" src="img/s3.jpg" alt="Third slide"> -->
        <video class="d-block w-100" src="img/Foodify (1).mp4" autoplay loop muted type="mp4"></video>
      </div>
      <div class="carousel-item">
        <!-- <img class="d-block w-100" src="img/s3.jpg" alt="Third slide"> -->
        <video class="d-block w-100" src="img/Foodify (4).mp4" autoplay loop muted type="mp4"></video>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  </div>
  <!-- slider End -->


  <div style="margin-top:0px; margin-bottom:30px">
          <center><h3>RESTAURANTS OFFER</h3></center>
        </div>
  <!-- slider offer  -->
  <div class="container-fluid mybgbbanner">
    <div id="carouselExampleIndicators" class="carousel slide pb-4" data-ride="carousel" >
    <ul class="carousel-indicators">
     <?php
     $limit = 4;
      $start_from=0;
      $sql = "SELECT COUNT(id) FROM slider";
      $rs_result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_row($rs_result);
      $total_records = $row[0];
      $total_pages = ceil($total_records / $limit);
      if (!empty($total_pages)) {
        for ($i = 1; $i <= $total_pages; $i++){
          if ($i == 1){
            // echo "<li data-target='#demo' data-slide-to='0' class='active'></li>";
          }else{
            // echo "<li data-target='#demo' data-slide-to='1'></li>";
          }
        }
      }
      ?>
      </ul>
      <div class="carousel-inner">
        <?php
        
        for ($i = 1; $i <= $total_pages; $i++){
          if ($i == 1){
            echo "<div class='carousel-item active'>";
              echo "<div class='row'>";
                $sql = "SELECT * FROM slider  order by id ASC  LIMIT $start_from, $limit";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-6 mt-4 overlay zoom">
                  <img src="../uploads/<?php echo $row['img_name']; ?>" class=" w-100">
                </div> 
                <?php
                  }
                } 
              echo "</div>";
            echo "</div>";
          }else{
            $start_from = ($i-1) * $limit;
            echo "<div class='carousel-item'>";
              echo "<div class='row'>";
                $sql = "SELECT * FROM slider  order by id ASC LIMIT $start_from, $limit";

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-6 mt-4 overlay zoom">
                  <img src="../uploads/<?php echo $row['img_name']; ?>" class=" w-100">
                </div> 
                <?php
                  }
                } 
              echo "</div>";
            echo "</div>";
          }
        }

        ?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev" >
          <!-- <i class="fas fa-arrow-circle-left text-white font-weight-bold" style="font-size: 50px;"></i> -->
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
          <!-- <i class="fas fa-arrow-circle-right text-white font-weight-bold" style="font-size: 50px;"></i> -->
        </a>

      </div>

    </div>
  </div>
  <!-- Endslider offer  -->
  
  <!-- about us -->
  <?php include_once "include/about.php"; ?>
        <!-- End about us -->
        <div>
          <center><h3>OUR RESTAURANTS</h3></center>
        </div>
  <!-- Card Narrower  -->
  <div class="container-fluid">
    <div class="row">
      <?php
            $sql = "SELECT * FROM `restaurants` where status='Accpted'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
      <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="card  p-4 mt-4" style="width: 100%; border-radius: 20px" onclick="resto(<?php echo $row['res_id']; ?>)">
          <div class="card-header p-0 border-0">
                <?php
                if(isset($_SESSION['uid'])){
                    $sql5 = "SELECT * FROM favourite WHERE  u_id=".$_SESSION['uid']." ";  
                    $result5 = mysqli_query($conn, $sql5); 
                    if(mysqli_num_rows($result5) > 0){
                       while($row5 = mysqli_fetch_assoc($result5)) {
                               if($row5['res_id'] == $row['res_id']){
                               ?>
                               <div style="position: absolute;right: 15px;top: 24px;z-index:1;">
                                   <div style="background-color: #fa4a5b;width: 30px;height: 25px;">
                                       <i class="fas fa-heart text-white ml-2"></i>
                                       <span class="tag"></span>
                                   </div>
                               </div>
                               <?php
                               }
                       }
                    }
                }
                 
                ?>
            
            <div class="view view-cascade overlay">
              <img class="card-img-top mx-auto d-block" src="../uploads/<?php echo $row['image_name']; ?>"
                alt="Card image cap" style="cursor:pointer!important;"/>
              <!-- <span class="badge font-weight-bold px-4 rounded-0 py-2 promoted">PROMOTED</span> -->
            </div>
          </div>

          <div class="card-body pt-1 pl-0 pr-2 ">
            <div class="h5 text-uppercase"><?php echo $row['name']; ?></div>
            <!-- <p class="catname text-uppercase">VEGETABLES</p> -->
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
            </ul>
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
  <?php include_once "contectus.php"; ?>
  <?php include_once "login.php"; ?>
  <?php include_once "signup.php"; ?>
  <?php include_once "include/scripts.php";?>
  <?php include_once "include/footer.php"; ?>
  <script src="js/index.js"></script>
  <?php mysqli_close($conn); ?>

  <script>
  function resto(id) {
    location.href = "resto.php?rid=" + id;
  }
  </script>
</body>

</html>