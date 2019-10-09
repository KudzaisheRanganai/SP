<?php
  include_once("../sessionCheckPages.php");
  $help="../../help/MakeCollection-SupplierFinaliseC.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Finalise Collection - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Finalise Collection</a>
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
            <label hidden="true" id="aData"><?php echo $_POST["fAss"];?></label>
            <label hidden="true" id="apData"><?php echo $_POST["fAssP"];?></label>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Supplier Detials</h5>
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
                    <span class="text-nowrap">Finalisation in progress</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
                <div class="col">
                  <div class="card shadow border-0 gmap_canvas">
                    <div class="table-responsive">
                      <table id="myTable" class="table align-items-center table-flush">
                         <thead class="thead-light">
                        <tr class="header">


                          <th class="text-center">Oty Received</th>
                          <th class="text-center"> Qty</th>
                          <th> Item Name</th>
                          
                        </tr>
                      </thead>
                      <tbody id="tBody">
                        </tbody>
                      </table>
                  </div>  
                </div>
              </div>
          </div>
          <br>
            <button class="btn btn-warning text-center" type="button" data-dismiss="modal" data-toggle="modal" id="btnSubmit">
                  <i class="fas fa-truck"></i>
                      <span>Submit</span>
            </button>
            <div class="form-group col-md-2 errorModal successModal text-center">
                          <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                              <div class="modal-content">
                                <div class="modal-header" id="modalHeader">
                                    <h6 class="modal-title" id="MHeader">Success</h6>
                                </div>
                                <div class="modal-body">
                                  <p id="MMessage">Successfully Added</p>
                                  
                                  <div id="animation" style="text-align:center;">

                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="btnClose">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <!-- Page content -->
  

        
        <?php include_once("../footer.php");?>
    
    </div>
    <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-sm">
          <div class="modal-content px-auto" style="">
              <img class="loading" src="../../assets/img/loading/loading.gif">
          </div>
      </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  
  <script href="../../assets/js/jquery-3.3.1.slim.min.js"></script>
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../../assets/js/signature-canvas.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script type="text/javascript" src="JS/makeCollection.js">

  </script>
</body>

</html>