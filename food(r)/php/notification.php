<?php
include 'database.php';
if(isset($_POST['id']) and isset($_POST['msg'])){
    if($_POST['id'] == $_SESSION['resid']){
        echo "1";
    }
}else{
    ?>
    <a class="nav-link navbar-text  text-light "  style="position:relative;cursor:pointer"
        id="navbarDropdown" type="button"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        
        <i class="far fa-bell nav-iconsize " aria-hidden="true"></i>
        
        <span class="badge badge-pill badge-info bg-white px-1 text-dark" style="position: absolute;top: -2px;right: -7px;">
        <?php
          $sql="SELECT * FROM `tbl_order` where r_id=".$_SESSION['resid']." AND order_status='new'";
          $result=mysqli_query($conn,$sql);
          $no_rows=mysqli_num_rows($result);
          echo $no_rows;
        ?>
        </span>
    </a>
    <div  class="dropdown-menu mt-5" aria-labelledby="navbarDropdown" style="top: -11px;right: 30%">
    <?php
          $sql="SELECT * FROM `tbl_order` where r_id=".$_SESSION['resid']." AND order_status='new'";
          $result=mysqli_query($conn,$sql);
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
            ?>
            <a class="dropdown-item px-4 py-2" href="#">
                <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
                <span class="text-info">New Order Received</span>
                <p class="text-muted text-right mb-0"><small>
                <?php
                    $order_time = $row['order_date'];
                    $order_time= date('h:i', strtotime($order_time));
                    echo "At ".$order_time;
                ?>
                </small></p>
            </a>
            <div class="dropdown-divider"></div>
            <?php
            }
        }else{?>
        <a class="dropdown-item px-4 py-2" href="#">
              <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
              <span class="text-info">No  Orders</span>
        </a>
        <?php
        }
        ?>
    </div>

    <?php
}

?>
