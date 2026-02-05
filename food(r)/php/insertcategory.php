<html>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <?php
     include 'database.php';  
     $catname=$_POST['txtcatname'];
     //$catname='asfdsg';
     $sql = "SELECT * FROM `menu` WHERE m_name='$catname'  and res_id=$resid";
     $result = mysqli_query($conn, $sql);
     if(mysqli_num_rows($result) > 0)
     {
        //echo " menu already Exits";
            ?>
    <script type="text/javascript">
    (async () => {
        const {
            value: response
        } = await Swal.fire({
            icon: 'error',
            title: 'menu already exits',
        })

        if (response) {
            window.location.replace("../menu.php");
        }

    })()
    </script>
    <?php
        // header('Location:http://localhost/Food%20Project/menu.php');
     }
     else{
        $sql = "INSERT INTO `menu`(`m_name`, `res_id`) 
        VALUES ('$catname',$resid)";
        if (mysqli_query($conn, $sql)) {
            header('Location:../menu.php');
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }
     }
	
    mysqli_close($conn);
?>
</body>
</html>