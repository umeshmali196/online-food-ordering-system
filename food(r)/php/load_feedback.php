<?php
include('database.php');
 
$limit = 3;  
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} 
else { 
    $page=1; 
};  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM feedback where res_id=".$_SESSION['resid']." ORDER BY date DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);   
if (mysqli_num_rows($rs_result) > 0) {
    while ($row = mysqli_fetch_assoc($rs_result)) {  
        ?>
<div class="row mt-1">
    <div class="col-lg-5 mr-4">
        <div class="card ml-2 box-shadow border-0" style="width: 100%">
            <div class="card-body p-0 ">
                <div class="font-weight-bold float-left text-light px-2 d-inline" style="background-color:#26c6da;">FeedBack</div>
                    <div class="font-weight-bold float-right pl-2 text-light" style="background-color:#26c6da;"><?php echo $row['date']?><i
                            class="fas fa-check-circle mx-1"></i></div>
            </div>
            
            <div class="card-body pb-0">
            <?php
            $sql2 = "SELECT * FROM orderd_item_details where o_id=" . $row['o_id'] . "";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $sql3 = "SELECT * FROM item where id = " . $row2['i_id'] . "";
                    $result3 = mysqli_query($conn, $sql3);
                    $items = mysqli_fetch_assoc($result3);
            ?>
                <span class="card-text text-dark"><?php echo $items['item_name']; ?></span>
                <div class="card-text text-dark font-weight-bold float-right">
                    <i class="fas fa-times px-2"></i><span class="font-weight-bold"><?php echo $row2['quantity'] ?></span>
                </div>
                </br>
            <?php
                }
             } 
            ?>
                <p class="text-dark font-weight-bold  float-right mt-2">
                    Bill Amount:
                    <b class="text-dark mt-2">
                    <?php
                        $sql4 = "SELECT * FROM tbl_order where o_id=" . $row['o_id'] . "";
                        $result4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($result4)
                    ?>
                        <i class="fas fa-rupee-sign"></i><?php echo $row4['subtotal']?>
                    </b>
                    <div class="border-top mt-2">
                        <?php 
                        $rate=$row['rate'];
                        //echo $rate;
                        for($i=1;$i<=5;$i++){
                            if($i <= $rate){
                                echo "<i class='fas fa-star text-info mt-2'></i>";
                            }else{
                                echo "<i class='far fa-star text-info mt-2'></i>";
                            }                        
                        }
                        ?>
                    </div>
                </p>

            </div>

        </div>

    </div>
</div>
<?php
    }
} 
?>