

<nav class="navbar navbar-custom fixed-top p-0">

  <a class="navbar-brand navbar-logo  text-light" href="#">
    <!-- <i class="fas fa-hamburger"></i> -->
    <img src="images/foodify-logo.png" style="width:35px;">
  </a>
  <button class="navbar-toggler navbar-brand navbar-logo" type="button"  onclick="$('.sidebar').toggle()"
  style="display: none">
    <i class="fa fa-bars text-white" aria-hidden="true"></i>
  </button>

  <!-- <div  id="collapsibleNavbar"> -->
    <ul class="nav pt-2">
      <?php
            $sql = "SELECT * FROM `restaurants` where res_id=".$_SESSION['resid']."";  
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                if($row['availability']==1){
                ?>
                <b class="mt-2 text-light mr-2" id="res_state">ON</b>
                <label class="switch mr-1 mt-1">
                      <input type="checkbox" checked>
                      <span></span>
                </label>
                <?php
                }else{
                  ?>
                  <b class="mt-2 text-light mr-2" id="res_state">OFF</b>
                  <label class="switch mr-1 mt-1">
                        <input type="checkbox">
                        <span></span>
                  </label>
                  <?php
                }
              }
            }
      ?>
      
      <li class="nav-item mr-2 dropdown dropleft" id="notification-dropdown">
        <a class="nav-link navbar-text  text-light "  style="position:relative;cursor:pointer"
          id="navbarDropdown" type="button"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
          <i class="far fa-bell nav-iconsize mr-2" aria-hidden="true"></i>
          
          <span class="badge badge-pill badge-info bg-white px-1 text-dark" style="position: absolute;top: 1px;right: 2px;">
          <?php
          $sql="SELECT * FROM `tbl_order` where r_id=".$_SESSION['resid']." AND order_status='new'";
          $result=mysqli_query($conn,$sql);
          $no_rows=mysqli_num_rows($result);
          echo $no_rows;
          ?>
          </span>
        </a>
        <div  class="dropdown-menu mt-5" aria-labelledby="navbarDropdown" style="top: -11px;right: 30%">
          <?php
            $sql="SELECT * FROM `tbl_order` where r_id=".$_SESSION['resid']." AND order_status='new'";
            $result=mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
              ?>
              <a class="dropdown-item px-4 py-2" href="#">
                  <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
                  <span class="text-info">New Order Received</span>
                  <p class="text-muted text-right mb-0"><small>
                  <?php
                      $order_time = $row['order_date'];
                      $order_time= date('h:i', strtotime($order_time));
                      echo "At ".$order_time;
                  ?>
                  </small></p>
              </a>
              <div class="dropdown-divider"></div>
              <?php
              }
          }else{
            ?>
            <a class="dropdown-item px-4 py-2" href="#">
                  <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
                  <span class="text-info">No  Orders</span>
            </a>
            <?php
          }  
          ?>
        </div>
      </li>
      
      
      <li class="nav-item">
        <a class="nav-link navbar-text text-light" href="editproflie.php">
          <i class="fas fa-user-edit nav-iconsize" aria-hidden="true"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link navbar-text text-light" onclick="logout()">
          <i class="material-icons nav-iconsize">power_settings_new</i>
        </a>
      </li>
    </ul>
  <!-- </div> -->
</nav>
