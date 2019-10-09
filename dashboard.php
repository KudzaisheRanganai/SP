<?php include_once("sessionCheckLanding.php");?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Dashboard - Stock Path</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- calendar -->
    <link href='assets/fullcalender/packages/core/main.css' rel='stylesheet' />
  <link href='assets/fullcalender/packages/daygrid/main.css' rel='stylesheet' />
  <link href='assets/fullcalender/packages/bootstrap/main.css' rel='stylesheet' />
</head>
<body>
  <?php include_once("header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Dashboard</a>
        <?php include_once("usernavbar.php");?>
        
      </div>
    </nav>

    <!-- Header -->
    <div class="header bg-gradient-custom pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New Credit Customers</h5>
                      <span class="h2 font-weight-bold mb-0" id="NoOfCustomers"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-dot-circle" id="percentageOfCustomers"></i></span>
                    <span class="text-nowrap" >Rate of Credit Customer Growth</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Checked-in Employees</h5>
                      <span class="h2 font-weight-bold mb-0" id="NoOfEmployees"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-dot-circle" id="percentageOfEmployees"></i></span>
                    <span class="text-nowrap">Available Employees</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Active Admin Employees</h5>
                      <span class="h2 font-weight-bold mb-0" id="NewEmployees"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-dot-circle" id="percentageOfNewEmployees"></i></span>
                    <span class="text-nowrap">Activity </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Daily Deliveries</h5>
                      <span class="h2 font-weight-bold mb-0" id="noOfDailyDeliveries"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-truck"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-dot-circle" id="percentageOfDailyDeliveries"></i></span>
                    <span class="text-nowrap">Today's Deliveries</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card bg-gradient-default shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                  <h2 class="text-white mb-0" id="PeriodAttr"></h2>
                </div>
               
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="line-chart" ></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h2 class="mb-0" id="PeriodAttrOrder"></h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="bar-chart" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 

        
          echo '      <div class="row mt-5">
        <div class="col">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Calendar</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                
                <div id="calender"></div>
               
              </div>
            </div>
          </div>
        </div>
      </div>';
  
      ?>
      <form id="delView" method="POST" action="pages/delivery_collection/assign-truck-view-delivery.php">
        <input type="hidden" name="SALE_ID" id="delID">
        <input type="hidden" name="DEL_INFO" id="delInfo">
        <input type="hidden" name="choice" value="2">
      </form>
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
  <script type="text/javascript">
    var session = eval('(<?php echo json_encode($_SESSION)?>)');
    console.log(session);
  </script>
    <!-- Moment JS -->
    <script src="assets/js/moment.js"></script>
    <!--script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script-->
  <script src="pages/employee/JS/noOfWorkers.js"> </script>
  <script src="pages/customer/JS/noOfCustomer.js"> </script>
  <script src="pages/sales/JS/salesGraphDashboard.js"> </script>
  <script src="pages/supplier/JS/orderGraph.js"> </script>
  <script src="pages/employee/JS/newEmployees.js"> </script>
  <script src="pages/driver/JS/TodaysDeliveries.js"> </script>

    <script src='assets/fullcalender/packages/core/main.js'></script>
  <script src='assets/fullcalender/packages/daygrid/main.js'></script>
  <script src='assets/fullcalender/packages/timegrid/main.js'></script>
  <script src='assets/fullcalender/packages/list/main.js'></script>
  <script src='assets/fullcalender/packages/bootstrap/main.js'></script>
  <script type="text/javascript" src="pages/delivery_collection/JS/calendar.js"></script>
  <!-- <script src="InactivityLogoutLanding/autologout.js"></script> -->
</body>

</html>