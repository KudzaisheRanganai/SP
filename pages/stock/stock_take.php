<?php 
  include_once("../sessionCheckPages.php");
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  $warehouseData=getWarehouseDetails($con);
  $warehouseProduct=getWarehouseStockDetails($con);
  mysqli_close($con);
  $help="../../help/StockTake.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Stock Take - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Stocktake</a>
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
      <!-- Table -->
      <div class="row mb-3">
        <div class="col">
          <div class="card card-stats py-2 px-5" id="myTabContent" >
            <h3 class="text-center">Warehouse</h3>
            <div class="row pt-3 px-5" id="sourceW">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
               <div class="input-group input-group-rounded input-group-merge">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Product name" title="Type in a name" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fa fa-search"></span>
                  </div>
                </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="table-responsive">
              <label hidden="true" id="wData"><?php echo json_encode($warehouseData);?></label>
              <label hidden="true" id="wpData"><?php echo json_encode($warehouseProduct);?></label>
              <table id="myTable" class="table align-items-center table-flush">
                 <thead class="thead-light">
                  <tr class="header">	
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody id="tBody">
                  <tr id="emptySearch" style="display: none;" class="table-danger">
                    <td class="py-2"><b>Product Not Found</b></td>
                    <td class="py-2"></td>
                    <td class="py-2"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <div class="row mt-4">
                <button type="button" class="btn btn-primary px-5" data-toggle="modal" id="btnSave">Save</button>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
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
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="btnClose" onclick="">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script type="text/javascript" src="JS/stocktake.js"></script>
  <script type="text/javascript">
    var SESSION = eval('(<?php echo json_encode($_SESSION)?>)');
  </script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>