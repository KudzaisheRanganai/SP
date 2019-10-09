<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Creative Tim">
  <title>Login - Stock Path</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <script src="./assets/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="./assets/css/bootstrap-multiselect.css" />
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
          <div class="card bg-darkGrey shadow-lg border-5">
            <div class="card-header bg-transparent pb-5">
              <div class="col">
                  <img class="img-fluid" src="./assets/img/brand/blue.png">
              </div>
            </div>

            <div class="card-body px-lg-5 py-lg-5">

              <div class="text-center text-muted mb-4">
                <div id="alert-login">
                </div>
                <small>Welcome</small>
                
              </div>
              
                <form method='post' action="">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email"  id="email" name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" type="password" id="password" name="password">
                    </div>
                  </div>

                  <div class="text-center">
                    <button  class="btn btn-customGreen my-4" id="login_button">Log in</button>
                  </div>
                </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 text-center">
               <a href="pages/user/reset-user-password-request.php" class="text-dark"><small>Forgot Password?</small></a>
            </div>
          </div>
        </div>
      </div>
    
  <!-- Footer -->
  <!--http://stockpath.co.za/-->
  <footer class="footer mt-7">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6">
        <div class="copyright text-center text-xl-left text-muted">
          &copy; 2019 <a class="font-weight-bold ml-1" target="_blank" href="pages/about_us/stock-path.html">Stock Path</a>
        </div>
      </div>
      <div class="col-xl-6">
        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
          <li class="nav-item">
            <a href="pages/about_us/aboout-us.html" class="nav-link" target="_blank">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
  </div>
  </div>
  <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" role="dialog" aria-hidden="true" data-backdrop="static" tabindex="-1">
      <div class="modal-dialog modal-sm">
          <div class="modal-content px-auto" style="">
              <img class="loading" src="assets/img/loading/loading.gif">
          </div>
      </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/login/JS/login.js"></script>
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>