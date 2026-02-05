<!-- <div class="animated flipInX"> -->
<?php include "database.php"; ?>

<?php
if (isset($_GET['id'])) {
    $action = $_GET['id'];
    if ($action == 0) {
        $sql = "SELECT * FROM `item` where res_id=$resid";
    }
    if ($action == 1) {
        $sql = "SELECT * FROM `item` where status='Pending' and res_id=$resid";
    }
    if ($action == 2) {
        $sql = "SELECT * FROM `item` where status='Accpted'and res_id=$resid";
    }
    if ($action == 3) {
        $sql = "SELECT * FROM `item` where status='Rejected' and res_id=$resid";
    }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            ?>
            <?php
            while($row = mysqli_fetch_assoc($result)) {
                $sql2 = "SELECT * FROM menu where m_id=".$row['m_id'];
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
               
            ?>
           <div class="card m-3 box-shadow ">
               <div class="card-header m-0 bg-transparent pt-0 pl-0 pb-1 border-0 rounded-0">
               <span class="badge  bg-blue text-white font-weight-bold p-2 border-0 rounded-0">New Item Added</span>

               </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="font-weight-bold"><?php echo $row['item_name']; ?></span></br>
                            <span class="text-muted"><?php echo $row2['m_name']; ?></span>
                        </div>
                        <div class="col-lg-6">
                            <?php 
                            if ($row['status'] == "Pending"){
                                ?>
                                <span class="badge badge-pill badge-warning px-4 py-2 text-light"><?php echo $row['status']; ?></span></br>
                                <?php
                            }
                            if ($row['status'] == "Accpted"){
                                ?>
                                <span class="badge badge-pill badge-success px-4 py-2 text-light"><?php echo $row['status']; ?></span></br>
                                <?php
                            }
                            if ($row['status'] == "Rejected"){
                                ?>
                                <span class="badge badge-pill badge-danger px-4 py-2 text-light"><?php echo $row['status']; ?></span></br>
                                <?php
                            }
                            ?>
                            <span class="text-muted font-weight-bold small">On <?php echo $row['date']; ?></span>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            }
            ?>
            <?php
        } else {
            ?>
            <div class="card m-3 box-shadow ">
                <div class="card-body">
                    <h4 class="card-title text-muted font-weight-bold">No Items</h4>
                </div>
            </div>
            <?php    
            }        ?>
        
<?php
}
?>
