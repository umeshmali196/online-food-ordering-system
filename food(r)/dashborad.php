<!doctype html>
<html lang="en">

<head>
    <?php include("php/database.php"); ?>

    <?php include('include/links.php'); ?>
    <link rel="stylesheet" href="css/dashborad.css">
    
</head>
<title>FOODIFY</title>
<body>
    <?php
    include('include/navbar.php');
    include('include/slidebar.php');
?>
    <div class="conten-body">   
        <div id="content-wrapper">
            <div class="mx-4">
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
                        <div class="card bg-shadow-blue border-0" style="width: 85%">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-left ">
                                        <i class="material-icons background-round">add_shopping_cart</i>
                                        
                                    </div>
                                    <div class="col-lg-6 col-6 text-right">
                                        <h4 class="text-white font-weight-bold">Orders</h4>
                                        <h3 class="text-white font-weight-bold mt-3">
                                            <?php
                                            $sql = "SELECT * FROM `tbl_order` where r_id=".$_SESSION['resid'];
                                            $result = mysqli_query($conn, $sql);
                                            $norec=mysqli_num_rows($result);
                                            echo $norec;
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
                        <div class="card bg-shadow-red border-0" style="width: 85%">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-left ">
                                        <i class="material-icons background-round">attach_money</i>
                                    </div>
                                    <div class="col-lg-6 col-6 text-right">
                                    <h5 class="text-white font-weight-bold mt-1">Profit</h5>

                                    <h3 class="text-white font-weight-bold mt-3"><i class="fas fa-rupee-sign fa-sm"></i>
                                    <?php
                                        $sql = "SELECT SUM(subtotal) AS profit FROM `tbl_order` where r_id=".$_SESSION['resid'];
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        if($row['profit'] > 0){
                                            echo $row['profit'];
                                        }else{
                                            echo "0";
                                        }
                                    ?>
                                    </h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
                        <div class="card bg-shadow-orenge border-0" style="width: 85%">
                            <div class="card-body pr-0">
                                <div class="row">
                                    <div class="col-lg-5 col-5 text-left ">
                                        <i class="material-icons background-round">restaurant_menu</i>
                                    </div>
                                    <div class="col-lg-6 col-6 text-right">
                                    <h5 class="text-white font-weight-bold mt-1">Category</h5>
                                    <h3 class="text-white font-weight-bold mt-3">
                                    <?php
                                       $sql = "SELECT * FROM `menu` where res_id=".$_SESSION['resid'];
                                       $result = mysqli_query($conn, $sql);
                                       $norec=mysqli_num_rows($result);
                                       echo $norec;
                                    ?>
                                    </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
                        <div class="card bg-shadow-green border-0" style="width: 85%">
                            <div class="card-body pr-0">
                                <div class="row ">
                                    <div class="col-lg-5 col-5 text-left">
                                        <i class="material-icons background-round">restaurant_menu</i>
                                    </div>
                                    <div class="col-lg-6 col-6 text-right">
                                        <h5 class="text-white font-weight-bold mt-1">Item</h5>
                                        <h3 class="text-white font-weight-bold mt-3">
                                        <?php
                                            $sql = "SELECT * FROM `item` where res_id=".$_SESSION['resid'];
                                            $result = mysqli_query($conn, $sql);
                                            $norec=mysqli_num_rows($result);
                                            echo $norec;
                                        ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mt-5 ml-5">
                    <h3 id="chartTitle"></h3>
                    <canvas id="myChart" class="mt-4"
                        style="max-width: 500px;display: block;height: 275px;width: 600px" >
                    </canvas>

                </div>

            </div>

        </div>
    </div>
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <?php include('include/scripts.php'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/js/mdb.min.js"></script>
    <script>
        $(document).ready(function(){
            disp_chart();
        })
        function disp_chart(){
            var myData;
            $.ajax({
            type: "GET",
            url: "php/chartData.php",
            dataType: "json",
            success: function(response) {
                myData = response;
                if(myData == 0){
                    $("#chartTitle").html("No Sales In This Week");
                }else{
                    $("#chartTitle").html("This Week Sales Chart");
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {  
                        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday"],
                        datasets: [{
                            label: 'Week Sales',
                            data: myData['totalsales'],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero: true
                                }
                            }]
                        }
                    }
                    });
                }
                  
            }
            });                
        }
    </script> 
                
                      
    <script>

        
    </script>
</body>

</html>

