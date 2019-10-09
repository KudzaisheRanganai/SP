<?php include_once("../sessionCheckPages.php");
  $help="../../help/CancelSaleDelivery.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Cancel Sale Delivery - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Cancel Sale Delivery</a>
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
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0"><span id="cDeliverySaleID"></span>   <b id="cDeliveryCustomerName"></b></h3>
            </div>
            <div class="card-body">
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form>
                      <div class="col">
                        <label hidden="true" id="delID"><?php echo $_POST["DELIVERY_ID"];?></label>
                        <label hidden="true" id="dctData"><?php echo $_POST["DCT_STATUS"];?></label>
                        <label hidden="true" id="sData"><?php echo $_POST["SALE_DATA"];?></label>
                        <label hidden="true" id="aData"><?php echo $_POST["ADDRESS_DATA"];?></label>
                        <label hidden="true" id="subData"><?php echo $_POST["SUBURB_DATA"];?></label>
                        <label hidden="true" id="citData"><?php echo $_POST["CITY_DATA"];?></label>
                        <label hidden="true" id="cData"><?php echo $_POST["CUSTOMER_DATA"];?></label>
                        <div class="form-group">
                            <p><b>Delivery Date: </b><?php echo $_POST["EXPECTED_DATE"];?></p>
                        </div>

                        <div class="form-group">
                          <p><span><b>Delivery Address: </b></span><span id="cDeliveryAddress"></span></p>
                        </div>
                        <div class="form-row pb-0">
                          <div class="form-group col-md-4 mb-2">
                            <p><span><b>Suburb: </b></span><span id="cDelSuburb"></span></p>
                          </div>
                          <div class="form-group col-md-4 mb-2">
                            <p><span><b>City: </b></span><span id="cDelCity"></span></p>
                          </div>
                          <div class="form-group col-md-2 mb-2">
                            <p><span><b>Zip: </b></span><span id="cDelZip"></span></p>
                          </div>
                        </div>
                        <div class="form-row mt-0">
                          <div class="form-group col-md-4">
                            <p><b>Delivered Date: </b> N/A</p>
                          </div>
                          <div class="form-group col-md-6">
                            <p><span><b>Delivery Status: </b></span> <span id="cDelStatus"></span></p>
                          </div>
                        </div>

                      </div> 
                      <div class="form-group col-md-3">
                          <button type="button" class="btn btn-block btn-danger mb-3 px-3" data-toggle="modal" data-target="#modal-default">Cancel Sale Delivery</button>
                          <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">
                                  
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-default">Warning!</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <p>Are you sure you want to cancel Sale Delivery?</p>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" id="btnYes">Yes</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> 
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
                        </div>
                    </form>
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
  <script type="text/javascript" src="JS/cancelDelivery.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>