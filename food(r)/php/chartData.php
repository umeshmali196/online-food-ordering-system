<?php
include 'database.php';
if(isset($_GET['reports']))
{
  
  if($_GET['reports'] == "Today"){
    $data['label']="Today";
    $sql = "SELECT SUM(subtotal),DATE_FORMAT(DATE(order_date),'%M %d') as date FROM `tbl_order` WHERE r_id=".$_SESSION['resid']." AND DATE(order_date)=CURDATE()";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    for($i=0;$i<5;$i++){
      if($i== 0){
        $data['labels'][$i]=$row['date'];
        $data['data'][$i]=$row['SUM(subtotal)'];
        $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
        $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }else{
        $data['labels'][$i]=0;
        $data['data'][$i]=0;
        $data['borderColor'][$i]="rgba(255,99,132,1)";
        $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
      }
    }
  }
  if($_GET['reports'] == "Yesterday"){
    $data['label']="Yesterday";
    $sql = "SELECT SUM(subtotal),DATE_FORMAT(DATE(order_date),'%M %d') as date FROM `tbl_order` WHERE r_id=".$_SESSION['resid']." AND DATE(order_date)=SUBDATE(CURDATE(),INTERVAL 1 DAY)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    for($i=0;$i<5;$i++){
      if($i== 0){
        $data['labels'][$i]=$row['date'];
        $data['data'][$i]=$row['SUM(subtotal)'];;
        $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
        $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }else{
        $data['labels'][$i]=0;
        $data['data'][$i]=0;
        $data['borderColor'][$i]="rgba(255,99,132,1)";
        $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
      }
    }
  }
  if($_GET['reports'] == "Last7days"){
    $data['label']="Last 7 Days";
    for ($i=0; $i<7; $i++){
      $date=date("Y-m-d", strtotime($i." days ago"));
      $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE r_id=".$_SESSION['resid']." AND DATE(order_date) = '$date' GROUP BY DATE(order_date)";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $day=$i+1;
          $data['labels'][$i]=date("F d",strtotime($i." days ago"));
          $data['data'][$i]=$row['SUM(subtotal)'];
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }
      }else{
          $data['labels'][$i]=date("F d",strtotime($i." days ago"));
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }
    }
    
    
  }
  if($_GET['reports'] == "Last15days"){
    $data['label']="Last 15 Days";
    for ($i=0; $i<15; $i++){
      $date=date("Y-m-d", strtotime($i." days ago"));
      $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE r_id=".$_SESSION['resid']." AND DATE(order_date) = '$date' GROUP BY DATE(order_date)";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $day=$i+1;
          $data['labels'][$i]=date("M d", strtotime($i." days ago"));
          $data['data'][$i]=$row['SUM(subtotal)'];
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }
      }else{
          $data['labels'][$i]=date("M d", strtotime($i." days ago"));
          $data['data'][$i]=100;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }
    }
  }
  if($_GET['reports'] == "Lastweek"){
    $data['labels']=array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday");
    $data['label']="Week Sales";
    $data['data']=array("10","20","10","30","40","50","60");
    for($i=0;$i<7;$i++){
      if($i%2== 0){
        $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
        $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }else{
        $data['borderColor'][$i]="rgba(255,99,132,1)";
        $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
      }
    }
  }
  if($_GET['reports'] == "Lastmonth"){
    $data['label']="Last Month";
    for($i=0;$i<30;$i++){
      $data['labels'][$i]=$i+1;
      $data['data'][$i]=$i+10;
      if($i%2== 0){
        $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
        $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }else{
        $data['borderColor'][$i]="rgba(255,99,132,1)";
        $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
      }
    }
  }
  
  echo json_encode($data);
}
else
{
  $date=date("W")-1;
  $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE r_id=".$_SESSION['resid']." AND WEEK(order_date,7)=$date";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  // $data['totalsales'][0]=$row['SUM(subtotal)'];
  $data['totalsales']=array("0","0","0","0","0","0","0");
  $sql = "SELECT SUM(subtotal),DAYOFWEEK(order_date) FROM `tbl_order` WHERE r_id=".$_SESSION['resid']." AND WEEK(order_date,7)=$date GROUP BY DAY(order_date) ORDER BY DAY(order_date) ASC";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)> 0){
    while($row = mysqli_fetch_assoc($result)){
      $x=(int)$row['DAYOFWEEK(order_date)'];
      if($x == "1"){
        $x=6;
      }else{
        $x=$x-2;
      }
      $data['totalsales'][$x]=$row['SUM(subtotal)'];
    }

  }else{
    unset($data);
    $data=0;
  }
  echo json_encode($data);
}
?>