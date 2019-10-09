<?php include_once("sessionCheckLanding.php");

$userID;
if(isset($_SESSION['userID']))
{
  $userID = $_SESSION["userID"];
}
$help="help/AdministrationSubsystem.html";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Admin - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Administration</a>
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
              <h3 class="mb-0">Administration Functions</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <?php 
                  if (in_array("4.1", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/admin/add-employee-type.php">
                      <div>
                        <i class="far fa-plus-square"></i>
                        <span>Add Employee Type</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("4.2", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/admin/search-employee-type.php">
                      <div>
                        <i class="far fa-edit"></i>
                        <span>Maintain Employee Type</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("4.3", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/admin/search-employee-type.php">
                      <div>
                        <i class="fas fa-search"></i>
                        <span>Search Employee Type</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("4.4", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/admin/view-audit-log.php">
                      <div>
                        <i class="far fa-eye"></i>
                        <span>View Audit Log</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("4.7", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/admin/delete-user.php">
                      <div>
                        <i class="fas fa-user-times"></i>
                        <span>Delete User</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("4.9", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  href="#">
                    <a href="pages/admin/view-audit-log.php">
                      <div>
                        <i class="fas fa-user-times"></i>
                        <span>Export Audit Log</span>
                      </div>
                    </a>
                  </button>
                </div>
                <?php
                  }
                ?>

                <?php 
                  if (in_array("4.101", $subFunctionality)) {
                ?>
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard">
                    <a href="pages/admin/maintain-inactivity-logout-time.php">
                      <div>
                      <i class="far fa-clock"></i>
                        <span>Maintain Inactivity Logout Timer</span>
                      </div>
                    </a>
                  </button>
                </div>

                <div class="modal fade" id="over" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                      </div>
                      <div class="modal-body">
                        <p>Number of days to be used for overdue delivery status?</p>
                      </div>
                      <div class="modal-body text-left">
                        <div class="col mb-4">
                          <label for="c2">Number of Days</label>
                          <div class="input-group"> 
                            <input type="text" value=""  class="form-control" placeholder="7" id="numOfDays" autofocus />
                            <input type="hidden"  class="form-control " id="USER_ID" value=<?php echo $userID;?> />
                          </div> 
                        </div>
                      </div>
  
                      <div class="modal-footer">
                        
                      <button type="button" class="btn btn-success" data-dismiss="modal" id="overButton">Confirm</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="overdueStatusSet" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-defaultOverdue">Success!</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <p id="modalTextOverdue"></p>
                            
                        </div>
                        
                        <div class="modal-footer">
                            
                            <button type="button"  id="btnCloseOverdue" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="">Close</button> 
                        </div>
                        
                    </div>
                </div>
              </div>


                <?php
                  }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once("footer.php");?>
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
  <script src="pages/admin/JS/overDue-JS.js"></script>
  <script src="InactivityLogoutLanding/autologout.js"></script>
</body>

</html>