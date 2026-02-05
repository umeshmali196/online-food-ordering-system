<!-- Navbar -->
<div class="navbar navbar-expand-md bg-border-info fixed-top bg-white pb-0 mb-0">
    <a class="navbar-brand" href="index.php"><img src="img/logo (1).png" alt="logo" style="width:60px; "></a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="fa fa-bars text-dark "></span>
    </button>
    <span class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class='nav-link  px-3 mt-2' style="font-size: 14pt;">
                <a href="search.php" class="fa fa-search">
                    <b>Search</b>
                </a>
            </li>
            <li class='nav-link px-3 mt-2' style="font-size: 14pt;">
                <a href="offers.php" class="fa fa-percent">
                    <b>Offers</b></a>
            </li>
            <?php
            if(isset($_SESSION['uid'])){
                $sql = "SELECT * FROM user where u_id='".$_SESSION['uid']."'";
                $result = mysqli_query($conn, $sql);
                
                $row = mysqli_fetch_assoc($result);
                
                ?>
            
                <li class="nav-item dropdown mt-2" style="font-size: 14pt;">
                    <a class="nav-link dropdown-toggle far fa-user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b><?php echo $row['name'] ?></b>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item font-weight-normal" href="profile.php">Profile</a>
                        <a class="dropdown-item font-weight-normal" href="order.php">Orders</a>
                        <a class="dropdown-item font-weight-normal" href="favourite.php">Favorites</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-normal" href="php/logout.php">Logout</a>
                    </div>
                </li>
                <?php
            }
            else{
                ?>
            <li class="nav-item ">
                        <li class='nav-link px-3 mt-2' style="font-size: 14pt;">
                            <a  href="#" class="far fa-user" data-toggle="modal" data-target="#loginmodal" >
                                <b>Login</b></a>

                        </li>
                <?php
            }
            ?>
            <?php 
            if(isset($_SESSION["shopping_cart"])){
                $count = count($_SESSION["shopping_cart"]);
                ?>
                    <li class="nav-item">
                        <li class='nav-link'>
                            <div style=" position: relative;text-align: center;color: white;">
                                <a href="cart.php">
                                    <img src="https://img.icons8.com/ios/50/000000/shopping-bag.png" class="w-75"/>
                                    <b id="cartcounter" class="font-weight-bold" style=" position: absolute;top: 60%;left: 50%;transform: translate(-50%, -50%);color: black;">
                                    <?php echo $count; ?>
                                    </b>
                                </a>
                                
                            </div>
                        </li>
                    </li>
                <?php
            }
            else{
                ?>
                <li class="nav-item">
                        <li class='nav-link'>
                            <div style=" position: relative;text-align: center;color: white;">
                                <a href="cart.php">
                                    <img src="https://img.icons8.com/ios/50/000000/shopping-bag.png" class="w-75"/>
                                    <b id="cartcounter" class="font-weight-bold" style=" position: absolute;top: 60%;left: 50%;transform: translate(-50%, -50%);color: black;">
                                    <?php echo 0; ?>
                                    </b>
                                </a>
                                
                            </div>
                        </li>
                    </li>
                <?php
            }
            
            ?>

            
        </ul>
    </div>
</div>
<!-- EndNavbar -->