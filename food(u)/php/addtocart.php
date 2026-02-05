<?php
include 'database.php';
// $i=0;
if (isset($_GET["add"])) 
{
	
	if(isset($_GET["cres"]))
	{
		unset($_SESSION["shopping_cart"]);
		$id = $_GET["id"];
		
		$sql    = "SELECT * FROM `item` where id=$id";
		$result = mysqli_query($conn, $sql);
		$row    = mysqli_fetch_assoc($result);
		
		$sql2    = "SELECT * FROM `menu` where m_id=" . $row['m_id'] . "";
		$result2 = mysqli_query($conn, $sql2);
		$row2    = mysqli_fetch_assoc($result2);
		
		$sql3    = "SELECT * FROM `restaurants` where res_id=" . $row['res_id'] . "";
		$result3 = mysqli_query($conn, $sql3);
		$row3    = mysqli_fetch_assoc($result3);
		
		$item_array                   = array(
			'item_id' => $row["id"],
			'item_name' => $row["item_name"],
			'item_price' => $row["price"],
			'menu_name' => $row2["m_name"],
			'res_id' => $row3["res_id"],
			'res_name' => $row3["name"],
			'res_img' => $row3["image_name"],
			'item_quantity' => 1
		);
		$_SESSION["shopping_cart"][0] = $item_array;
		$count= count($_SESSION["shopping_cart"]);
		echo $count;
	}
	else
	{
		if (isset($_SESSION["shopping_cart"])) 
		{
			$item_array_id      = array_column($_SESSION["shopping_cart"], "item_id");
			$item_array_resname = array_column($_SESSION["shopping_cart"], "res_name");
			$count = count($_SESSION["shopping_cart"]);
			$id    = $_GET["id"];
			
			$sql    = "SELECT * FROM `item` where id=$id";
			$result = mysqli_query($conn, $sql);
			$row    = mysqli_fetch_assoc($result);
			
			$sql2    = "SELECT * FROM `menu` where m_id=" . $row['m_id'] . "";
			$result2 = mysqli_query($conn, $sql2);
			$row2    = mysqli_fetch_assoc($result2);
			
			$sql3    = "SELECT * FROM `restaurants` where res_id=" . $row['res_id'] . "";
			$result3 = mysqli_query($conn, $sql3);
			$row3    = mysqli_fetch_assoc($result3);
			if (in_array($row3["name"], $item_array_resname)) {
				$item_array  = array(
					'item_id' => $row["id"],
					'item_name' => $row["item_name"],
					'item_price' => $row["price"],
					'menu_name' => $row2["m_name"],
					'res_id' => $row3["res_id"],
					'res_name' => $row3["name"],
					'res_img' => $row3["image_name"],
					'item_quantity' => 1
				);
				$_SESSION['index']=$_SESSION['index']+1;
				$_SESSION["shopping_cart"][$_SESSION['index']] = $item_array;
				$count= count($_SESSION["shopping_cart"]);
				echo $count;

			} else {
				unset($_SESSION['promocode']);
				unset($_SESSION['promoamount']);
				echo "res0";
			}
				
		}
		else 
		{
			$id = $_GET["id"];
			$sql    = "SELECT * FROM `item` where id=$id";
			$result = mysqli_query($conn, $sql);
			$row    = mysqli_fetch_assoc($result);
			
			$sql2    = "SELECT * FROM `menu` where m_id=" . $row['m_id'] . "";
			$result2 = mysqli_query($conn, $sql2);
			$row2    = mysqli_fetch_assoc($result2);
			
			$sql3    = "SELECT * FROM `restaurants` where res_id=" . $row['res_id'] . "";
			$result3 = mysqli_query($conn, $sql3);
			$row3    = mysqli_fetch_assoc($result3);
			
			$item_array  = array(
				'item_id' => $row["id"],
				'item_name' => $row["item_name"],
				'item_price' => $row["price"],
				'menu_name' => $row2["m_name"],
				'res_id' => $row3["res_id"],

				'res_name' => $row3["name"],
				'res_img' => $row3["image_name"],
				'item_quantity' => 1
			);
			$_SESSION["shopping_cart"][0] = $item_array;
			$_SESSION['index']=0;
			$count= count($_SESSION["shopping_cart"]);
			echo $count;
		}
	}
}
if (isset($_GET["addqty"])) {
	$id = $_GET["addqty"];
	$total=0;
	$sql    = "SELECT * FROM `item` where id=$id";
	$result = mysqli_query($conn, $sql);
	$row    = mysqli_fetch_assoc($result);
    
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_GET["addqty"]) {
			$qty= $_SESSION["shopping_cart"][$keys]["item_quantity"];
			
			$a= $qty + 1;
			if($row['quantity'] != ""){
				if($row['quantity'] >= $a){
					$_SESSION["shopping_cart"][$keys]["item_quantity"] = $a;
					echo '<script>window.location="../cart.php"</script>';
				}
				else{
					$x=$a-1;
					echo "noqty";
					echo '<script>window.location="../cart.php?lessqty=1"</script>';
				}
			}else{
				$_SESSION["shopping_cart"][$keys]["item_quantity"] = $a;
				echo '<script>window.location="../cart.php"</script>';
			}
						
        }
	}
	if(isset($_SESSION['promocode'])){
		foreach ($_SESSION["shopping_cart"] as $keys => $values){
			$total = $total + ($values["item_quantity"] * $values["item_price"] );
		}
		$code=$_SESSION['promocode'];
		$sql = "SELECT * FROM `offers` where offer_code='$code'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['discount_type'] == "percent"){
			$dicount = $total*$row['discount_percentage']/100;
			if($row['max_discount_amount'] >= $dicount){
				$_SESSION['promoamount']=$dicount;
			}else{
				$_SESSION['promoamount']=$row['max_discount_amount'];
			}
		}
	}
	
}
if (isset($_GET["subqty"])) {
    $id = $_GET["subqty"];
	$total=0;
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_GET["subqty"]) {
            $qty = $_SESSION["shopping_cart"][$keys]["item_quantity"];
            if ($qty == 1) {
				unset($_SESSION['shopping_cart'][$keys]);
				$count = count($_SESSION["shopping_cart"]);
				if($count == 0) {
					unset($_SESSION["shopping_cart"]);
				}
                echo '<script>window.location="../cart.php"</script>';
            } else {
                $a = $qty - 1;
				$_SESSION["shopping_cart"][$keys]["item_quantity"] = $a;
                echo '<script>window.location="../cart.php"</script>';
            }
            
        }
	}
	if(isset($_SESSION['promocode'])){
		$code=$_SESSION['promocode'];
		foreach ($_SESSION["shopping_cart"] as $keys => $values){
			$total = $total + ($values["item_quantity"] * $values["item_price"] );
		}
		$sql = "SELECT * FROM `offers` where offer_code='$code'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['min_amount'] <= $total){
			if($row['discount_type'] == "percent"){
				
				$dicount = $total*$row['discount_percentage']/100;
				if($row['max_discount_amount'] >= $dicount){
					$_SESSION['promoamount']=$dicount;
				}else{
					$_SESSION['promoamount']=$row['max_discount_amount'];
				}
			}
		}else{
			unset($_SESSION['promocode']);
			unset($_SESSION['promoamount']);
		}
	}

}
if (isset($_GET["itemcount"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $count = count($_SESSION["shopping_cart"]);
        echo $count;
    }else{
		echo "0";
	}
}
if (isset($_GET["clearcart"])) {
	unset($_SESSION['promocode']);
	unset($_SESSION['promoamount']);
	unset($_SESSION["shopping_cart"]);
	echo '<script>window.location="../cart.php"</script>';

}
if(isset($_GET['setpromocode'])){
	$code=$_GET['setpromocode'];
	$total=0;
	if($code == "unsetpromocode"){
		unset($_SESSION['promocode']);
		unset($_SESSION['promoamount']);
		echo "1";
	}else{
		foreach ($_SESSION["shopping_cart"] as $keys => $values){
			$total = $total + ($values["item_quantity"] * $values["item_price"] );
		}

		$sql = "SELECT * FROM `offers` where offer_code='$code'";
		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0)
		{
			$row=mysqli_fetch_assoc($result);
			if($row['valid_user'] == "newuser"){
				if(isset($_SESSION['uid']))
				{
					$sql = "SELECT * FROM `tbl_order` where  u_id=".$_SESSION['uid']."" ;
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) == 0)
					{
						if($row['min_amount'] <= $total)
						{
							date_default_timezone_set('Asia/Kolkata');

							$dateTimestamp1 = strtotime($row['expire_time']); 
							$dateTimestamp2 = strtotime("now");
						
							$date1 = date("Y-m-d g:i",$dateTimestamp1);
							$date2 = date("Y-m-d g:i",$dateTimestamp2); 
							if($date1 > $date2)
							{
								$_SESSION['promocode']=$code;
								if(isset($_SESSION['promocode']))
								{
									if($row['discount_type'] == "flat")
									{
										$_SESSION['promoamount']=$row['flat_discount_amount'];
										echo "1";
									}
									if($row['discount_type'] == "percent")
									{
										$dicount = $total*$row['discount_percentage']/100;
										if($row['max_discount_amount'] >= $dicount)
										{
											$_SESSION['promoamount']=$dicount;
											echo "1";
										}
										else
										{
											$_SESSION['promoamount']=$row['max_discount_amount'];
											echo "1";
										}
									}
								}
							}
							else
							{
								echo "TimeErr";
							}
							
						}
						else
						{
							echo "minAmountErr";
						}
					}
					else
					{
						echo "newUserErr";
					}
				}
				else
				{
					echo "loginErr";
				}	
			}
			else
			{
				if($row['min_amount'] <= $total)
				{
						date_default_timezone_set('Asia/Kolkata');

						$dateTimestamp1 = strtotime($row['expire_time']); 
						$dateTimestamp2 = strtotime("now");
					
						$date1 = date("Y-m-d g:i",$dateTimestamp1);
						$date2 = date("Y-m-d g:i",$dateTimestamp2);
						if ($date1 > $date2) {
							$_SESSION['promocode']=$code;
							if(isset($_SESSION['promocode']))
							{
								if($row['discount_type'] == "flat")
								{
									$_SESSION['promoamount']=$row['flat_discount_amount'];
									echo "1";
								}
								if($row['discount_type'] == "percent")
								{
										$dicount = $total*$row['discount_percentage']/100;
										if($row['max_discount_amount'] >= $dicount)
										{
											$_SESSION['promoamount']=$dicount;
											echo "1";
										}
										else
										{
											$_SESSION['promoamount']=$row['max_discount_amount'];
											echo "1";
										}
								}
							} 
						}
						else
						{
							echo "TimeErr"; 
						}
					
				}
				else
				{
					echo "minAmountErr";
				}
			}
			
		}
		else
		{
			echo "invlidCodeErr";
		}	
	}
}
?>