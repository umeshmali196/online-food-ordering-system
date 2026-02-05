<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
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
            <div class="row mt-3 mr-0 pr-0 ml-2">
                <div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
                    <div class="card bg-shadow-skyblue border-0" style="width: 85%">
                        <div class="card-body pr-0">
                            <div class="row">
                                <div class="col-lg-5 col-5 text-left ">
                                    <i class="material-icons background-round">person_outline</i>
                                </div>
                                <div class="col-lg-6 col-6 text-right">
                                    <h4 class="text-white font-weight-bold">Users</h4>

                                    <h3 class="text-white font-weight-bold mt-3">
                                        <?php
                                        $sql = "SELECT * FROM `user`";
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
                                        $sql = "SELECT * FROM `tbl_order`";
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
                                    $sql = "SELECT SUM(subtotal) AS profit FROM `tbl_order`";
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
                        <div class="card-body pr-1">
                            <div class="row">
                                <div class="col-lg-5 col-5 text-left ">
                                    <i class="material-icons background-round">store_menu</i>
                                </div>
                                <div class="col-lg-7 col-7 text-right">
                                <h5 class="text-white font-weight-bold mt-1">Category</h5>
                                <h3 class="text-white font-weight-bold mt-3">
                                <?php
                                    $sql = "SELECT * FROM `menu`";
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
                                    <i class="material-icons background-round">store_menu</i>
                                </div>
                                <div class="col-lg-6 col-6 text-right">
                                    <h5 class="text-white font-weight-bold mt-1">Item</h5>
                                    <h3 class="text-white font-weight-bold mt-3">
                                    <?php
                                        $sql = "SELECT * FROM `item`";
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
            <div class="row ml-3 mt-3 mr-0 pr-0">
                <div class="col-lg-6">
                    <div>
                        <span class="w3-xxlarge w3-lobster">Slider</span>
                        <button class="btn btn-outline-success w3-myfont px-2 py-2 m-3 float-right shadow-none" id="addslider">Add Slider</button>
                        <table class="table text-cente table-hover">
                            <thead class="thead-light ">
                                <tr>
                                <th class="text-dark font-weight-bold">#</th>
                                <th class="text-dark font-weight-bold">Image</th>
                                <th class="text-dark font-weight-bold">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="SELECT  * FROM `slider`  order by id ASC";
                                $result=mysqli_query($conn, $sql);
                                $i=1;

                                if(mysqli_num_rows($result) > 0){
                                    while($row=mysqli_fetch_assoc($result)){
                                        ?>
                                        <tr>
                                        <td><?php echo $i++ ;?></td>
                                        <td><u class="text-dark font-weight-bold" style="cursor:pointer;" data-toggle='modal'
                                        data-target='#exampleModalCenter' onclick="getimage('<?php echo $row['img_name']; ?>');">View Image</u></td>
                                        <td><i class="far fa-times-circle text-danger ml-2 fa-lg" onclick="deleteSlider(<?php echo $row['id'] ?>)"></i></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 mt-3" id="showaddslider" style="display: none">
                    <span class="w3-xlarge w3-lobster">add slider</span>
                    <button class="btn btn-outline-danger w3-myfont px-2 py-2 m-2 float-right shadow-none " id="cancelslider">Cancel</button>
                    <hr class="text-dark" style="    border: 0;border-top: 3px solid #dee2e6;margin: 20px 0;">
                   
                    <form id="sliderForm"  method="post" enctype="multipart/form-data">
                        <label class="mt-2 w3-lobster"><b>Upload Slider Image:</b></label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <button type="submit" class="btn btn-info py-2 mt-4 w3-myfont" style="font-size: 13pt;" onclick="addslider(event);">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Slider Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="img"
                        src="../food(u)/img/1.jpg"
                        height="90%" width="100%"></img>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/scripts.php'); ?>
    <script>
        $(document).ready(function(){
            $("#addslider").click(function(){
                $("#showaddslider").show();
            });
            $("#cancelslider").click(function(){
                $("#showaddslider").hide();
            });
            $(".custom-file-input").on("change", function() {
            var fileName = $(this)
            .val()
            .split("\\")
            .pop();
            $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
            });
        });
        
        function getimage(img) {
            $("#img").attr("src", "../uploads/" + img);
        }
        function addslider(e){
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-center',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            e.preventDefault();

            var fd = document.getElementById("file").files[0];
            if(fd != null){
                var frm = document.getElementById("sliderForm");
                var formData = new FormData(frm);
                var imgtype = fd.name.split(".").pop().toLowerCase();
                if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
                    Swal.fire({
                        icon: "error",
                        title: "Error In Image",
                        text: "Invalid File Formate!Plz Select Image File"
                    });
                }
                else if (fd.size > 2000000) {
                    Swal.fire({
                        icon: "error",
                        title: "Error In Image",
                        text: "Image size is Large!Plz Select Image Below 2 MB"
                    });
                }
                else {
                    $.ajax({
                        url: "php/crud.php?addsliderImage=1",
                        type: "post",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if(response == "1"){
                                Swal.fire({
                                icon: "success",
                                title: "Image Uploaded Successfully"
                                }).then((result) => {
                                    location.reload();
                                })
                            }else{
                                console.log(response);
                            }
                        }
                    });
                }
            }else{
                Toast.fire({
                icon: 'error',
                title: 'Upload Image is Blank'
                })
             
            }
        }
        function deleteSlider(id){
            $.ajax({
                url: "php/crud.php?deletesliderImage="+id,
                type: "post",
                success: function(response) {
                    if(response == "1"){
                        Swal.fire({
                        icon: "success",
                        title: "Image Deleted Successfully"
                        }).then((result) => {
                                    location.reload();
                                })
                    }else{
                        console.log(response);
                    }
                }
            });

        }
        
    </script>
</body>

</html>