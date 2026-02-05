<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<div class="card  mt-2 ml-2 box-shadow">
    <div class="card-title  d-flex m-0 text-dark">
        <span class="demo-card__title mdc-typography mdc-typography--headline6 text-dark font-weight-bold m-2">Item Details</span>
    </div>
    <form id="itemForm"  method="post" enctype="multipart/form-data">
        <input type="hidden" name="insert" value="1">
        <div class="card-body p-0 m-0 pl-2 border-top">
            <div class="form-group m-0 p-0">
                <b>selected Category:</b>
                <select class="custom-select w-50" name="catname" id="catname">
                    <?php
                    include('database.php');
                    $sql = "SELECT * FROM menu where m_id=$id";
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
                    <input type="text" class="form-control  text-dark" placeholder="Enter A Item Name" name="name" id="name">
                    <div class="input-group-append">
                        <!-- <div class="input-group-text">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch1" checked>
                                <label class="custom-control-label" for="switch1"></label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <label for="text"> <b>Item Description:</b></label>
               <input type="text" class="form-control  text-dark p-3" placeholder="Enter A Item Desc" name="desc" id="desc">

                <label class="mt-3"><b>Priceing:</b></label>
                <label class="mt-3" style="margin-left:105px">  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="chkqty" name="chkqty">
                        <label class="custom-control-label font-weight-bold" for="chkqty">Add Quantity</label>
                    </div>
                </label>

                <div class="input-group text-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Price</span>
                    </div>
                    <input type="number" class="form-control  text-dark" name="price" id="price">

                        <div class="input-group-prepend itemqty" style="display:none;">
                            <span class="input-group-text">Quantity</span>
                        </div>
                        <input type="number" class="form-control  text-dark itemqty" name="qty" id="qty" style="display:none;">
                </div>

                <label class="mt-2"><b>Upload Item Image:</b></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file" onclick="dispfname()" >
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <div class="d-flex justify-content-center">
                    <input class="btn btnadditem mt-2 mb-2" id="btn"  type="submit" value="save" name="submit" onclick="insertitem(event)">
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){

        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                //alert("Checkbox is checked.");
                $(".itemqty").show();

            }
            else if($(this).prop("checked") == false){
                $(".itemqty").hide();
            }
        });
    });
</script>
