<?php include_once("sessionCheckLanding.php");
  $help="help/SaleSubsystem.html";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Sales - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Sales</a>
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
              <h3 class="mb-0">Sales Functions</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">

                <?php 
                  if (in_array("7.1", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/sales/make-sale.php">
                      <div>
                        <i class="fas fa-dollar-sign"></i>
                        <span>Make Sale</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("7.2", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/sales/search-sale.php">
                      <div>
                        <i class="far fa-times-circle"></i>
                        <span>Return Sale</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("7.3", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/sales/search-sale.php">
                      <div>
                        <i class="fas fa-search-dollar"></i>
                        <span>Search Sale</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("7.4", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/sales/search-sale.php">
                      <div>
                        <i class="fas fa-people-carry"></i>
                        <span>Collect Sale</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("7.5", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a data-dismiss="modal" data-toggle="modal" data-target="#modal-payment" href="">
                      <div>
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Make Payment</span>
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
      <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Payment Option!</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>  
            <div class="modal-body text-centre">
              <p class="px-auto text-center">Does the customer want to pay for a sale or pay off account?</p>   
              <div class="col px-auto text-center">
                <button class="btn btn-icon btn-2 btn-success mt-0 mx-auto col-5" type="button" onclick="window.location='pages/sales/search-sale.php'">
                  <span><i class="fas fa-money-bill-alt"></i></span>
                  <span class="btn-inner--text">Pay Off Sale</span>
                </button>
                <br>
                <button class="btn btn-icon btn-2 btn-default mt-3 px-4 mx-auto col-5" type="button" onclick="window.location='pages/customer/search.php'">
                  <span><i class="fas fa-file-invoice"></i></span>
                  <span class="btn-inner--text">Pay Off Account</span>
                </button>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button> 
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