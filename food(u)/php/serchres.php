<?php
include "database.php";
if(isset($_GET['allres']))
{
  $sql="SELECT COUNT(*) FROM `restaurants`";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);
  echo "<h4 class='text-dark mt-2' style='color:#ff8d0b!important;'>".$row['COUNT(*)']." Restaurants</h4>";
  echo "<div class='row'>";
  $sql = "SELECT * FROM `restaurants`";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <div class="col-lg-4 col-md-6 col-sm-4">
    <div class="card  p-4 mt-4" style="width: 100%;" onclick="resto(<?php echo $row['res_id']; ?>)">
      <div class="card-header p-0 border-0">
        <div class="view view-cascade overlay">
          <img class="card-img-top mx-auto d-block" src="../uploads/<?php echo $row['image_name']; ?>"
            alt="Card image cap" />
        </div>
      </div>

      <div class="card-body pt-1 pl-0 pr-2">
        <div class="h5 text-uppercase text-dark"><?php echo $row['name']; ?></div>
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
        <!-- <hr> -->
        <span class="offertext">50 % OFF |USE COUPON WELCOME50</span>
      </div>
    </div>
  </div>
  <?php
      }
  }
  echo "</div>";
}
if(isset($_GET['resname']))
{
  $sql="SELECT COUNT(*) FROM `restaurants` where name LIKE '%".$_GET['resname']."%'";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);
  echo "<h4 class='text-dark mt-2' style='color:#ff8d0b!important;'>".$row['COUNT(*)']." Restaurants</h4>";
  echo "<div class='row'>";
  $sql = "SELECT * FROM `restaurants` where name LIKE '%".$_GET['resname']."%'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <div class="col-lg-4 col-md-6 col-sm-4">
  <div class="card  p-4 mt-4" style="width: 100%;" onclick="resto(<?php echo $row['res_id']; ?>)">
    <div class="card-header p-0 border-0">
      <div class="view view-cascade overlay">
        <img class="card-img-top mx-auto d-block" src="../uploads/<?php echo $row['image_name']; ?>"
          alt="Card image cap" />
        <!-- <span class="badge font-weight-bold px-4 rounded-0 py-2 promoted">PROMOTED</span> -->
      </div>
    </div>

    <div class="card-body pt-1 pl-0 pr-2">
      <div class="h5 text-uppercase text-dark"><?php echo $row['name']; ?></div>
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
      <!-- <hr> -->
      <span class="offertext">50 % OFF |USE COUPON WELCOME50</span>
    </div>
  </div>
  </div>
  <?php
      }
  }
  echo "</div>";
}
if(isset($_GET['itemname']))
{
  $sql="SELECT COUNT(*) FROM `item` where item_name LIKE '%".$_GET['itemname']."%'";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);
  echo "<h4 class='text-dark mt-2' style='color:#ff8d0b!important;'>".$row['COUNT(*)']." Items</h4>";
  echo "<div class='row'>";
  $sql = "SELECT * FROM `item` where item_name LIKE '%".$_GET['itemname']."%'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
      $sql2="SELECT * FROM `restaurants` where res_id=".$row['res_id']; 
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
  ?>
  <div class="col-lg-4 col-md-6 col-sm-4">
  <div class="card  p-4 mt-4" style="width: 100%;" onclick="resto(<?php echo $row2['res_id']; ?>)">
    <div class="card-header p-0 border-0">
      <div class="view view-cascade overlay">
        <img class="card-img-top mx-auto d-block" src="../uploads/<?php echo $row['image_name']; ?>"
          alt="Card image cap" />
      </div>
    </div>

    <div class="card-body pt-1 pl-0 pr-2">
      <div class="d-flex justify-content-start mt-2">
                                <span class="vegetarianicon ml-2 text-success">⊡</span>
                                <span class="font-weight-bold text-dark  ml-3"><?php echo $row['item_name']; ?></span>

                              </div>
                              
                              <div class="ml-4 mt-2 text-muted font-weight-bold "><i class="fas fa-angle-double-right ml-3 text-muted"></i><small class="ml-1"><?php echo $row2['name']; ?></small></div>

                            <div class="d-flex justify-content-start ">
                                <div class="ml-5 font-weight-bold text-dark h6 mt-2"><?php echo "₹" . $row['price']; ?></div>

                            </div>
      <!-- <hr> -->
      <!-- <span class="offertext">50 % OFF |USE COUPON WELCOME50</span> -->
    </div>
  </div>
  </div>
  <?php
      }
  }
  echo "</div>";
}
if(isset($_GET['serachitem'])){
  $id= $_GET['itemrid'];
  $iname= $_GET['serachitem'];
  $sql = "SELECT COUNT(*) FROM `item` where item_name LIKE '%".$_GET['serachitem']."%' and res_id=$id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo "<h5 class='font-weight-bold mt-5'>" . $row['COUNT(*)'] . "  Items" . "</h5>";
  $sql = "SELECT * FROM `item` where item_name LIKE '%".$_GET['serachitem']."%' and res_id=$id";
  $result = mysqli_query($conn, $sql);
  echo "<div class='row mt-3'>";
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 p-3 ">
                    <div class="card p-0  m-0 rounded-0">
                        <div class="card-header p-0 border-0" style="width: 100%;">
                            <img class="card-img-top mx-auto d-block rounded-0" src="../uploads/<?php echo $row['image_name']; ?>" alt="Card image cap" />
                        </div>
                        <div class="card-body p-0 ">
                            <div class="d-flex justify-content-start mt-2">
                                <span class="vegetarianicon ml-2">⊡</span>
                                <span class="font-weight-bold   ml-3"><?php echo $row['item_name']; ?></span>
                            </div>
                            <div class="d-flex justify-content-start ">
                                <div class="ml-5 font-weight-bold h6 mt-2"><?php echo "₹" . $row['price']; ?></div>

                                <button class="ml-auto mr-2 mb-2 mt-2 text-success font-weight-bold bg-white  border border-muted px-4 py-2 btn-shadow" onclick="addtocart(<?php echo $row['id']; ?>)" style="font-size: 14px">+ADD</button>

                            </div>

                </div>
            </div>
        </div>
        <?php
      }
    }
  echo "</div>";
}
?>