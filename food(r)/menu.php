<?php
include('php/database.php');
?>
<!doctype html>
<html lang="en">

<head>
    <?php include('include/links.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/login.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->


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
                        <a href="#tab1" class="nav-link text-dark font-weight-bold active" id="tab-tab1"
                            aria-selected="true" data-toggle="tab" role="tab">MENU EDTIOR</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" class="nav-link text-dark font-weight-bold" id="tab-tab2" aria-selected="false"
                            data-toggle="tab" role="tab">MENU AVLABLITY</a>

                    </li>
                    <li class="nav-item">
                        <a href="#tab3" class="nav-link text-dark font-weight-bold" id="tab-tab3" aria-selected="false"
                            data-toggle="tab" role="tab">MENU HISTORY</a>
                    </li>
                    <div class="panel rounded"></div>
                </ul>

            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" aria-labelledby="tab-tab1" role="tab-panel">
                    <div class="innercontent">
                        <div class="row">
                            <div class="col-xs-11 col-md-6 col-lg-3 col-11">
                                <!-- <h1 class="">Example</h1> -->

                                <div class="mdc-card mdc-card--outlined ml-1 mt-2 box-shadow " style="width: 100%;">
                                    <div class="card-body p-0 border-0">
                                        <h5 class="card-title  d-flex m-0">
                                        <?php
                                        $sql = "SELECT * FROM menu where res_id=$resid";
                                    
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_num_rows($result);
                                        echo "<span class='demo-card__title text-dark font-weight-bold m-2' >Category|" . $row . "</span>";
                                        ?>
                                            <button type="button"
                                                class="btn text-dark font-weight-bold ml-auto mt-2 pt-1 pr-2 mb-1"
                                                data-toggle="modal" data-target="#addcatModalCenter">Add
                                                Category</button>

                                        </h5>
                                        <ul class="mdc-list border-top " style="width: 100%;" id="categorylist">
                                            <?php
                                        $sql = "SELECT * FROM menu where res_id=$resid";
                                        $result = $conn->query($sql);
                                        //$i=0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['m_id'];
                                                $name = $row['m_name'];
                                                echo  "<li><div  class='catlists'>
                                                <button class='mdc-list-item mdc-list-item__text border-0 libtn' onclick='loaditem($id)'>
                                                $name
                                                </button>"; ?>
                                            <i class='fas fa-times-circle animated fadeIn text-danger font-weight-bold'
                                                onclick="deletecategory(<?php echo $id; ?>,'<?php echo $name; ?>')"></i>
                                            <i class='fas fa-edit animated  fadeIn text-info font-weight-bold'
                                                onclick="updatecategory(<?php echo $id; ?>,'<?php echo $name; ?>')"></i>
                                            <?php echo "</div></li>";
                                            }
                                        }
                                        ?>
                                        <div class="demo"></div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-11 col-md-6 col-lg-4 col-11">
                                <div id="loaditem">
                                </div>
                            </div>
                            <div class="col-xs-11 col-md-6 col-lg-5 col-12">
                                <div id="loadadditem_layout">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" aria-labelledby="tab-tab2" role="tab-panel">
                    <div class="innercontent">
                        <div class="outofstockitem">
                            <?php
                                $sql = "SELECT * FROM item where availability=0 and res_id=$resid";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_num_rows($result);
                                echo "<button 
                                        class='text-right p-2 text-uppercase border bg-blue text-white font-weight-bold float-right border-0'>
                                        Out Of Stock Items ( $row )
                                    </button>";
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-xs-11 col-md-6 col-lg-5 col-sm-11 col-11">
                                <div class="mdc-card mdc-card--outlined box-shadow" style="width: 100%">
                                    <div class="card-body p-0 border-0 ">
                                        <h5 class="card-title d-flex pt-2 pr-2">
                                            <?php
                                        $sql = "SELECT * FROM menu  where res_id=$resid";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_num_rows($result);
                                        echo "<span class='demo-card__title mdc-typography mdc-typography--headline6 text-white font-weight-bold ml-3' >Category|" . $row . "</span>";
                                        ?>
                                        </h5>
                                        <ul class="mdc-list border-top" style="width: 100%">
                                            <?php
                                        $sql = "SELECT * FROM menu  where res_id=$resid";
                                        $result = $conn->query($sql);
                                        $i = 0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['m_id'];
                                                $name = $row['m_name'];
                                                $i++;
                                                echo  "<li><button class='mdc-list-item mdc-list-item__text border-0 libtn' onclick='showitemwithtoggle($id)'>
                                                $name
                                                </button></li>";
                                            }
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-11 col-md-6 col-lg-6 col-sm-11 col-11">
                                <div id="itemswithtoggle">
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab3" aria-labelledby="tab-tab3" role="tab-panel">
                    <div class="innercontent">
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-3 position-relative col-11">
                                <div class="mdc-card mdc-card--outlined box-shadow" style="width: 100%">
                                    <div class="card-body px-0 py-0">
                                        <h5
                                            class="card-title bg-transparent text-dark  pt-3 pr-2 pb-2 font-weight-bold">
                                            <span class="ml-3">CHANGE TYPE</span> </h5>
                                        <ul class="mdc-list border-top " style="width: 100%">
                                            <li>
                                                <button id="catbtn"
                                                    class="mdc-list-item mdc-list-item__text border-0 libtn"
                                                    onclick="showhistory(0)">All Changes</button>
                                            </li>
                                            <li>
                                                <button id="catbtn"
                                                    class="mdc-list-item mdc-list-item__text border-0 libtn"
                                                    onclick="showhistory(1)">In Review</button>
                                            </li>
                                            <li>
                                                <button id="catbtn"
                                                    class="mdc-list-item mdc-list-item__text border-0 libtn"
                                                    onclick="showhistory(2)">Approved</button>
                                            </li>
                                            <li>
                                                <button id="catbtn"
                                                    class="mdc-list-item mdc-list-item__text border-0 libtn"
                                                    onclick="showhistory(3)">Rejected</button>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-9">
                                <h5
                                    class="card-title text-dark  pt-3 pr-2 pb-2 font-weight-bold bg-transparent border-bottom">
                                    <span class="ml-3">CHANGE DETALIES</span> </h5>
                                <div id="history">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- AddCategoryModal -->
    <div class="modal animated flipInX" id="addcatModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="addcatModalCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="php/insertcategory.php" method="post">
                    <div class="modal-header bg-blue border-0">
                        <h5 class="modal-title  text-light" id="addcatmodalModalLongTitle">Add Category</h5>
                        <button type="button" class="close text-light font-weight-bold" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label text-secondary font-weight-bold">Enter
                                Category Name:</label>
                            <input type="text" name="txtcatname" class="form-control text-dark" id="recipient-name" />
                        </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn bg-red text-light font-weight-bold px-2"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn bg-blue text-light font-weight-bold px-4" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>

   

    <?php include('include/scripts.php'); ?>
    <script src="js/menu.js"></script>
    <?php $conn->close(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>