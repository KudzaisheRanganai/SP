<?php
  include_once("../sessionCheckPages.php");
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  $saleProducts=getSaleProductDetails($con,$_POST["SALE_ID"]);
  $products=getProductDetails($con);
  $isDelivered=checkDelivery($con,$_POST["SALE_ID"]);
  mysqli_close($con);
  $help="../../help/ViewSale.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Sale - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Sale</a>
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
              <h3 class="mb-0">Sale Details</h3>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 15.5rem">
                      <label hidden="true" id="cData"><?php echo $_POST["CUSTOMER_DATA"];?></label>
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Customer ID
                              </th>
                              <td id="customerID">
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
                      <label hidden="true" id="eData"><?php echo $_POST["EMPLOYEE_DATA"];?></label>
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                Sale Date
                              </th>
                              <td id="saleDate">
                                <?php 
                                  $source = $_POST["SALE_DATE"];
                                  $date = new DateTime($source);
                                  echo $date->format("Y/m/d"); 
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <th style="width: 12rem">
                                Sale Time 
                              </th>
                              <td >
                                <?php 
                                  echo $date->format("h:i a"); 
                                ?>
                              </td>
                            </tr>                                
                            <tr>
                              <th>
                                Invoice #
                              </th>

                              <td id="invoiceNo">
                                <?php echo $_POST["SALE_ID"]?>
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
                  <label hidden="true" id="productsArr"><?php echo json_encode($products);?></label>
                  <label hidden="true" id="saleproductsArr"><?php echo json_encode($saleProducts);?></label>
                  <table id="myTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th class="text-center"> Quantity</th>
                      <th> Item Name</th>
                      <th class="pl-4 text-right"> Unit Price</th>
                      <th class="text-right"> Total </th>
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
            <div class="col-12">
              <h2 class="ml-4 my-3">Returns</h3>
            </div>
            
            <div class="col-12">
              <div class="card shadow">
                <div class="table-responsive">

                  <table id="myTable" class="table align-items-center table-flush">
                  <tbody id="tBodyReturns">
                    <tr>
                      
                     
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>

              <div class="col mt-4">
                <button class="btn btn-icon btn-2 btn-primary mt-0" type="button" onclick="window.history.go(-1); return false;">
                  <span class="btn-inner--text">Close</span>
                </button>

                <button class="btn btn-icon btn-2 btn-success mt-0 float-right" type="button" id="makePaymentButton" data-toggle="modal" data-target="#modal-payment">
                  <span><i class="fas fa-money-bill-wave-alt"></i></span>
                  <span class="btn-inner--text">Make Payment</span>
                </button>

                <form action="../delivery_collection/add_delivery.php" class="d-inline" method="POST" class="ml-2">
                  <input type="hidden" name="SALE_ID" value='<?php echo $_POST["SALE_ID"];?>'>
                  <input type="hidden" name="SALE_DATE" value='<?php echo $_POST["SALE_DATE"];?>'>
                  <input type="hidden" name="CUSTOMER_ID" id="CUSTOMER_ID" value='<?php echo $_POST["CUSTOMER_ID"];?>'>
                  <input type="hidden" name="CUSTOMER_DATA" value='<?php echo $_POST["CUSTOMER_DATA"];?>'>
                  <label hidden="true" id="deliveryCheck"><?php echo $isDelivered;?></label>

                  <button class="btn btn-icon btn-2 btn-warning mt-0 float-right mr-2" 
                    type="submit" id="btnAddDelivery">
                    <span class="btn-inner--icon">
                      <i class="fas fa-truck"></i>
                    </span>
                    <span class="btn-inner--text">Add Delivery</span>
                  </button>
                </form>

                

                  <button class="btn btn-icon btn-2 btn-danger mt-0 float-right mr-2" type="button" data-toggle="modal" data-target="#modal-makeReturn" id="btnMakeReturn">
                    <span class="btn-inner--icon"><i class="fas fa-undo"></i></span>
                    <span class="btn-inner--text">Make Return</span>
                  </button>
                </form>

                <input type="hidden" id="SALE_STATUS_ID" value="<?php echo $_POST['SALE_STATUS_ID'];?>">
                <input type="hidden" id="SALE_ID" value="<?php echo $_POST["SALE_ID"];?>">
                <button class="btn btn-icon btn-2 btn-default mt-0 float-right mr-2" id="collectSaleButton" type="button" data-toggle="modal" data-target="#modal-updateSale">
                  <span class="btn-inner--icon"><i class="fas fa-people-carry"></i>
                  <span class="btn-inner--text">Collect Sale</span>
                </button>

              </div>
             </div>
            </div>
          </div>
        </div>
              <div class="modal fade" id="modal-updateSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Update Sale Status of sale <b>#<?php echo $_POST["SALE_ID"];?></b> to collected?</p>
                    </div>
                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="updateSaleStatus">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modal-successSale" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    
                      <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-default">Success!</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      
                      <div class="modal-body">
                          <p>Sale #321 status updated to collected</p>
                          
                      </div>
                      
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../sales.php'">Close</button> 
                      </div>
                      
                  </div>
              </div>
            </div>
              <div class="modal fade" id="modal-addDelivery" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group col">
                        <label for="bane">Are you sure you want to add a delivery to the sale?</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-accountSuccess" onclick="window.location='../delivery_collection/add_delivery.php'">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>   
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-makeReturn" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group col">
                        <label for="bane">Are you sure you want to make a return?</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <form action="return-sale.php" class="d-inline" method="POST">
                        <input type="hidden" name="SALE_ID" value='<?php echo $_POST["SALE_ID"];?>'>
                        <input type="hidden" name="SALE_DATE" value='<?php echo $_POST["SALE_DATE"];?>'>
                        <input type="hidden" name="SALE_AMOUNT" value='<?php echo $_POST["SALE_AMOUNT"];?>'>
                        <input type="hidden" name="CUSTOMER_ID" value='<?php echo $_POST["CUSTOMER_ID"];?>'>
                        <input type="hidden" name="CUSTOMER_DATA" value='<?php echo $_POST["CUSTOMER_DATA"];?>'>
                        <input type="hidden" name="EMPLOYEE_DATA" value='<?php echo $_POST["EMPLOYEE_DATA"];?>'>
                        <input hidden="true" name="PRODUCTS_ARRAY" value='<?php echo json_encode($products);?>'>
                        <input type="hidden" name="SALE_PRODUCTS_ARRAY" value='<?php echo json_encode($saleProducts);?>'>
                        <button type="submit" class="btn btn-success">Yes</button>
                      </form>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>   
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Payment Type!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>  
                    <div class="modal-body text-centre">
                      <p class="px-auto text-center">Select the payment type</p>   
                      <div class="col px-auto text-center">
                        <button class="btn btn-icon btn-2 btn-primary mt-0 mx-auto col-5" type="button" data-dismiss="modal" data-toggle="modal" data-target="#modal-creditlimit">
                          <span><i class="fas fa-money-bill-alt"></i></span>
                          <span class="btn-inner--text">Cash</span>
                        </button>
                        <br>
                        <button class="btn btn-icon btn-2 btn-info mt-3 px-4 mx-auto col-5" type="button" id="accountPaymentButton" data-dismiss="modal" data-toggle="modal" data-target="#modal-account">
                          <span><i class="fas fa-file-invoice"></i></span>
                          <span class="btn-inner--text">Account</span>
                        </button>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button> 
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
                      <div class="mb-4 px-2">
                        <table class="table table-sm">
                          <tr>
                            <td class="table-light" id="">Amount Received</td>
                            <td class="text-right" id="saleAmountReceived">R100.00</td>
                          </tr>
                          <tr>
                            <td class="table-light">Total Outstanding</td>
                            <td class="text-right" id="saleTotalOutstanding">R70.00</td>
                          </tr>
                          <tfoot>
                            <td class="table-success">Change</td>
                            <td class="text-right table-success" id="saleChange">R30.00</td>
                          </tfoot>
                        </table>
                      </div>
                      <p class="ml-2">Sale payment successful.</p>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../sales.php'">Close</button> 
                    </div>    
                  </div>
                </div>
              </div>

              <div class="modal fade" id="modal-creditlimit" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Make Payment</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body text-left">
                      <div class="col mb-4">
                        <label for="c2">Enter Amount Received</label>
                        <div class="input-group"> 
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                          </div>
                          <input type="number" id="amountReceived" value="" min="0" step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" autofocus />
                        </div> 
                      </div>
                    </div>
                    <div class="modal-footer">
                          
                      <button type="button" class="btn btn-success  ml-auto" data-dismiss="modal" id="calculateChangeButton" data-toggle="modal">Calculate Change</button> 
                    </div>   
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-account" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group col">
                        <label for="bane">Are you sure you want to add the sale to the customer account?</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal" id="makeAccountPaymentButton">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>   
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-accountSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Success!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>  
                    <div class="modal-body text-left">
                      <div class="form-group col">
                        <p>Sale successfully added to customer account. Printing payment invoice...</p>
                      </div>   
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../sales.php'">Close</button> 
                    </div>    
                  </div>
                </div>
              </div>
              <div class="form-group col-md-2">
          <div class="modal fade" id="successfullyAdded" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default2"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="modalText"></p>
                        
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-link" id="modalCloseButton" ml-auto" data-dismiss="modal" onclick="callTwo()">Close</button> 
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
                                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="btnClose">Close</button>
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
  <script type="text/javascript" src="JS/viewSale.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>