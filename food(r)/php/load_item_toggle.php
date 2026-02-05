<?php
include('database.php');
if(isset($_GET['id']))
{
    $id = $_GET['id'];
?>

<div class="mdc-card mdc-card--outlined box-shadow" style="width: 95%">
    <div class="card-body p-0 border-0">
        <h5 class="card-title bg-transparent text-secondary d-flex pt-2 pr-2">
            <?php
            $sql = "SELECT * FROM item where m_id=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<span class='demo-card__title mdc-typography mdc-typography--headline6 text-dark font-weight-bold ml-3' >Items|".$row."</span>";
            ?>
        </h5>
        <ul class="mdc-list border-top" style="width: 100%">
            <?php
            $sql = "SELECT * FROM item where m_id=$id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                $id=$row['id'];
                $name=$row['item_name'];
                if($row['availability']==0){
                    echo  "<li class='d-flex justify-content-between list-group-item border-0 w-100 bg-transparent '>
                    $name
                    ";?>
                    <label class="label">
                        <div class="toggle">
                            <input class="toggle-state" type="checkbox" name="chkstock" id="chkstock" value="<?php echo $id; ?>" />
                            <div class="toggle-inner">
                                <div class="indicator"></div>
                            </div>
                            <div class="active-bg"></div>
                        </div>
                    </label>
                <?php echo "</li>";
                }
                else{
                    echo  "<li class='d-flex justify-content-between list-group-item border-0 w-100 bg-transparent '>
                    $name
                    ";?>
                    <label class="label">
                        <div class="toggle">
                            <input class="toggle-state" type="checkbox" name="chkstock" id="chkstock" value="<?php echo $id; ?>" checked />
                            <div class="toggle-inner">
                                <div class="indicator"></div>
                            </div>
                            <div class="active-bg"></div>
                        </div>
                    </label>
                <?php echo "</li>";

                }
                
                
                }
            } 
            ?>
        </ul>
    </div>
</div>

<?php
}
?>
<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
                $.ajax({
                    type: "GET",
                    url: "php/out_of_stock_item.php?id=" + $(this).val() + "&action=1",
                    dataType: "html",
                    success: function(response) {
                        $('.outofstockitem').html(response);
                    }
                });
                
            }
            else if($(this).is(":not(:checked)")){
                $.ajax({
                    type: "GET",
                    url: "php/out_of_stock_item.php?id=" + $(this).val() + "&action=0",
                    dataType: "html",
                    success: function(response) {
                        $('.outofstockitem').html(response);
                    }
                });
            }
        });
    });
</script>