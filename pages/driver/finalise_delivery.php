<?php
  include_once("../sessionCheckPages.php");
  $help="../../help/MakeDelivery-FinaliseDelivery.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Finalise Delivery - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<style type="text/css">
  .dropdown-menu{
    transform: translate3d(0px, 2.7rem, 0px)!important;
  }
</style>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Finalise Delivery</a>
        <?php include_once("../usernavbar.php");?>
        
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
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <label hidden="true" id="aData"><?php echo $_POST["ass"];?></label>
            <label hidden="true" id="apData"><?php echo $_POST["assP"];?></label>
            <div class="col">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Delivery Details</h5>
                      <span id="invNo" class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-truck"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-map-marker-alt"></i><span id="delA"></span></span>
                    <div class="text-nowrap">Delivery in progress</div>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

                <div class="col">
                  <div class="card shadow border-0 gmap_canvas">
                    <?php $address = $_POST["address"] ; /* Insert address Here */

                      echo '<iframe width="150%" height="400" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe>';
                    ?>
                  </div>
                  <style>
                    .gmap_canvas {overflow:hidden;background:none!important;}
                  </style>
                </div>
            </div>
            <br>
               <div class="row ">
                <div class="col ">
                  
                  <form action="sign_off_delivery.php" method="POST">
                    <input type="hidden" name="fAss" id="a1">
                    <input type="hidden" name="fAssP" id="a2" >
                    <button type="submit" class="btn btn-warning text-center">
                      
                          <i class="fas fa-truck"></i>
                          <span>Finalise Delivery</span>    
                    </button>
                  </form>
               
              </div>
              </div>
         </div>

          <!-- Page content -->

        <?php include_once("../footer.php");?>
    
    </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script type="text/javascript" src="JS/finaliseDelivery.js"></script>
</body>

</html>