<?php
include('database.php');
if(isset($_GET['id']))
{
    $cid = $_GET['id'];
?>

<div class="mdc-card mdc-card--outlined ml-1 mt-2 box-shadow" style="width: 100%">
    <div class="card-body p-0 border-0">
        <h5 class="card-title text-secondary d-flex m-0 ">
            <?php
            $sql = "SELECT * FROM item where m_id=$cid";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<span class='demo-card__title text-dark font-weight-bold m-2' >Items|" . $row . "</span>";    
            echo "<button type='button' class='btn  ml-auto mt-2 pt-1 pr-2 mb-1 text-dark font-weight-bold' onclick='loadadditem_layout($cid)'>Add Item</button>"; ?>
        </h5>
        <ul class="mdc-list border-top rolldown-list " style="width: 100%" id="itemlist">
            <?php
            $sql = "SELECT * FROM item where m_id=$cid";
           
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                $id=$row['id'];
                $name=$row['item_name'];
                echo  "<li class=' '><div class='itemlist'>
                <button class='mdc-list-item mdc-list-item__text border-0 libtn' onclick='load_update_item($id)'>$name</button>";
                ?>
                <i class='far fa-times-circle  animated fadeIn text-danger font-weight-bold' onclick="deleteitem(<?php echo $id; ?>,'<?php echo $name; ?>','<?php echo $cid; ?>')"></i>
                <?php echo "</div></li>";
            }
            } 
            ?>
        </ul>
    </div>
</div>
</div>

<?php
}
?>