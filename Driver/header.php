<!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./driver.php">
        <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../pages/employee/images/ProfilePic/<?php echo $_SESSION["employeeID"]?>.jpg" onerror="this.onerror=null;this.src='assets/img/theme/admin.jpg'; this.style.width = '44px'; this.style.height = '44px';" style="width: 36px; height: 36px;">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="pages/profile/my-profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="assets/logout/PHPcode/logout.php" class="dropdown-item" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="./assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">

        <!-- Heading -->
          <?php 
          if (in_array("0", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <?php
            }
          ?>
          
          <?php 
          if (in_array("1", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="customer.php">
              <i class="ni ni-circle-08 text-green"></i> Customer  
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("2", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">
              <i class="ni ni-badge text-orange"></i> Employee
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("3", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="ni ni-laptop text-yellow"></i> User
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("4", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="admin.php">
              <i class="ni ni-settings text-red"></i> Administration
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("5", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="supplier.php">
              <i class="ni ni-briefcase-24 text-info"></i> Suppliers
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("6", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="warehouse.php">
              <i class="ni ni-shop text-pink"></i> Warehouse
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("7", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="sales.php">
              <i class="ni ni-cart text-green"></i> Sales
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("8", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="product.php">
              <i class="ni ni-basket text-orange"></i> Products
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("9", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="stock.php">
              <i class="ni ni-box-2 text-yellow"></i> Stock
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("10", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="delivery_collection.php">
              <i class="ni ni-delivery-fast text-red"></i> Delivery/Collection
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("11", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="driver.php">
              <i class="ni ni-user-run text-pink"></i> Driver
            </a>
          </li>
          <?php
            }
          ?>

          <?php 
          if (in_array("12", $accessLevels)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="reporting.php">
              <i class="ni ni-chart-bar-32 text-info"></i> Reports
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
