<?php include_once("sessionCheckLanding.php");
  $help="help/DeliveryCollectionSubsystem.html";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Delivery/Collection - Stock Path</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<body>
  <?php include_once("header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Delivery/Collection</a>
        <?php include_once("usernavbar.php");?>
        
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-custom pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Delivery/Collection Functions</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">

                <?php 
                  if (in_array("10.1", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/sales/search-sale.php">
                      <div>
                        <i class="fas fa-truck"></i>
                        <span>Add Sale Delivery</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.2", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/search-sale-delivery.php">
                      <div>
                        <i class="far fa-window-close"></i>
                        <span>Cancel Sale Delivery</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.3", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/search-sale-delivery.php">
                      <div>
                        <i class="fas fa-search"></i>
                        <span>Search Sale Delivery</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.4", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/supplier/search-order.php">
                      <div>
                        <i class="fas fa-truck-moving"></i>
                        <span>Add Order Collection</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.5", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/search-supplier-order-collection.php">
                      <div>
                        <i class="far fa-times-circle"></i>
                        <span>Cancel Order Collection</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.6", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/search-supplier-order-collection.php">
                      <div>
                        <i class="fas fa-search"></i>
                        <span>Search Order Collection</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.7", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/add_truck.php">
                      <div>
                        <i class="fas fa-plus"></i>
                        <span>Add Truck</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.8", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/search-truck.php">
                      <div>
                        <i class="fas fa-wrench"></i>
                        <span>Maintain Truck</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.9", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/search-truck.php">
                      <div>
                        <i class="fas fa-search"></i>
                        <span>Search Truck</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.101", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/template-assign.php">
                      <div>
                        <i class="fas fa-truck"></i>
                        <span>Assign Delivery</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.11", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/maintain-assigned-truck.php">
                      <div>
                        <i class="far fa-edit"></i>
                        <span>Maintain Assigned Truck</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("10.12", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/finalise-assigned-truck.php">
                      <div>
                        <i class="far fa-check-square"></i>
                        <span>Finalise Assigned Truck</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>
                <?php 
                  if (in_array("10.13", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/assign-collection.php">
                      <div>
                        <i class="fas fa-truck-moving"></i>
                        <span>Assign Collection</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>
                <?php 
                  if (in_array("10.14", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/maintain-assigned-collection.php">
                      <div>
                        <i class="far fa-edit"></i>
                        <span>Maintain Assigned Collections</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>
                <?php 
                  if (in_array("10.15", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/delivery_collection/finalise-assigned-collection.php">
                      <div>
                        <i class="far fa-check-square"></i>
                        <span>Finalise Assigned Collections</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>


              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once("footer.php");?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="InactivityLogoutLanding/autologout.js"></script>
</body>

</html>