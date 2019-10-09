<?php include_once("sessionCheckLanding.php");
  $help="help/EmployeeSubsystem.html";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Employee - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Employee</a>
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
              <h3 class="mb-0">Employee Functions</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">

                <?php 
                  if (in_array("2.1", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/employee/add.php">
                      <div>
                        <i class="fas fa-plus"></i>
                        <span>Add Employee</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.2", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/search.php">
                      <div>
                        <i class="far fa-edit"></i>
                        <span>Maintain Employee</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.3", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/search.php">
                      <div>
                        <i class="fas fa-search"></i>
                        <span>Search Employee</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.4", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/search.php">
                      <div>
                        <i class="fas fa-search"></i>
                        <span>Dismiss Employee</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.5", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/checkin.php">
                      <div>
                        <i class="far fa-file-alt"></i>
                        <span>Check-in</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.6", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/checkout.php">
                      <div>
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Checkout</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.7", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/issueWage.php">
                      <div>
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Collect Wage</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("2.8", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/search.php">
                      <div>
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Regenerate Employee Tag</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                 <?php 
                  if (in_array("2.9", $subFunctionality)) {
                ?>
                 <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/employee/changeTimes.php">
                      <div>
                      <i class="far fa-clock"></i>
                        <span>Maintain Checkin/Checkout Time</span>
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