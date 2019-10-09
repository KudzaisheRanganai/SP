<?php include_once("../sessionCheckPages.php");

  //$orderID = $_POST['ORDER_ID'];
  $orderDetails = json_decode($_POST['ORDER_DETAILS']);
  $orderProducts = json_decode($_POST['ORDER_PRODUCTS']);
  $orderReturns = json_decode($_POST['ORDER_RETURNS']);
  $help="../../help/ReturnStock.html";
?>
<script type="text/javascript">
  var ORDER_ID = eval('(<?php echo json_encode($orderDetails->ORDER_ID)?>)');
  var ORDER_STATUS_ID = eval('(<?php echo json_encode($orderDetails->ORDER_STATUS_ID)?>)');
</script>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Return Order - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Return Stock</a>
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
      <div class="row mb-3">
          <div class="card shadow col">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <h3 class="mb-0">Order Details</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 17.5rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Supplier ID
                              </th>
                              <td id="supplierID">
                                <?php echo $orderDetails->SUPPLIER_ID; ?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Name
                              </th>
                              <td id="supplierName">
                                  <?php echo $orderDetails->SUPPLIER_NAME; ?>
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                  VAT Number
                              </th>
                              <td id="supplierPhone">
                                  <?php echo $orderDetails->SUPPLIER_VAT_NUMBER; ?>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Contact No
                              </th>
                              <td id="supplierPhone">
                                  <?php echo $orderDetails->SUPPLIER_PHONE; ?>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Email
                              </th>
                              <td id="supplierEmail">
                                  <?php echo $orderDetails->SUPPLIER_EMAIL; ?>
                              </td>
                            </tr>                 
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 17.5rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">
                          <tr>
                            <th>
                              Order #
                            </th>
                            <td >
                              <?php echo $orderDetails->ORDER_ID; ?>
                            </td>
                          </tr>    
                          <tr>
                            <th style="width: 12rem">
                              Order Date 
                            </th>
                            <td >
                              <?php 
                                $source = $orderDetails->ORDER_DATE;
                                $date = new DateTime($source);
                                echo $date->format("d/m/Y"); 
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <th style="width: 12rem">
                              Order Time 
                            </th>
                            <td >
                              <?php 
                                echo $date->format("h:i a"); 
                              ?>
                            </td>
                          </tr> 
                          <tr>
                            <th>
                              Ordered By
                            </th>
                            <td >
                              <?php echo $orderDetails->EMPLOYEE_NAME; ?>
                            </td>
                          </tr>      
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card shadow">
                <div class="table-responsive">

                  <table id="myTable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="header">
                        <th> Quantity</th>
                      <th> Item Name</th>
                      <th class="text-center">Return Quantity </th>
                      </tr>
                    </thead>
                    <tbody id="tBody">             
                    
                    </tbody>
                    
                  </table>
                </div>
              </div>
            </div>
            <br>
              <div class="col mt-4">
                <button id="finaliseReturn" class="btn btn-icon btn-2 btn-danger mt-0" type="button">
                  <span class="btn-inner--text">Finalise Return</span>
                </button>
              </div>
              <div class="modal fade" id="modal-returnOrder" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Return</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="col text-left">
                        <p>Are you sure you want to return the indicated products from the order?</p>   
                      </div>
                      <div class="form-group col">
                        <label for="bane">Reason for return</label>
                        <input type="text" class="form-control" id="reasonForReturn" aria-describedby="emailHelp" placeholder="Enter reason for return">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-salesManagerPassword">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> 
                    </div>   
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-salesManagerPassword" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Finalise Sale</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group col">
                        <label for="bane">Sales Manager Password</label>
                        <input type="password" class="form-control" id="salesManagerPassword" aria-describedby="emailHelp" placeholder="Enter password" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success  ml-auto" data-dismiss="modal" id="confirmSalesManagerPassword">Approve Sale</button> 
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group col-md-2 errorModal successModal text-center">
                <div class="modal fade" id="successfullyAdded" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                      <div class="modal-content">
                          <div class="modal-header" id="modalHeader">
                            <h6 class="modal-title" id="modal-title-default2"></h6>
                          </div>
                          <div class="modal-body">
                              <p id="modalText"></p>
                              <div id="animation" style="text-align:center;">
                              </div>
                          </div>
                          <div class="modal-footer">
                              
                              <button type="button" class="btn btn-link" id="modalCloseButton" ml-auto" data-dismiss="modal" >Close</button> 
                          </div>
                          
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    <div class="modal-header" id="modalHeader">
                      <h6 class="modal-title" id="modal-title-default">Error!</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body text-left">
                      <p id="MMessage"></p>
                      <div id="animation" style="text-align:center;">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="btnClose">Close</button> 
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
                        <p>Order successfully item(s) returned. Sending return email to supplier... </p>
                      </div>
                      <div class="modal-footer"> 
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"  onclick="window.location='../../stock.html'">Close</button> 
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
    <label hidden="true" id="oDetails"><?php echo json_encode($orderDetails)?></label>
    <label hidden="true" id="oProducts"><?php echo json_encode($orderProducts)?></label>
    <label hidden="true" id="oReturns"><?php echo json_encode($orderReturns)?></label>

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
  <!-- View Order JS -->
  <script src="JS/returnOrder.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>