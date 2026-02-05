<?php
include("php/database.php"); 
$limit = 3;
$sql = "SELECT COUNT(f_id) FROM feedback where res_id=".$_SESSION['resid'];  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 

?>
<!doctype html>
<html lang="en">

<head>
    <?php include('include/links.php'); ?>
    <link rel="stylesheet" href="css/feedback.css">

</head>
<title>FOODIFY</title>
<body>
    <?php
    include('include/navbar.php');
    include('include/slidebar.php');

?>
    <div class="conten-body">

    <div id="content-wrapper">
      <div class="innercontent">
        <div class="">
          <div id="target-content">
          </div> 
        </div>
          <ul class='ml-5 mt-2 pagination ' id="pagination">
            <!-- <li class="page-item"><button class="page-link">Previous</button></li> -->
                        <?php if(!empty($total_pages)){
                            for($i=1; $i<=$total_pages; $i++){
                              if($i == 1){
                        echo  "<li id='$i' class='page-item' ><button class='myactive btnpage page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                              }else{
                        echo  "<li id='$i' class='page-item' ><button class='btnpage page-link px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
                              }

                            }
                        } ?>
            <!-- <li class="page-item"><button class="page-link">Next</button></li> -->
          </ul>
      </div>
    </div>

    <?php include('include/scripts.php'); ?>
    <?php mysqli_close($conn); ?>
        <script src="js/feedback.js" type="text/javascript"></script>
</body>

</html>