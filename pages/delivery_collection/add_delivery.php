<?php
include_once("../sessionCheckPages.php");
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  // $customerAddress=getCustomerAddressIDs($con,$_POST["CUSTOMER_ID"]);
  $addressData=getCompleteCustomerAddresses($con,$_POST["CUSTOMER_ID"]);
  // $suburbData=getAllSuburbs($con);
  // $cityData=getAllCity($con);
  mysqli_close($con);
  $help="../../help/AddSaleDelivery.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Add Sale Delivery - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- Calander -->
  <link href='../../assets/fullcalender/packages/core/main.css' rel='stylesheet' />
  <link href='../../assets/fullcalender/packages/daygrid/main.css' rel='stylesheet' />
  <link href='../../assets/fullcalender/packages/bootstrap/main.css' rel='stylesheet' />
</head>

<body>
 <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Add Sale Delivery</a>
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
              <h3 class="mb-0"><span id="saleID">Sale No. #321 :</span><span><b id="CustomerName">John Smith</b></span></h3>
            </div>
            <div class="card-body">

              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form>
                      <div class="col">
                        <div class="form-row ">
                          <div class="form-group col">
                            <label id="addData" hidden="true"><?php echo json_encode($addressData);?></label>
                            <!-- <label id="subData" hidden="true"><?php echo json_encode($suburbData);?></label>
                            <label id="citData" hidden="true"><?php echo json_encode($cityData);?></label> -->
                           <!--  <label id="cAddress" hidden="true"><?php echo json_encode($customerAddress);?></label> -->
                            <label id="cData" hidden="true"><?php echo $_POST["CUSTOMER_DATA"];?></label>
                            <label id="sID" hidden="true"><?php echo $_POST["SALE_ID"];?></label>
                            <label id="sDate" hidden="true"><?php echo $_POST["SALE_DATE"];?></label>
                            <label for="exampleInputPassword1">Delivery Date</label>
                            <input type="date" class="form-control" id="delDate">
                          </div>
                        </div>

                        <div class="form-group">
                          <!-- <label for="inputAddress">Address line 1</label>
                          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Blue Lagoon Street" value="IT Building Room 5-69"> -->
                          <label for="inputAddress">Select Address</label>
                          <select class="form-control" id="inputAddress">
                          </select>
                        </div>
                        </div>

                      </div>
                      <form id="delView" method="POST" action="assign-truck-view-delivery.php">
                        <input type="hidden" name="SALE_ID" id="delID">
                        <input type="hidden" name="DEL_INFO" id="delInfo">
                        <input type="hidden" name="choice" value="2">
                        </form>
                      <button type="button" class="btn btn-info float-right d-inline" data-toggle="modal" data-target="#exampleModal">
                      <i class="far fa-calendar-alt"></i>
                      Show Calander
                      </button>
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-info">
                              <h5 class="modal-title" id="exampleModalLabel">Calander</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div id="calender"></div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-2">
                          <button type="button" class="btn btn-block btn-primary mb-3" id="btnSave">Save</button>
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
  <script type="text/javascript" src="JS/addDelivery.js"></script>

  <script src='../../assets/fullcalender/packages/core/main.js'></script>
  <script src='../../assets/fullcalender/packages/daygrid/main.js'></script>
  <script src='../../assets/fullcalender/packages/timegrid/main.js'></script>
  <script src='../../assets/fullcalender/packages/list/main.js'></script>
  <script src='../../assets/fullcalender/packages/bootstrap/main.js'></script>
  <script type="text/javascript" src="JS/calendarForAdd.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>