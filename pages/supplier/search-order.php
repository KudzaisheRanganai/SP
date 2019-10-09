<?php include_once("../sessionCheckPages.php");
  $help="../../help/SearchOrder.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Search Order - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Search Order</a>
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
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
               <div class="input-group input-group-rounded input-group-merge">
                 
                 <input type="text" id="myInput" onkeyup="filterOrders()" placeholder="Enter Order Number" title="Type in a name" class="form-control form-control-rounded form-control-prepended" aria-label="Search">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-search"></span>
                    </div>
                  </div>
                  <!-- Button trigger modal -->
            </div>
          </div>
          <div class="table-responsive">

            <table id="myTable" class="table align-items-center table-flush">
               <thead class="thead-light">
                <tr class="header">
                  <th>Order #</th>
                  <th>Date & Time</th>
                  <th>Supplier Name</th>
                  <th>Status</th>
                  <th style="width:1rem;"></th>
                </tr>
              </thead>
              <tbody id="tBody">
                <tr id="emptySearch" style="display: none;" class="table-danger mb-3">
                  <td><b>No Supplier Order Found</b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <div class="form-group col-md-2 mt-3">
              <button type="button" class="btn btn-primary mb-3 px-4" data-toggle="modal" data-target="#modal-default" onclick="window.history.go(-1); return false;">Back</button>
            </div>

            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to cancel the selected order?</p>
                    </div>
                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-succ">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modal-succ" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    
                      <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-default">Success!</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      
                      <div class="modal-body">
                          <p>Order successfully cancelled. The supplier has been sent an email. </p>
                          <p>Printing cancellation slip...</p>
                          
                      </div>
                      
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-link  ml-auto" onclick="window.location='../../supplier.php'">Close</button> 
                      </div>
                      
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
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <!-- Moment JS -->
  <script src="../../assets/js/moment.js"></script>
  <!-- Search Order JS -->
  <script type="text/javascript" src="JS/searchSupplierOrder.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>