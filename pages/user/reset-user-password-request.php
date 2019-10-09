<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Reset Password Request - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  
  
  <script src="../../assets/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="../../assets/css/bootstrap-multiselect.css" />
</head>

<body class="bg-customGrey">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">

            </div>
          </div>
          
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-customGreen py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">

          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-customGray" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--9 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 mt-0">
          <div class="card bg-darkGrey shadow-lg border-4">
            <div class="card-header bg-transparent pb-5">
              <div class="col">
                
                  <img class="img-fluid" src="../../assets/img/brand/blue.png">
               
              </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
              <div id="alert-sendEmail"></div>
                <small>Please enter your email address</small>
              </div>
              <form role="form" id="sendEmail">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email" id="email" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-customGreen mt-4 mb-3" >Send Link
                  </button>
                </div>
                <div class="modal fade errorModal successModal text-center" id="successfullyChanged" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header" id="modalHeader">
                                          <h6 class="modal-title" id="modal-title-default">Success!</h6>
                                          
                                      </div>      
                                      <div class="modal-body text-left">
                                          <p id="modalText"></p>
                                            <div id="animation" style="text-align:center;">

                                            </div>                             
                                      </div>
                                      <div class="modal-footer">  
                                          <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"id="closeModal" onclick="">Close</button> 
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

                 
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 text-center">
              <a href="../../index.php" class="text-dark"><small>Login</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->

  <?php include_once("../footer.php");?>
  <!-- Argon Scripts -->
  <!-- Core -->
  <!-- Argon Scripts -->
  <!-- Core -->

  <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-sm">
          <div class="modal-content px-auto" style="">
              <img class="loading" src="../../assets/img/loading/loading.gif">
          </div>
      </div>
  </div>
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script src="JS/sendmail.js"></script>
</body>

</html>