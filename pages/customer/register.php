<?php include_once("../sessionCheckPages.php");
  $help="../../help/RegisterCustomer.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Register Customer - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- validation -->
  <link href="../../assets/jqueryui/jquery-ui.css" rel="stylesheet">
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Register Customer</a>
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
              <h3 class="mb-0">Customer is registering as:</h3>
            </div>
            <div class="card-body">
              <div class="row">

                <ul class="nav nav-pills ml-3" id="myTab" role="tablist">
                 
                  <li class="nav-item">
                    <a class="nav-link active" id="cIndividual" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                      <i class="far fa-user mr-2"></i>
                    Individual</a>
                  </li>
             
                  <li class="nav-item">
                    <a class="nav-link" id="cOrganisation" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-building mr-2"></i>
                    Organisation</a>
                  </li>
                </ul>
              </div>
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form method="POST" action="" id="mainfind">
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="name-indi">Name</label>
                          <input type="text" class="form-control" id="name-indi" name="name-indi" placeholder="Enter name" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="surname-indi">Surname</label>
                          <input type="text" class="form-control" id="surname-indi" name="surname-indi" placeholder="Surname" required>
                        </div>
                      </div>
                      <div class="form-row ">
                        <div class="form-group col-lg-2 col-md-4 col-sm-12">
                          <label for="title">Title</label>
                          <select class="form-control" id="titleSelect" name="title">
                            <option>Mr</option>
                            <option>Ms</option>
                            <option>Mrs</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-10 col-md-8 col-sm-12">
                          <label for="number-indi">Contact Number</label>
                          <input type="text" maxlength="10" class="form-control" id="number-indi" name="number-indi" placeholder="Contact Number" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email-indi">Email</label>
                        <input type="email" class="form-control" id="email-indi" name="email-indi" placeholder="Email" required>
                      </div>

                      <div class="form-group">
                        <label for="address1">Address line 1</label>
                        <input type="text" class="form-control indinputAddress" id="indinputAddress" placeholder="1234 Main St" name="address1" required>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="suburb">Suburb</label>
                          <input type="text" class="form-control indinputSuburb" id="indinputSuburb" name="suburb" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                          <label for="inputState">City</label>
                          <input type="text" class="form-control indinputCity" id="indinputCity" name="suburb" readonly>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12">
                          <label for="zip">Zip</label>
                          <input type="text" class="form-control indinputZip" id="indinputZip" name="zip" readonly>
                        </div>
                      </div>  
                    </form>
                    <div class="form-row">
                      <div class="form-group col">
                        <div class=" float-right">
                          <button class="btn btn-success " id="btn-add-address-ind" type="button">
                              <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add Address</span>
                          </button>
                          <br>
                          <small>Max 3 adresses allowed</small>
                        </div>
                      </div>
                    </div> 
                     <div class="row">
                     	<div class="col-md-2 mt-3 text-center">
                    <button id="btnSaveind" type="button" class="btn btn-block btn-primary mb-3">
                        Submit
                      </button>
                  </div>
                     </div>

                  </div>
					
                  <div class="tab-pane fade " id="profile"  aria-labelledby="profile-tab">
                    <form method="POST" action="" id="mainforg" novalidate>
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="email-org">Name of organisation</label>
                          <input type="text" class="form-control" id="name-org" name="name-org"  placeholder="Name" required>
    
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="password-indi">Business email</label>
                          <input type="email" class="form-control" id="email-org" name="password-indi" placeholder="Email" required>
                        </div>
                      </div>
                      <div class="form-row ">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="vat">VAT Number</label>
                          <input type="number" class="form-control" id="vat-org" name="vat" maxlength="10" placeholder="Vat number" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="number-org">Business Contact Number</label>
                          <input type="number" class="form-control" id="number-org" name="number-org" placeholder="Contact number" required>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="address1-org">Address line 1</label>
                        <input type="text" class="form-control orginputAddress" id="orginputAddress" name="address1-org" placeholder="1234 Main St" required>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="orginputSuburb">Suburb</label>
                          <input type="text" class="form-control orginputSuburb" id="orginputSuburb" name="suburb-org" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                          <label for="city-org">City</label>
                          <input type="text" class="form-control orginputCity" id="orginputCity" name="suburb-org" readonly="">
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12">
                          <label for="zip-org">Zip</label>
                          <input type="text" class="form-control orginputZip" id="orginputZip" name="zip-org" readonly="">
                        </div>
                      </div> 


                      
                    </form>
                    <div class="form-row">
                      <div class="form-group col">
                        <div class=" float-right">
                          <button class="btn btn-success " id="btn-add-address-org" type="button">
                              <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add Address</span>
                          </button>
                          <br>
                          <small>Max 3 adresses allowed</small>
                        </div>
                      </div>
                    </div> 
 
          					<div class="row">
          						<div class="col-md-2 mt-3 text-center">
                              <button id="btnSaveorg" type="button" class="btn btn-block btn-primary mb-3" >
                                  Submit
                              </button>
                          </div>
                      </div>
                  </div>
                    <div class="form-group col-md-2 errorModal successModal text-center">
                      <div class="modal fade" id="successfullyAdded" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">
                            <div class="modal-header" id="modalHeader">
                                <h6 class="modal-title" id="modal-title-default2">Success</h6>
                            </div>
                            <div class="modal-body">
                              <p id="modalText">Successfully Added</p>
                              
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

                    <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" data-backdrop="static" data-keyboard="false" tabindex="-1">
                      <div class="modal-dialog modal-sm">
                          <div class="modal-content px-auto" style="">
                              <img class="loading" src="../../assets/img/loading/loading.gif">
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
  <!-- validation scripts -->
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="../../assets/jqueryui/jquery-ui.js"></script>
  <script type="text/javascript" src="JS/registerCustomer.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>