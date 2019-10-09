<?php
  include_once("../sessionCheckPages.php");
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  $makeDeliveryTrucks=getMakeCollectionTrucks($con);
  $makeDeliveryProducts=getMakeCollectionProduct($con);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Select Truck Collection - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Supplier Collection</a>
        <?php include_once("../usernavbar.php");?>
        
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-default pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row mb-3">
        <div class="col">
          <div class="card shadow col">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Collection Truck Selection</h3>
            </div>
            <div class="card-body">    
              <br>          
              <div class="form-group">
                <label hidden="true" id="mTrucks"><?php echo json_encode($makeDeliveryTrucks);?></label>
                <label hidden="true" id="pTrucks"><?php echo json_encode($makeDeliveryProducts);?></label>
                <label for="exampleFormControlSelect2">Truck Registration No.</label>

                <select  class="form-control" id="truckSelect">
                </select>
              </div>
             
              <div class="col mt-4 text-center">
                <button class="btn btn-icon btn-2 btn-default mt-0" type="button" data-dismiss="modal" data-toggle="modal" data-target="#finalise">
                  <span class="btn-inner--text">Select Truck</span>
                </button>
              </div>
              <br>
              <br>  
            </div>
  
            <div class="modal fade" id="finalise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to select this truck to make a Supplier Collection?</p>
                    </div>
                    <div class="modal-footer">
                    <form action="list_collection.php" method="GET">
                      <input type="hidden" id="a1" name="ass">
                      <input type="hidden" id="a2" name="assP">
                      <button type="submit" class="btn btn-success" id="btnYes" >Yes</button>
                    </form> 
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once("../footer.php");?>
    </div>
  </div>
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
  <script type="text/javascript" src="JS/selectCollectionTruck.js"></script>
</body>

</html>