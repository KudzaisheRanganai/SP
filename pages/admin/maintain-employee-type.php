<?php include_once("../../sessionCheckLanding.php");
  $help="../../help/MaintainEmployeeType.html";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Maintain Employee Type - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Maintain Employee Type</a>
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
              <h3 class="mb-0">Maintain Employee Type details:</h3>
            </div>
            <div class="card-body">
             
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form>
                      <div class="form-group col">
                        <label for="bane">Position Name</label>
                        <input type="email" class="form-control" id="posName" aria-describedby="emailHelp" placeholder="Administrator" value=<?php echo $_POST["NAME"];?>>
                        <input type="hidden" class="form-control" id="EMPLOYEE_TYPE_ID" value=<?php echo $_POST["EMPLOYEE_TYPE_ID"];?>>
                        <input type="hidden" class="form-control" id="WAGE_EARNING" value=<?php echo $_POST["WAGE_EARNING"];?>>
                      </div>

                      <div class="form-row col">
                        <div class="form-group col-6">
                          <label for="bane">User Access Level</label>
                          <select class="form-control" id="aLevel">
                            <option value=<?php echo $_POST["ROLE_NAME"];?> selected><?php echo $_POST["ROLE_NAME"];?></option>
                          </select>
                        </div>

                        <div class="form-group col-6" style="text-align:center; align-items:center; justify-content:center;">
                          <label for="bane">Wage Earning?</label>
                          <br>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                                 <span class="custom-toggle-slider rounded-circle" > </span>
                          </label>
                        </div>    
                      </div>
                     
                     <!--  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Save</button> -->

                      <div class="col mt-2">
                        <button type="button" class="btn btn-primary mb-3" id="maintainEmployeeTypeSave">Save
                        </button>
                    
                    </form>
                    <div class="modal fade errorModal successModal text-center" id="changeTimeSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">
                                  
                                    <div class="modal-header" id="modalHeader">
                                        <h6 class="modal-title" id="modal-title-default"></h6>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <p id="modalText"></p>

                                        <div id="animation" style="text-align:center;">

                                        </div>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-link  ml-auto" id="btnClose" data-dismiss="modal" onclick="">Close</button> 
                                    </div>
                                    
                                </div>
                            </div>
                          </div>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
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
  <script src="JS/maintainEmployeeType-JS.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>