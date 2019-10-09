<?php include_once("../../sessionCheckLanding.php");?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title> Backup- Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Backup</a>
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
              <h3 class="mb-0">Backup Database</h3>
            </div>
            <div class="card-body ">

              
              <div class="row icon-examples d-flex justify-content-center">
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard"  data-toggle="modal" data-target="#suc">
                    <div>
                      <i class="fa fa-save"></i></i>
                      <span>Backup Database</span>
                    </div>
                  </button>
                    <div class="modal fade" id="suc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure you want to back up the database?</p>
                          </div>
                          <div class="modal-footer">
                            
                          <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#test2">Yes</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="test2" class="modal fade" role="dialog" >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <!-- Modal content-->
                      <div class="modal-content">  
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Backup In Progress!</h5>
                              </div>                                                    
                        <div class="modal-body">
                          <p>Please wait until backup complete</p>
                          <div class="progress" style="height:25px;">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%; height:25px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" id="btnSave">Continue</button>
                          </div>
                        </div>      
                      </div>
                    </div>
                  </div>

                  <div id="test2" class="modal fade" role="dialog" >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <!-- Modal content-->
                      <div class="modal-content">  
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Backup In Progress!</h5>
                              </div>                                                    
                        <div class="modal-body">
                          <p>Please wait till backup complete</p>
                          <div class="progress" style="height:25px;">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%; height:25px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="modal-footer">
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
                              
                              <div class="modal-body">
                                  <p>The database has been backed up successfully</p>
                                  
                              </div>
                              
                              <div class="modal-footer">
                                  
                                  <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../admin.html'">Close</button> 
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
  <script type="text/javascript" src="JS/backupDatabase.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>