<?php include_once("../../sessionCheckLanding.php");
  $help="../../help/MaintainCheck-inCheckoutTime.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Change Checkin/Checkout Time - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Change Checkin/Checkout Time</a>
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
              <h3 class="mb-0">New Checkin/Checkout Time:</h3>
            </div>
            <div class="card-body">
             
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form>
                    <div class="row">

                    <div class=" col-sm-12 col-lg-6 col-md-6">
                        <label for="bane">Checkin Time:</label>
                        <input type="time" class="form-control" id="checkin" value="" min="00:00" max="12:00" aria-describedby="emailHelp" placeholder="Enter Position Name">
                      </div>
                      
                      <div class=" col-sm-12 col-lg-6 col-md-6">
                        <label for="bane">Checkout Time:</label>
                        <input type="time" class="form-control" id="checkout" value= "" min="12:00" max="22:00" aria-describedby="emailHelp" placeholder="Enter Position Name">
                        <input type="hidden" class="form-control" id="user_id" value=<?php echo $_SESSION["userID"]?>>
                      </div>
                    </div>
                      

                       

                     <!--  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Save</button> -->
                    <div class="row">
                    <div class=" pt-3 col-md-4 col-sm-12">
                          <input type="hidden" class="btn btn-block btn-primary mb-3" id="" value="" />
                      </div>
                      <div class=" pt-3 col-md-4 col-sm-12">
                          <button type="button" class="btn btn-block btn-primary mb-3" id="saveChangedTime">Save</button>
                      </div>
                      <div class=" pt-3 col-md-4 col-sm-12">
                          <input type="hidden" class="btn btn-block btn-primary mb-3" id="" value="" />
                      </div>
                    </div>

                          <div class="modal fade errorModal successModal text-center" id="changeTimeSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">
                                  
                                    <div class="modal-header" id="modalHeader">
                                        <h6 class="modal-title" id="modal-title-default"></h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <p id="modalText">Employee type added successfully</p>

                                        <div id="animation" style="text-align:center;">

                                        </div>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-link  ml-auto" id="btnClose" data-dismiss="modal" onclick="">Close</button> 
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
  <script src="JS/changeTimes-JS.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>