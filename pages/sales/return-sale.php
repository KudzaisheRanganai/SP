<?php 
  include_once("../sessionCheckPages.php"); 
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  $saleProducts=getSaleProductDetails($con,$_POST["SALE_ID"]);
  $products=getProductDetails($con);
  $isDelivered=checkDelivery($con,$_POST["SALE_ID"]);
  mysqli_close($con);
  $help="../../help/ReturnSale.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Return Sale - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Return Sale</a>
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
              <h3 class="mb-0">Sale Return Details</h3>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <input type="hidden" id="SALE_ID" value='<?php echo $_POST["SALE_ID"];?>'>
                    <input type="hidden" id="SALE_DATE" value='<?php echo $_POST["SALE_DATE"];?>'>
                    <input type="hidden" id="CUSTOMER_ID" value='<?php echo $_POST["CUSTOMER_ID"];?>'>
                    <input type="hidden" id="CUSTOMER_DATA" value='<?php echo $_POST["CUSTOMER_DATA"];?>'>
                    <input type="hidden" id="EMPLOYEE_DATA" value='<?php echo $_POST["EMPLOYEE_DATA"];?>'>
                    <input type="hidden" id="PRODUCTS_ARRAY" value='<?php echo $_POST["PRODUCTS_ARRAY"];?>'>
                    <input type="hidden" id="SALE_PRODUCTS_ARRAY" value='<?php echo $_POST["SALE_PRODUCTS_ARRAY"];?>'>
                    <div class="card-body px-3" style="height: 15.5rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                          <tr>
                            <th style="width: 12rem">
                                Customer ID
                            </th>
                            <td >
                                <?php echo $_POST["CUSTOMER_ID"];?>
                            </td>
                          </tr>                               
                          <tr>
                            <th>
                                Name
                            </th>
                            <td id="customerName">
                            </td>
                          </tr> 
                          <tr>
                            <th>
                                Surname
                            </th>
                            <td id="customerSurname">
                            </td>
                          </tr>
                          <tr>
                            <th>
                                Contact No
                            </th>
                            <td id="customerContact">
                            </td>
                          </tr>              
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 15.5rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">                                  
                          <tr>
                            <th>
                              Invoice #
                            </th>
                            <td id="invoiceNo">
                              <?php echo $_POST["SALE_ID"]?>
                            </td>
                          </tr> 
                          <tr>
                            <th style="width: 12rem">
                              Order Date 
                            </th>
                            <td >
                              <?php 
                                $source = $_POST["SALE_DATE"];;
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
                              Salesperson
                            </th>
                            <td id="eSalesPerson">
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
                      <th class="pl-4 text-right"> Unit Price</th>
                      <th class="text-right"> Total </th>
                      <th class="text-center">Return Quantity </th>
                    </tr>
                  </thead>
                  <tbody id="tBody">

                  </tbody>
                  <tfoot class="tfoot-light">
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>TOTAL</b></th>
                      <td class="text-right"><b id="sTotal"><?php echo $_POST["SALE_AMOUNT"] ?></b></td>
                    </tr>
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>VAT (15%)</b></th>
                      <td class="text-right"><b id="sVAT"></b></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
            <br>
              <div class="col mt-4">
                <button id="finaliseReturn" class="btn btn-icon btn-2 btn-danger mt-0" type="button" data-toggle="modal">
                  <span class="btn-inner--text">Finalise Return</span>
                </button>
              </div>
              <div class="modal fade" id="modal-returnSale" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Return</h6>
                    </div>
                    <div class="modal-body">
                      <div class="col text-left">
                        <p>Are you sure you want to return the indicated products from the sale?</p>   
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
                        <button type="button" class="btn btn-link" id="modalCloseButton" ml-auto" data-dismiss="modal">Close</button> 
                      </div>
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
                    <div class="modal-body text-left">
                      <p>Return successful. Printing credit note...</p>   
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../sales.html'">Close</button> 
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
  <script type="text/javascript" src="JS/returnSale.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>