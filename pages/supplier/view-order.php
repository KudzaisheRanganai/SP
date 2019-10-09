<?php 
  include_once("../sessionCheckPages.php");
  include_once("PHPcode/functions.php");
  $help="../../help/PlaceSupplierOrder.html";
?>
<?php

  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    //Send error response
    $response = "databaseError";
    echo $response;
  }
  else
  {
    $orderID = $_POST['ORDER_ID'];
    $sql_query = "SELECT A.ORDER_ID,A.ORDER_PAID, A.SUPPLIER_ID, B.NAME AS SUPPLIER_NAME, B.CONTACT_NUMBER AS SUPPLIER_PHONE, B.EMAIL AS SUPPLIER_EMAIL, B.VAT_NUMBER AS SUPPLIER_VAT_NUMBER, A.ORDER_DATE, A.DATE_RECEIVED, C.STATUS_NAME AS ORDER_STATUS, C.ORDER_STATUS_ID, D.NAME AS EMPLOYEE_NAME, D.SURNAME AS EMPLOYEE_SURNAME
      FROM ORDER_ A
      JOIN SUPPLIER B ON A.SUPPLIER_ID = B.SUPPLIER_ID
      JOIN ORDER_STATUS C ON A.ORDER_STATUS_ID = C.ORDER_STATUS_ID
      JOIN EMPLOYEE D ON A.EMPLOYEE_ID = D.EMPLOYEE_ID
      WHERE A.ORDER_ID = '$orderID'";

    $result = mysqli_query($DBConnect,$sql_query);
    $orderDetails = $result->fetch_assoc();

    $isCollected=checkCollection($DBConnect,$orderID);

    $orderDateString = strtotime($orderDetails["ORDER_DATE"]);
    $orderDate = date('d/m/Y',$orderDateString);

    mysqli_close($DBConnect);
  }
?>
<script type="text/javascript">
  var ORDER_ID = eval('(<?php echo json_encode($orderDetails["ORDER_ID"])?>)');
  var SUPPLER_NAME = eval('(<?php echo json_encode($orderDetails["SUPPLIER_NAME"])?>)');
  var SUPPLIER_EMAIL = eval('(<?php echo json_encode($orderDetails["SUPPLIER_EMAIL"])?>)');
  var ORDER_DATE = eval('(<?php echo json_encode($orderDate)?>)');

  var ORDER_PAID = eval('(<?php echo json_encode($orderDetails["ORDER_PAID"])?>)');
  var ORDER_STATUS_ID = eval('(<?php echo json_encode($orderDetails["ORDER_STATUS_ID"])?>)');
</script>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Order - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Order</a>
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
              <div class="row">

                <div class="mb-5 col">
                  <ol class="progtrckr" data-progtrckr-steps="2">
                    <li id="1" class="progtrckr-todo">Order Sent</li>
                  <li id="2" class="progtrckr-todo">Order Received</li>
                   
                  </ol>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3">
                      <label hidden="true" id="oDetails"><?php echo json_encode($orderDetails)?></label>
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Supplier ID
                              </th>
                              <td id="supplierID">
                                <?php echo $orderDetails["SUPPLIER_ID"]; ?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Name
                              </th>
                              <td id="supplierName">
                                  <?php echo $orderDetails["SUPPLIER_NAME"]; ?>
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                  VAT Number
                              </th>
                              <td id="supplierPhone">
                                  <?php echo $orderDetails["SUPPLIER_VAT_NUMBER"]; ?>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Contact No
                              </th>
                              <td id="supplierPhone">
                                  <?php echo $orderDetails["SUPPLIER_PHONE"]; ?>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Email
                              </th>
                              <td id="supplierEmail">
                                  <?php echo $orderDetails["SUPPLIER_EMAIL"]; ?>
                              </td>
                            </tr>                 
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 17.3rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">
                          <tr>
                            <th>
                              Order #
                            </th>
                            <td >
                              <?php echo $orderDetails["ORDER_ID"]; ?>
                            </td>
                          </tr>    
                          <tr>
                            <th style="width: 12rem">
                              Order Date 
                            </th>
                            <td >
                              <?php 
                                $source = $orderDetails["ORDER_DATE"];
                                $date = new DateTime($source);
                                echo $date->format("Y/m/d"); 
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
                              <?php echo $orderDetails["EMPLOYEE_NAME"]; ?>
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
                        <td class="text-right"><b id="sTotal"></b></td>
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
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

              <div class="col mt-4">
                <button class="btn btn-icon btn-2 btn-primary mt-0" type="button" onclick="window.history.go(-1); return false;">
                  <span class="btn-inner--text">Close</span>
                </button> 
                <button class="btn btn-icon btn-2 btn-danger mt-0 float-right mr-2" type="button" data-toggle="modal" data-target="#del">
                  <span class="btn-inner--icon"><i class="fas fa-times-circle"></i></span>
                  <span class="btn-inner--text" >Cancel Order</span>
                </button>
                <form action="../stock/return-order.php" class="d-inline" method="POST" >
                  <input type="hidden" id="orderDetails" name="ORDER_DETAILS" value='<?php echo json_encode($orderDetails)?>'>
                  <input type="hidden" name="ORDER_PRODUCTS" id="oProducts">
                   <input type="hidden" name="ORDER_RETURNS" id="oReturns">
                  <input type="hidden" name="ORDER_ID" value='<?php echo $orderDetails["ORDER_ID"]; ?>'>
                  <button class="btn btn-icon btn-2 btn-warning mt-0 float-right mr-2" type="submit" id="btnReturn">
                    <span class="btn-inner--icon"><i class="fas fa-undo"></i></span>
                    <span class="btn-inner--text">Make Return</span>
                  </button>
                </form>
                <form action="../stock/receive-order.php" method="POST" class="d-inline">
                <input type="hidden" name="ordDetails" id="oDet">
                <input type="hidden" name="ordProducts" id="oProd">
                <button id="btnReceiveStock" class="btn btn-icon btn-2 btn-success mt-0 float-right mr-2" type="submit">
                  <span class="btn-inner--icon"><i class="fas fa-layer-group"></i></span>
                  <span class="btn-inner--text" >Receive Order</span>
                </button>
                </form>
                <label hidden="true" id="collectionCheck"><?php echo $isCollected;?></label>
                <form action="../delivery_collection/add_collection.php" class="d-inline" method="POST">
                <input type="hidden" name="orderID" id="acOrdID">
                <input type="hidden" name="ordDetails" id="acOrderDetails"> 
                <button class="btn btn-icon btn-2 btn-default mt-0 float-right mr-2" type="submit" data-toggle="modal" id="btnAddCollection">
                  <span class="btn-inner--icon">
                    <i class="fas fa-truck"></i>
                  </span>
                  <span class="btn-inner--text" >Add Collection</span>
                </button>
              </form>
              <button class="btn btn-icon btn-2 btn-success mt-0 float-right mr-2" type="button" id="makePaymentButton" data-toggle="modal" data-target="#modal-payment">
                  <span><i class="fas fa-money-bill-wave-alt"></i></span>
                  <span class="btn-inner--text">Make Payment</span>
              </button>
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
            <div class="form-group errorModal successModal text-center">
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
          
          </div>
          </div>
        </div>
        <?php include_once("../footer.php");?>
      </div>
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
              
            <button type="button" class="btn btn-success" data-dismiss="modal" id="confirmDeleteCustomer">Yes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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
    <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" tabindex="-1" role="dialog" aria-hidden="true">
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
  <script src="JS/viewOrder.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>