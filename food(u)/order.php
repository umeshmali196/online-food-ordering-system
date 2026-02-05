<?php
include 'php/database.php';
if(isset($_GET['order'])){
  unset($_SESSION["shopping_cart"]);
  unset($_SESSION["selAddess"]);
  unset($_SESSION['promocode']);
  unset($_SESSION['promoamount']);
}


?>
<!DOCTYPE html>
<html>

<head>
  <title>FOODIFY</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once "include/links.php"; ?>
<?php   
  if(!isset($_SESSION['uid'])){
    header("Location:index.php");
   }
?>
  
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/order.css" />
</head>

<body style="background-color:#F3F3F3;">
<?php
if(isset($_GET['order'])){
  
  echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Order Placed',
            text: 'Your Payment Is Successfull',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 1500
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              location.replace('order.php');
            }
          })
        </script>";
}
?>
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
        <h4 class="text-muted font-weight-bold h4">Past Orders</h4>
        <select name="orderstatus" class="custom-select orderstatus">
          <option value="all" selected>All</option>
          <option value="rejected">Cancelled</option>
          <option value="new">Not Confirmed</option>
          <option value="preparing">Preparing</option>
          <option value="ontheway">On The Way</option>
          <option value="deliverd">Delivered</option>
        </select>
        <div id="pastorders">
          <div class="row">
            <?php
              $sql = "SELECT * FROM `tbl_order` where  u_id=".$_SESSION['uid']." ORDER BY order_date DESC" ;
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
        </div>
        
    </div>
  </div>
  </div>

  <div class="modal fade right" id="viewdeatilsmodal" tabindex="-1" role="dialog" aria-labelledby="viewdeatilsmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
      <div class="modal-content">

      </div>
    </div>
  </div>



  <?php include_once "include/scripts.php"; ?>
  <script>
  $(document).ready(function(){
    $("select.orderstatus").change(function(){
        var selectedStatus = $(this).children("option:selected").val();
        $.ajax({
            type: "GET",
            url: "php/load_pastorder.php?status=" + selectedStatus,
            dataType: "html",
            success: function(response) {
              $("#pastorders").html(response);
            }
          });
    });
  });
  function showpastorder(oid) {
    $.ajax({
      type: "GET",
      url: "php/load_pastorder.php?id=" + oid,
      dataType: "html",
      success: function(response) {
        $(".modal-content").html(response);
      }
    });
  }
  function setrate(id,rid,oid){
    $.ajax({
      type: "GET",
      url: "php/reg.php?setrate="+id+"&raterid="+rid+"&rateoid="+oid,
      dataType: "html",
      success: function(response) {
            if(response == "1"){
                  $.ajax({
                    type: "GET",
                    url: "php/load_pastorder.php?id=" + oid,
                    dataType: "html",
                    success: function(response) {
                      $(".modal-content").html(response);
                  }
                });
        }else{
          console.log(response);
        }
        // $(".modal-content").html(response);
        // console.log(response);
      }
    });
  }
  </script>
</body>

</html>