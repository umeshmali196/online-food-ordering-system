<?php
include('database.php');
$limit = 2;  
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} 
else { 
    $page=1; 
};  
$start_from = ($page-1) * $limit;  
$sql = "SELECT * FROM tbl_order where order_status='deliverd' and r_id=$resid ORDER BY o_id ASC LIMIT $start_from, $limit";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="card ml-2 mt-2 box-shadow" style="width: 100%;">
    <div class="card-body p-0 ">
        <span class="font-weight-bold bg-blue badge px-3 py-2 float-left m-1 text-light">Past Order</span>
       

    </div>
    <div class="card-body pb-0 mb-2">

            <?php
            $sql2 = "SELECT * FROM orderd_item_details where o_id=" . $row['o_id'] . "";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $sql3 = "SELECT * FROM item where id = " . $row2['i_id'] . "";
                    $result3 = mysqli_query($conn, $sql3);
                    $items = mysqli_fetch_assoc($result3);
            ?>
            <span class="card-text"><?php echo $items['item_name']; ?></span>
            <div class="card-text text-muted float-right">
                <i class="fas fa-times px-2"></i><span class="font-weight-normal"><?php echo $row2['quantity'] ?></span>
            </div></br>
            <?php
                        }
                    } ?>

    </div>
    <div class="card-footer p-2 bg-transparent">
    <span class="float-left font-weight-bold text-muted">Bill Amount:<i class="fas fa-rupee-sign"></i><?php echo $row['subtotal']?> </span>
    <button class="btnviewdetails border-0 float-right " onclick="showpastorder(<?php echo $row['o_id']; ?>);">
      VIEW DETAILS
      </button>
    </div>
</div>
<?php
    }
} ?>
