<?php
include('database.php');
if(isset($_GET['id'])){
    $oid=$_GET['id'];
}
$sql = "SELECT * FROM tbl_order where order_status='preparing' and o_id=$oid";  
$result = mysqli_query($conn, $sql);   
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {  
        ?>
<div class="card ml-2 box-shadow" style="width: 100%" id="cardetail">
  <div class="card-header p-0 pl-1 bg-transparent border-bottom-0">
    <span class="badge bg-blue px-4 py-2 text-light rounded-0 font-weight-bolder text-uppercase">Prepraing</span>
    <div class="text-muted font-weight-bold float-right m-1"><?php echo $row['order_date']?></div>
  </div>
  <div class="card-body pb-2">
  <?php
  $sql2 = "SELECT * FROM orderd_item_details where o_id=$oid";  
        $result2 = mysqli_query($conn, $sql2); 
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {  
                $sql3 = "SELECT * FROM item where id = ".$row2['i_id']."";  
                $result3 = mysqli_query($conn, $sql3); 
                $items=mysqli_fetch_assoc($result3);
                ?>
    <span class="text-muted"><?php echo $items['item_name']; ?></span>
    <?php
     $sql4 = "SELECT * FROM menu where m_id = ". $items['m_id']."";  
     $result4 = mysqli_query($conn, $sql4); 
    $menus=mysqli_fetch_assoc($result4);
    ?>
    <span class="text-muted font-weight-bold">(<?php echo $menus['m_name']; ?>)</span>
    <div class="text-muted font-weight-bold float-right pr-3">
      <i class="fas fa-times p-1"></i><?php echo $row2['quantity']?>
    </div></br>
   
    <span class="card-text  text-muted  font-weight-bold"><i class="fas fa-rupee-sign"></i><?php echo $row2['price']?></span></br>
    <?php

            }
        }
        ?>
    <hr>
    <strong class="card-text  float-right text-muted font-weight-bold">
      Bill Amount:<b class="p-2"><i class="fas fa-rupee-sign"></i><?php echo $row['subtotal']?></b></strong><br>
    <hr>
    <div class="row">
            <div class="col-lg-2">
                <p class="card-text p-0 text-muted"> Address:</p>
            </div>
            <div class="col-lg-10">
                <span class="text-muted">
                    <?php 
                    $sql5 = "SELECT * FROM user_address where a_id = ". $row['a_id']."";  
                    $result5 = mysqli_query($conn, $sql5); 
                    $address=mysqli_fetch_assoc($result5); 
                    echo $address['add_line'] . "," . $address['landmark'] . "," . $address['city'] . "," . $address['state'] . "-" . $address['pincode'];
                ?></span>
            </div>
        </div>
    <!-- <div class="row">
      <div class="col-lg-5">
        <span class="card-text p-0 text-muted font-weight-bold"> Remaining Time(minutes):</span>
      </div>
      <div class="col-lg-2">
        <button class="btnshow  rounded-circle  border-0 font-weight-bolder" id="remaingtime">20</button>
      </div>
    </div> -->

    <div class="card-footer p-1 bg-transparent mt-2 text-center">
      <button class="py-1 px-2  mt-3 mb-2 border shadow-lg rounded  bg-blue text-white font-weight-bold border-0 " onclick="orderready(<?php echo $row['o_id']; ?>)">Food
        is Ready & Disptech</button>
    </div>
  </div>
  <?php
    }
} 
?>