
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
include "php/database.php";
$target_dir = "../uploads/";
$images = glob($target_dir."*");

?>
<!-- <table>
    <thead>
    <tr>
        <th>
           Rec No 
        </th>
        <th>
            Image
        </th>
        <th>
            Name
        </th>
    </tr>
    </thead>
    <tbody> -->
    <?php
    $j=0;
    $i=0;
    $k=0;
    
    foreach($images as $image){
        // echo "<tr>";
        $j++;
        $sql = "SELECT * FROM item";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if(substr($image,11) == $row["image_name"]){
                $target_file = $target_dir  . $row["image_name"];
                if (file_exists($target_file)) {
                    unlink($target_file);
                        
                } 
            }
            }
        }
    ?>

    
    <!-- </tbody>
</table> -->

</body>
</html>