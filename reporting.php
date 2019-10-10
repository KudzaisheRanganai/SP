<?php include_once("sessionCheckLanding.php");
  $help="help/Reporting.html";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Reporting - Stock Path</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<body>
  <?php include_once("header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Reporting</a>
        <?php include_once("usernavbar.php");?>
        
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
              <h3 class="mb-0">Reporting Functions</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">

                <?php 
                  if (in_array("12.1", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generateDateSale">
                    <a>
                      <div>
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Sales Report</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("12.2", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generateStock">
                    <a>
                      <div>
                        <i class="far fa-clipboard"></i>
                        <span>Stock Report</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("12.3", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generate">
                    <a>
                      <div>
                        <i class="fas fa-user-clock"></i>
                        <span>Wages Report</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("12.4", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generateDateProduct">
                    <a>
                      <div>
                        <i class="fas fa-chart-line"></i>
                        <span>Product Trends Report</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("12.5", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generateDebtors">
                  <a>
                    <div>
                      <i class="fas fa-chart-line"></i>
                      <span>Debtors Report</span>
                    </div>
                  </a>
                </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("12.6", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generateCreditors">
                    <a>
                      <div>
                        <i class="fas fa-briefcase"></i>
                        <span>Creditors Report</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("12.7", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#generateAttendance">
                    <a>
                      <div>
                        <i class="fas fa-users"></i>
                        <span>Employee Attendance Roll</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="modal fade" id="generateAttendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Enter Date!</h5>
            </div>
            <div class="modal-body">
                <form action="pages/reports/employeeAttendance.php" method="POST" id="SubAttForm" target="_blank">
                <div class="form-group col">
                  <label for="exampleInputPassword1">Please enter date:</label>
                  <input type="date" class="form-control" id="DATE" name="DATE" placeholder="Enter Delivery From">
                
                </div>
                <div class="form-group col">
                  <input type="button" id ="SubAttButt"  value="Generate Report" class="btn btn-success" ></input>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                
              </form>
            </div>
            <div class="modal-footer"> 
           
              
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="generateDebtors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to generate the selected report?</p>

            </div>
            <div class="modal-footer">  
              <a href="pages/reports/debtors.php" class="btn btn-success" target="_blank">Yes</a>  
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
      <!-- attedance report modal -->

      <div class="modal fade" id="generateStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to generate the selected report?</p>

            </div>
            <div class="modal-footer">  
              <a href="pages/reports/stock-report.php" class="btn btn-success" target="_blank">Yes</a>  
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
                  <p>Report generated successfully</p>    
              </div> 
              <div class="modal-footer">
                   <a href="pages/reports/stock-report.php"class="btn btn-link  ml-auto" >Close</a>                     
                  
              </div>            
            </div>
        </div>
      </div>


      <div class="modal fade" id="generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to generate the selected report?</p>
                <form action="pages/reports/wage-slips.php" method="POST" target="_blank">
                  <div class="form-row ">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <input type="hidden" class="form-control" id="USERNAME" name="USERNAME" value=<?php echo $_SESSION["name"]?> placeholder="Enter Date of Sale From">
                    </div>
                  </div>
                  <input type="submit" class="btn btn-success" value="Yes"></input>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>

            </div>
            <div class="modal-footer">  
             
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
                  <p>Report generated successfully</p>    
              </div> 
              <div class="modal-footer">
                   <a href="pages/reports/wage-slips.php"class="btn btn-link  ml-auto" >Close</a>                     
                  
              </div>            
            </div>
        </div>
      </div>



      
      <div class="modal fade" id="generateCreditors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to generate the selected report?</p>

            </div>
            <div class="modal-footer">  
              <a href="pages/reports/creditors-report.php" class="btn btn-success" target="_blank">Yes</a> 
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
                  <p>Report generated successfully</p>    
              </div> 
              <div class="modal-footer">
                   <a href="pages/reports/creditors-report.php"class="btn btn-link  ml-auto" target="_blank">Close</a>                     
                  
              </div>            
            </div>
        </div>
      </div>
            <div class="modal fade" id="generateDateSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pick Sale Period!</h5>
            </div>
            <div class="modal-body">
              <p>Please Select a period on which the sales report should be generated!</p>
                <form action="pages/reports/sale.php" method="POST" target="_blank">
                <div class="form-row ">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label for="bane">Sales Reports Period</label>
                    <select class="form-control" name="salePeriod" placeholder="Weekly" required>
                      <!--option value= "Daily">Daily</option-->
                      <option value= "Weekly">Weekly</option>
                      <option value= "Monthly">Monthly</option>
                    </select>
                  </div>
                </div>
                <input type="submit" class="btn btn-success" value="Generate Report"></input>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>
          </div>
        </div>
      </div>
      </div>



        <div class="modal fade" id="generateDateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Enter Timeframe!</h5>
            </div>
           <div class="modal-body" id="SubmitReport">
            
               
            </div>


            <!--div class="modal-footer">  
              <a href="pages/reports/product-trends-report.php"class="btn btn-success" >Generate Report</a>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div-->
          </div>
        </div>
      </div>


      <div class="col-md-2 errorModal successModal text-center">
                            <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" id="displayModal">
                              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                  <div class="modal-content">
                                    
                                      <div class="modal-header" id="modalHeader">

                                          <h6 class="modal-title" id="modal-title-default2" ></h6>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      
                                      <div class="modal-body">
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
                          </div>
                        </div>









      <div class="modal fade" id="generateDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Enter Timeframe!</h5>
            </div>
            <div class="modal-body">
              <p>Please enter the timeframe for which the report should be generated?</p>
              <div class="form-row ">
                <div class="form-group col-6">
                  <label for="exampleInputPassword1">Date From</label>
                  <input type="date" class="form-control" id="dateFrom" placeholder="Enter Delivery From">
                </div>
                <div class="form-group col-6">
                  <label for="exampleInputPassword1">Date To</label>
                  <input type="date" class="form-control" id="dateTo" placeholder="Enter Delivery To">
                </div>
              </div>
            </div>
            <div class="modal-footer">  
              <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-success">Generate Report</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Success!</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div> 
              <div class="modal-body">
                  <p>Report generated successfully</p>    
              </div> 
              <div class="modal-footer">                        
                  <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button> 
              </div>            
            </div>
        </div>
      </div>
      <?php include_once("footer.php");?>
    </div>
  </div>
</div>



  <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-sm">
          <div class="modal-content px-auto" style="">
              <img class="loading" src="./assets/img/loading/loading.gif">
          </div>
      </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="pages/reports/JS/reportingErrors.js"></script>
  <script src="InactivityLogoutLanding/autologout.js"></script>

</body>

</html>