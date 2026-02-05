 <!doctype html>
<html lang="en">

<head>
    <?php include('include/links.php'); ?>
    <?php include('php/database.php'); ?>
    <link rel="stylesheet" href="css/order.css">
</head>
<title>FOODIFY</title>
<body>
    <?php
    include('include/navbar.php');
    include('include/slidebar.php');

    ?>
    <div class="conten-body">
        <div id="content-wrapper">
            <div class="tab">
                <ul class="nav" role="tablist">
                    <li class="nav-item">
                        <a href="#tab1"  class="nav-link active" id="tab-tab1" aria-selected="true" data-toggle="tab" role="tab"><i class="far fa-bell"></i>NEW</a>
                    </li>

                    <span><i class="material-icons">double_arrow</i></span>

                    <li class="nav-item">
                        <a href="#tab2"  class="nav-link" id="tab-tab2" aria-selected="false" data-toggle="tab" role="tab"><i class="fas fa-utensils"></i>PREPARING</a>

                    </li>

                    <span><i class="material-icons">double_arrow</i></span>

                    <li class="nav-item">
                        <a href="#tab3"  class="nav-link" id="tab-tab3" aria-selected="false" data-toggle="tab" role="tab"><i class="fas fa-motorcycle"></i></i>ON THE WAY</a>
                    </li>

                    <span><i class="material-icons">double_arrow</i></span>

                    <li class="nav-item">
                        <a href="#tab4"  class="nav-link" id="tab-tab4" aria-selected="false" data-toggle="tab" role="tab"><i class="fa fa-shopping-bag iconsize" aria-hidden="true"></i>PAST ORDER</a>
                    </li>

                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" aria-labelledby="tab-tab1" role="tab-panel">
                    <div class="innercontent">
                        <div class="row m-0">

                            <div class="col-lg-5">
                                <div id="neworder">

                                </div>
                                <?php
                                    $limit = 2;
                                    $sql = "SELECT COUNT(o_id) FROM tbl_order where r_id=$resid and order_status='new'";
                                    //echo $sql;
                                    $rs_result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_row($rs_result);
                                    $total_records = $row[0];
                                    $total_pages = ceil($total_records / $limit);
                                    echo "<ul class='ml-5 mt-4 pagination ' id='pagination'>";
                                    if (!empty($total_pages)) {
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == 1) {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextconfirm myactive page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            } else {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextconfirm page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            }
                                        }
                                    }
                                    echo "</ul>";
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="showorder">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" aria-labelledby="tab-tab2" role="tab-panel">
                    <div class="innercontent">
                        <div class="row m-0">
                            <div class="col-lg-5">
                              <div class="loadprepraingorder">
                              
                              </div>
                              <?php
                                    $limit = 2;
                                    $sql = "SELECT COUNT(o_id) FROM tbl_order where r_id=$resid and order_status='preparing'";
                                    //echo $sql;
                                    $rs_result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_row($rs_result);
                                    $total_records = $row[0];
                                    $total_pages = ceil($total_records / $limit);
                                    echo "<ul class='ml-5 mt-4 pagination ' id='pagination'>";
                                    if (!empty($total_pages)) {
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == 1) {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextpreparing myactive page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            } else {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextpreparing page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            }
                                        }
                                    }
                                    echo "</ul>";
                                ?>

                            </div>
                            <div class="col-lg-6">
                                <div class="showprepraingorder">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab3" aria-labelledby="tab-tab3" role="tab-panel">
                    <div class="innercontent">
                        <div class="row m-0">
                            <div class="col-lg-5">
                            <div class="loadreadyorder">
                            
                            </div>
                            <?php
                                    $limit = 2;
                                    $sql = "SELECT COUNT(o_id) FROM tbl_order where r_id=$resid and order_status='ontheway'";
                                    //echo $sql;
                                    $rs_result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_row($rs_result);
                                    $total_records = $row[0];
                                    $total_pages = ceil($total_records / $limit);
                                    echo "<ul class='ml-5 mt-4 pagination ' id='pagination'>";
                                    if (!empty($total_pages)) {
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == 1) {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextready myactive page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            } else {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextready page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            }
                                        }
                                    }
                                    echo "</ul>";
                                ?>

                            </div>
                            <div class="col-lg-6">
                                <div class="showreadyorder">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab4" aria-labelledby="tab-tab4" role="tab-panel">
                    <div class="innercontent">
                        <div class="row m-0">
                            <div class="col-lg-5">
                                <div class="loadpastorder">

                                </div>
                                <?php
                                    $limit = 2;
                                    $sql = "SELECT COUNT(o_id) FROM tbl_order where r_id=$resid and order_status='deliverd'";
                                    //echo $sql;
                                    $rs_result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_row($rs_result);
                                    $total_records = $row[0];
                                    $total_pages = ceil($total_records / $limit);
                                    echo "<ul class='ml-5 mt-4 pagination ' id='pagination'>";
                                    if (!empty($total_pages)) {
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == 1) {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextpast myactive page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            } else {
                                                echo  "<li id='$i' class='page-item' ><button class='btnnextpast page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                                            }
                                        }
                                    }
                                    echo "</ul>";
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="showpastorder">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/scripts.php'); ?>
    <script src="js/order.js"></script>

</body>

</html>