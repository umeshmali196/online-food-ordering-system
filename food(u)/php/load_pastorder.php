<?php
    include 'database.php';
  if(isset($_GET['id']))
  {
    $sql = "SELECT * FROM `tbl_order` where  o_id=".$_GET['id'] ;
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result);

    $sql2 = "SELECT * FROM `restaurants` where res_id=".$row['r_id'] ;
    $result2 = mysqli_query($conn, $sql2); 
    $row2 = mysqli_fetch_assoc($result2);
    ?>
    <div class="modal-header border-0">
      <img class="mt-3 ml-3" src="../uploads/<?php echo $row2['image_name']; ?>" alt="" width="110px" height="70px">

      <span class="h5 mt-4 ml-2"><?php echo $row2['name']; ?></span>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
        class="font-weight-bold text-dark d-inline">
        <span aria-hidden="true">&times;</span>
      </button><br>

    </div>
    <div class="mt-1 ml-3">
    <h5 class="font-weight-bold h5 text-muted text-uppercase mt-2">tracking Status</h5>
      <?php
        if($row['order_status'] == "new"){
            echo  "<span class='badge  px-1 py-2 badge-info mt-4'>Your Order Is Not Confirmed By ".$row2['name']." .</span>";
            echo  "<p class='mt-4 text-muted font-weight-bold'>wait for confirmation from ".$row2['name']."</p>";
          }
        if($row['order_status'] == "preparing"){
          echo  "<ul class='progressbar mt-3'>
                    <li class='active'>confirm</li>
                    <li class='active'>PREPARING</li>
                    <li class=''>ON THE WAY</li>
                    <li class=''>DELIVERD</li>
                  </ul>";
          }
          if($row['order_status'] == "ontheway"){
            echo  "<ul class='progressbar mt-3'>
                      <li class='active'>confirm</li>
                      <li class='active'>PREPARING</li>
                      <li class='active'>ON THE WAY</li>
                      <li class=''>DELIVERD</li>
                    </ul>";
          }
          if($row['order_status'] == "deliverd"){
            echo  "<ul class='progressbar mt-3'>
                      <li class='active'>confirm</li>
                      <li class='active'>PREPARING</li>
                      <li class='active'>ON THE WAY</li>
                      <li class='active'>DELIVERD</li>
                    </ul>";
            }
            if($row['order_status'] == "rejected"){
              echo  "<span class='badge px-3 py-2 badge-danger mt-4'>Your Order Is Rejected By ".$row2['name']."</span>";
              echo  "<p class='mt-4 text-muted font-weight-bold'>Your Amount Is Refunded To Your Bank Account Within 5-7 days.</p>";
            }
      ?>
    </div>

    <div class="modal-body">
    <?php
          if($row['order_status'] == "deliverd")
          { 
            ?>
              <small class="font-weight-bold  pt-2 pb-1  text-right ml-1 text-muted mt-5" style="top: 40px;position: relative;right: -140px;">
                Deliverd On <?php echo $row['order_date']; ?>
                <i class="fas fa-check-circle mx-1 text-success"></i>
              </small>
            <?php 
          }
        ?>
    <h5 class="text-muted font-weight-bold text-uppercase h5 pt-2" style="margin-top:45px;">Order Details</h5>

      <div class="card">
      
        <ul class="list-group list-group-flush ">
          <?php
          $sql3 = "SELECT * FROM `orderd_item_details` where o_id=".$_GET['id'] ;
          $result3 = mysqli_query($conn, $sql3); 
          while($row3 = mysqli_fetch_assoc($result3)) {
            $sql4 = "SELECT * FROM `item` where id=".$row3['i_id'];
            $result4 = mysqli_query($conn, $sql4); 
            $row4 = mysqli_fetch_assoc($result4);
            ?>
                <li class="list-group-item border-0">
                <?php echo $row4['item_name']; ?>
                  <b class="float-right">₹<?php echo $row3['price']; ?></b>
                  <b class="float-right mr-5"><i class="fas fa-times px-2"></i><?php echo $row3['quantity']; ?></b>
                </li>

            <?php

          }
          ?>
          
        </ul>
        <p class="font-weight-bold border-top mt-2 mr-2 mb-1 text-muted text-right">Bill Total: ₹<?php echo $row['subtotal']; ?></p>
      
      <?php
      if($row['order_status'] == "deliverd"){
        $sql6="SELECT * FROM `feedback` where o_id=".$_GET['id'];
        $result6 = mysqli_query($conn, $sql6);  
            if (mysqli_num_rows($result6) > 0) {
              while ($row6 = mysqli_fetch_assoc($result6)) {   
              $rate=$row6['rate'];
              echo "<div class='d-inline pt-2 text-right border-top'>";

              echo "<b class='text-muted h5 font-weight-bold'>Your Rate:</b>";
                for($i=1;$i<=5;$i++){
                  if($i <= $rate){
                    echo "<i class='fas fa-star text-success fa-lg px-1'></i>";
                  }else{
                    echo "<i class='far fa-star text-success fa-lg px-1'></i>";
                  }                        
              }
              echo "</div>";
            }
            }else{
              ?>
              <div class="d-inline pt-2 text-right border-top">
                  <b class="text-muted">Give Rate to Order:</b>
                  <i class="far fa-star text-success fa-lg px-1" onclick="setrate(1,<?php echo $row2['res_id']; ?>,<?php echo $row['o_id']; ?>)"></i>
                  <i class="far fa-star text-success fa-lg px-1" onclick="setrate(2,<?php echo $row2['res_id']; ?>,<?php echo $row['o_id']; ?>)"></i>
                  <i class="far fa-star text-success fa-lg px-1" onclick="setrate(3,<?php echo $row2['res_id']; ?>,<?php echo $row['o_id']; ?>)"></i>
                  <i class="far fa-star text-success fa-lg px-1" onclick="setrate(4,<?php echo $row2['res_id']; ?>,<?php echo $row['o_id']; ?>)"></i>
                  <i class="far fa-star text-success fa-lg px-1" onclick="setrate(5,<?php echo $row2['res_id']; ?>,<?php echo $row['o_id']; ?>)"></i>
              </div>
            
              <?php
            }
      }
          
        ?>
        <p class="font-weight-bolder mt-2 mr-2 text-muted">
          <b>Address:</b>
          <?php
            $sql5 = "SELECT * FROM `user_address` where a_id=".$row['a_id'];
            $result5 = mysqli_query($conn, $sql5); 
            $row5 = mysqli_fetch_assoc($result5);
          ?>
          <span class='d-block'>                                    
            <?php echo $row5['add_line'] . "," . $row5['landmark'] . "," . $row5['city'] . "," . $row5['state'] . "-" . $row5['pincode']; ?>
          </span>  
        </p>
      </div>
    </div>
  <?php
  }
  if(isset($_GET['status']))
  { ?>
    <div class="row">
        <?php
          $status=$_GET['status'];
          if($status == "all")
          {
            $sql = "SELECT * FROM `tbl_order` where  u_id=".$_SESSION['uid']." ORDER BY order_date DESC" ;

          }
          else
          {
            $sql = "SELECT * FROM `tbl_order` where  u_id=".$_SESSION['uid']." and order_status='$status' ORDER BY order_date DESC" ;

          }
          $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) { 
          $sql2 = "SELECT * FROM `restaurants` where res_id=".$row['r_id'] ;
          $result2 = mysqli_query($conn, $sql2); 
          $row2 = mysqli_fetch_assoc($result2);
          $sql3 = "SELECT * FROM `orderd_item_details` where o_id=".$row['o_id'] ;
          $result3 = mysqli_query($conn, $sql3); 
          $totalitems= mysqli_num_rows($result3);     
        ?>
        <div class="col-lg-6">
          <div class="card border mt-3">
            <div class="card-body p-0 m-0">
              <span
                class="badge px-2 py-1 badge-info text-uppercase float-right">
                <?php if($row['order_status'] == "new"){
                  echo "Waiting For Confirm"; 
                }else{
                  echo $row['order_status']; 
                }
                ?>
                </span>
              <div class="d-flex flex-row">
                <img class="mt-3 ml-3" src="../uploads/<?php echo $row2['image_name']; ?>" alt="" width="150"
                  height="90">
                <div class="d-flex flex-column mt-2 ml-2">

                  <span class="h5 mt-2 ml-2"><?php echo $row2['name']; ?></span>
                  <p class="ml-2 card-text m-0"><?php echo $row2['city']; ?></p>
                  <span class="ml-2  card-text"><?php echo "<b class='badge badge-dark'>$totalitems</b> items ordered"; ?></span>
                  <p class="font-weight-bold m-0 p-0 ml-2   text-muted ">Bill Total: ₹<?php echo $row['subtotal']; ?>
                  </p>
                </div>


              </div>
              <?php
              if($row['order_status'] == "deliverd")
              { ?>
              <button class="btn bg-transparent border float-right  text-muted font-weight-bold  px-3 py-1" data-toggle="modal"
                data-target="#viewdeatilsmodal" onclick="showpastorder(<?php echo $row['o_id']; ?>)">
                View Details
              </button>
              <?php }
            else{
              ?>
              <button class="btn bg-transparent border float-right  text-muted font-weight-bold  px-3 py-1" data-toggle="modal"
                data-target="#viewdeatilsmodal" onclick="showpastorder(<?php echo $row['o_id']; ?>)">
                Track Order
              </button>
              <?php
            }
              ?>
            </div>
          </div>
        </div>
              <?php
              }
        } 
        else 
        { 
        ?>
          <div class="container bg-white pt-1 pb-1">
            <div class="col-12">
              <h5 class='text-muted font-weight-bold h5 mt-5'>
                <i class='far fa-frown-open px-0 ml-5 fa-2x'></i>
                <span class="ml-2">No Item Ordered  </span>
              </h5>
            </div>
            <div class="col-12 ml-5 mb-3">
              <button class='gotores ' onclick="window.location='index.php'">See restaurants</button>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
  <?php
  }
  ?>
