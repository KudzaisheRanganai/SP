<?php include_once("../sessionCheckPages.php");
  $help="../../help/MaintainCustomer.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Maintain Customer - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- Validation scripts -->
  <link href="../../assets/jqueryui/jquery-ui.css" rel="stylesheet">
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <!-- end validation -->
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Maintain Customer</a>
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
              <h3 class="mb-0">Update Customer details:</h3>
            </div>
            <div class="card-body">
   
            
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                    <form id="mainf">
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6  col-sm-12">
                          <label for="exampleInputEmail1">Name</label>
                          <label id="cName" hidden><?php echo $_POST["NAME"];?></label>
                          <input type="hidden" id="cID" value=<?php echo $_POST["ID"];?>>
                          <input type="text" class="form-control" id="customerName" name="customerName"aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="exampleInputPassword1" id="cSurnameLabel"></label>
                          <label hidden="true" id="cTypeID"><?php echo $_POST["CUSTOMER_TYPE_ID"];?></label>
                          <label hidden="true" id="cVat"><?php echo $_POST["VAT"];?></label>
                          <label hidden="true" id="cSur"><?php echo $_POST["SURNAME"];?></label>
                          <input type="text" class="form-control" id="cSurname" placeholder="Smith"  name="cSurname" required>
                        </div>
                      </div>
                      <div class="form-row ">
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                          <label for="bane">Title</label>
                          <label hidden="true" id="eTitle"><?php echo $_POST["TITLE_NAME"];?></label>
                          <select class="form-control" id="titleSelect">
                            <option>Mr</option>
                            <option>Ms</option>
                            <option>Mrs</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-12">
                          <label for="exampleInputPassword1">Contact Number</label>
                          <input type="number" class="form-control" id="ContactNo" name = "ContactNo" required value=<?php echo $_POST["CONTACT_NUMBER"];?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" id="customerEmail" name="customerEmail"required value=<?php echo $_POST["EMAIL"];?>>
                      </div>

                      <div class="form-group">
                        <label for="inputAddress">Address line 1</label>
                        <label id="convertAdd" hidden="true"><?php echo $_POST["ADDR"];?></label>
                        <div class="input-group">
                                <input type="text" class="form-control inputAddress" id="inputAddress1" name="cusAddr" placeholder="1234 Main St" required/>
                                  <span class="input-group-btn">
                                    <button class="btn btn-danger btn-add-address" type="button" disabled>
                                        <span class="btn-inner--icon"><i class="ni ni-fat-delete"></i></span>
                                    </button>
                                  </span>
                                </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="city">Suburb</label>
                          <label id="convertSuburb" hidden="true"><?php echo $_POST["SUBURB"]?></label>
                          <input type="text" class="form-control inputSuburb" id="inputSuburb1" name="inputSuburb1"required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState">City</label>
                          <label id="convertCity" hidden="true"><?php echo $_POST["CITY"];?></label>
                          <input type="text" class="form-control inputCity" name="inputCity1" id="inputCity1" readonly>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputZip">Zip</label>
                          <input type="text" class="form-control inputZip" name="inputZip1" id="inputZip1" readonly>
                        </div>
                      </div> 

                    </form>
                      <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSave">
                        Submit
                      </button>
                      <div class="col-md-2 float-right">
                                    <button class="btn btn-success " id="btn-add-address" type="button">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add Additional Address</span>
                                    </button>
                                    <small>Max 3 Adresses allowed</small>
                      </div>
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">
                            
                              <div class="modal-header">
                                  <h6 class="modal-title" id="modal-title-default">Warning!</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              
                              <div class="modal-body">
                                  <p id="MRemove"></p>
                                  
                              </div>
                              
                              <div class="modal-footer">                                 
                                  <button type="button" class="btn btn-success" data-dismiss="modal" id="btnRemove">Yes</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> 
                              </div>
                              
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
  <!-- Validation scripts -->
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="../../assets/jqueryui/jquery-ui.js"></script>
  <!-- validation end -->
  <script type="text/javascript" src="JS/maintainCustomer.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>