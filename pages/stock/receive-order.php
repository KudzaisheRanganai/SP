<?php 
  include_once("PHPcode/connection.php");
  include_once("../sessionCheckPages.php");
  $orderDetails=json_decode($_POST["ordDetails"]);
  $help="../../help/ReceiveStock.html";
  mysqli_close($con);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Recieve Order - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Receive Stock</a>
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
                    <div class="card-body px-3"  style="height: 15rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Supplier ID
                              </th>
                              <td >
                                  <?php echo $orderDetails->SUPPLIER_ID;?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Name
                              </th>
                              <td >
                                  <?php echo $orderDetails->SUPPLIER_NAME;?>
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                  Contact No
                              </th>
                              <td >
                                  <?php echo $orderDetails->SUPPLIER_PHONE;?>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Email
                              </th>
                              <td >
                                  <?php echo $orderDetails->SUPPLIER_EMAIL;?>
                              </td>
                            </tr>                 
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
                <div class="col-6 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 15rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                Date 
                              </th>
                              <td >
                                <?php 
                                $source = $orderDetails->ORDER_DATE;
                                $date=new DateTime($source);
                                echo $date->format("Y/m/d h:i a");
                                ?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                Order #
                              </th>
                              <td >
                                <?php echo $orderDetails->ORDER_ID;?>
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                Sales Manager
                              </th>
                              <td >
                                <?php echo $orderDetails->EMPLOYEE_NAME;?>
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
                  <label hidden="true" id="oDet"><?php echo $_POST["ordDetails"];?></label>
                  <label hidden="true" id="oProd"><?php echo $_POST["ordProducts"];?></label>
                  <table id="myTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th class="text-center"> Quantity</th>
                      <th> Item Name</th>
                      <th>Qty Recieved</th>
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
                <button class="btn btn-icon btn-2 btn-success mt-0 " type="button" data-toggle="modal" id="btnSave">
                  <span class="btn-inner--text">Submit</span>
                </button>
                <!-- <button class="btn btn-icon btn-2 btn-danger mt-0 float-right" type="button" data-toggle="modal" data-target="#force">
                  <span><i class="fas fa-exclamation-triangle"></i></span>
                  <span class="btn-inner--text">Force Receival</span>
                </button> -->
              </div>
              <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to recieve the selected order?</p>
                    </div>
                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-succ">Yes</button>
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
                <div class="modal fade" id="force" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to force the receival of the order?</p>
                      </div>
                      <div class="modal-footer">
                        
                      <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-forceSuccess">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-forceSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Success!</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                          <p>Order receival forced successfully</p>   
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link  ml-auto" onclick="window.location='../../stock.html'">Close</button> 
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
  <script type="text/javascript" src="JS/receiveStock.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>