<?php
include('database.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM item WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $i_id=$row['id'];
            $cid=$row['m_id'];
            $iname=$row['item_name'];
            $desc=$row['item_desc'];
            $price=$row['price'];
            $qty=$row['quantity'];
            $img=$row['image_name'];
        }
    } else {
        echo "0 results";
    }
?>

<div class="card  mt-2 ml-2">
    <div class="card-title  d-flex m-0 text-dark ">
        <span class="demo-card__title mdc-typography mdc-typography--headline6 text-dark font-weight-bold m-2">Item
            Details</span>
    </div>
    <form id="updateitemForm"  method="post" enctype="multipart/form-data">
    <input type="hidden" name="update">
    <input type="hidden" name="id" value="<?php echo $i_id;?>">
        <div class="card-body p-0 m-0 pl-2 border-top">
            <div class="form-group m-0 p-0">
                <b>selected Category:</b>
                <select class="custom-select w-50" name="catname" id="catname">
                    <?php
                    include('database.php');
                    $sql = "SELECT * FROM menu where m_id=$cid";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['m_id'];
                            $name = $row['m_name'];
                            echo "<option value='$id'selected >$name</option>";
                        }
                    }
                    ?>
                </select>
                <br>
                <label for="text"><b>Item Name:</b></label>

                <div class="input-group">
                    <input type="text" class="form-control  text-dark" placeholder="Enter A Item Name" name="name" value="<?php echo $iname; ?>">
                    <div class="input-group-append">
                        <!-- <div class="input-group-text">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch1" checked>
                                <label class="custom-control-label" for="switch1">Veg</label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <label for="text"> <b>Item Description:</b></label>
                <input type="text" class="form-control  text-dark p-3" placeholder="Enter A Item Desc" name="desc" value="<?php echo $desc; ?>">

                <label class="mt-3"><b>Priceing:</b></label>
                <?php
                if($qty == "")
                {
                    ?>
                    <label class="mt-3" style="margin-left:105px">  
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="chkqty" name="chkqty">
                            <label class="custom-control-label font-weight-bold" for="chkqty">Add Quantity</label>
                        </div>
                    </label>
                    <?php
                }else{
                    ?>
                    <label class="mt-3" style="margin-left:155px">  
                        <button class="font-weight-bold bg-transparent border-0" type="button" onclick="removeqty(<?php echo $i_id; ?>)"><u>Remove Quantity:</u></button>
                    </label>
                    <?php
                } 
                ?>
                

                <div class="input-group text-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Price</span>
                    </div>
                    <input type="number" class="form-control  text-dark" name="price" value="<?php echo $price; ?>">
                  
                    <?php
                    if($qty == ""){
                    ?>
                        <div class="input-group-prepend itemqtyupdate" style="display:none;">
                            <span class="input-group-text">Quantity</span>
                        </div>
                        <input type="number" class="form-control  text-dark itemqtyupdate" name="qty" id="qty"  style="display:none;">
                    <?php
                    }
                    else{
                        ?>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Quantity</span>
                        </div>
                        <input type="number" class="form-control  text-dark" name="qty" id="qty" value="<?php echo $qty; ?>">
                        <?php

                    }
                    ?>

                    
                   
                    
                </div>
                <div class="mt-2 position-relative">
                <img src="../uploads/<?php echo $img; ?>" alt="not found" class="border" width="200" height="100" style="width:40%"></img>
                    <input id="changefile" name="changefile" style="position: absolute;top: 20px;" class="border w-50" type="file">
                </div>
                <!-- <button type="button" class="btn" id="btnaddvari">+ (Add Variants)(Half,Full)(Multiple Quantity)</button> -->
                <div class="d-flex justify-content-center">
                    <button class="btn btnadditem mt-2 mb-2" id="update" onclick="updateitemdetail(event);" type="submit">Update 
                    <i class="fas fa-save ml-1"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php } ?>
<script>
    $(document).ready(function(){

        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                //alert("Checkbox is checked.");
                $(".itemqtyupdate").show();

            }
            else if($(this).prop("checked") == false){
                $(".itemqtyupdate").hide();
            }
        });
    });
    
</script>