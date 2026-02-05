<?php
include('database.php');
$flag=0;
if (isset($_GET['mid']) ){
    $mid=$_GET['mid'];
}
if(isset($_GET['rid'])){
    $rid=$_GET['rid'];
    $sql = "SELECT * FROM `restaurants` where res_id=$rid and status='Accpted'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row['availability'] == 0){
        $flag=1;
    }
} 
if(!isset($mid)){
    echo "<h2 class='mt-5 font-weight-bold'>All Items</h2>";
    $sql = "SELECT COUNT(*) FROM `item` where res_id=$rid and status='Accpted'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo "<h6 class='font-weight-bold'>" . $row['COUNT(*)'] . "  Items" . "</h6>";
}
else{
    $sql = "SELECT * FROM `menu` where m_id=$mid ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo "<h2 class='mt-5 font-weight-bold'>" . $row['m_name'] . "</h2>";
    $sql = "SELECT COUNT(*) FROM `item` where res_id=$rid and m_id=$mid and status='Accpted'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo "<h6 class='font-weight-bold'>" . $row['COUNT(*)'] . "  Items" . "</h6>"; 
}
?>
<div class="row">
        <?php
        if(!isset($mid)){
            $sql = "SELECT * FROM `item` where res_id=$rid and status='Accpted'";
        }else{
            $sql = "SELECT * FROM `item` where res_id=$rid and m_id=$mid and status='Accpted'";
        }
        $result = mysqli_query($conn, $sql);
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
                                <?php
                                if($row['availability'] == "1" and $flag == 0){
                                    if(isset($_SESSION["shopping_cart"])){
                                        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                                        if (in_array($row["id"], $item_array_id)){
                                            ?>
                                            <button class="ml-auto mr-2 mb-2 mt-2 text-success font-weight-bolder bg-white  border border-muted px-2 py-2 btn-shadow" style="font-size: 14px">
                                                <i class="fas fa-minus pr-3" style="cursor: pointer;"
                                                onclick="addtocart(<?php echo $row['id']; ?>,<?php echo $rid; ?>,<?php if(isset($mid)){echo $mid; }else{ echo 0;}?>,'subqty')">
                                                </i> 
                                                <b class="qty">
                                                    <?php
                                                    foreach ($_SESSION["shopping_cart"] as $keys => $values)
                                                    {
                                                        if($values["item_id"] == $row["id"]){
                                                            echo $values["item_quantity"];
                                                        }
                                                    }
                                                    ?>
                                                </b> 
                                                <i class="fas fa-plus pl-3" style="cursor: pointer;" 
                                                onclick="addtocart(<?php echo $row['id']; ?>,<?php echo $rid; ?>,<?php if(isset($mid)){echo $mid; }else{ echo 0;}?>,'addqty')" >
                                                </i>
                                            </button>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <button class="ml-auto mr-2 mb-2 mt-2 text-success font-weight-bold bg-white  border border-muted px-4 py-2 btn-shadow" 
                                            onclick="addtocart(<?php echo $row['id']; ?>,<?php echo $rid; ?>,<?php if(isset($mid)){echo $mid; }?>)" 
                                            style="font-size: 14px">+ADD</button>
                                            <?php
                                        }
                                    }  
                                    else{
                                        ?>
                                        <button class="ml-auto mr-2 mb-2 mt-2 text-success font-weight-bold bg-white  border border-muted px-4 py-2 btn-shadow" 
                                        onclick="addtocart(<?php echo $row['id']; ?>,<?php echo $rid; ?>,<?php if(isset($mid)){echo $mid; }?>)" 
                                        style="font-size: 14px">+ADD</button>
                                        <?php
                                    }
                                }else{
                                    if($flag == 1){
                                    ?>
                                    <button class="ml-auto mr-2 mb-2 mt-2 text-success font-weight-bold bg-white  border border-muted px-4 py-2 btn-shadow" 
                                        onclick="Swal.fire({icon: 'error',text: 'Restaurant is currently colsed.',})" 
                                        style="font-size: 14px" >+ADD</button>
                                    <?php    
                                    }else{
                                        echo "<span class='ml-auto mr-2 mb-2 mt-2 text-danger font-weight-bold'>Out Of Stock</span>";
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
        <?php

            }
        }
        ?>
    </div>
