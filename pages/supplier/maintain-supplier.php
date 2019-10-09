<?php include_once("../sessionCheckPages.php");
  $help="../../help/MaintainSupplier.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Maintain Supplier - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Maintain Supplier</a>
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
              <h3 class="mb-0">Updated Supplier Details:</h3>
            </div>
            <div class="card-body">

              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form id="mainf">
                      <div class="col">
                        <div class="form-row">
                          <div class="form-group col-6">
                            <label for="exampleInputEmail1">Name</label>
                            <label id="suppName" hidden="true"><?php echo $_POST["NAME"];?></label>
                            <input type="hidden" id="sID" value=<?php echo $_POST["ID"];?>>
                            <input type="text" class="form-control" name="sName" id="supplierName" aria-describedby="emailHelp" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="VATNumber">VAT Number</label>
                            <input type="number" class="form-control" name="VAT" id="VATNumber" value=<?php echo $_POST["VAT"];?> required>
                          </div>
                        </div>
                        <div class="form-row ">
                          <div class="form-group col-6">
                            <label for="ContactNo">Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="ContactNo" maxlength="10" value=<?php echo $_POST["PHONE"];?> required>
                          </div>
                          <div class="form-group col-6">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="text" class="form-control" name="email" id="supplierEmail" value=<?php echo $_POST["EMAIL"];?> required>
                          </div>
                        </div>
                        <hr class="my-4">
                        <div class="form-row">
                            <div class="form-group col">
                               <label for="inputAddress">Address 1</label>
                               <label id="convertAdd" hidden="true"><?php echo $_POST["ADDR"];?></label>
                              <div class="input-group">
                                <input type="text" class="form-control inputAddress" id="inputAddress1" name="suppAddr" placeholder="1234 Main St" required/>
                                  <span class="input-group-btn">
                                    <button class="btn btn-danger btn-add-address" type="button" disabled>
                                        <span class="btn-inner--icon"><i class="ni ni-fat-delete"></i></span>
                                    </button>
                                  </span>
                                </div>
                            </div>
                          </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputSuburb">Suburb</label>
                              <label id="convertSuburb" hidden="true"><?php echo $_POST["SUBURB"]?></label>
                              <input type="text" class="form-control inputSuburb" id="inputSuburb1" name="suppSuburb">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputCity">City</label>
                              <label id="convertCity" hidden="true"><?php echo $_POST["CITY"];?></label>
                              <input type="text" class="form-control inputCity" id="inputCity1" name="suppSuburb" readonly>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputZip">Zip</label>
                              <input type="text" class="form-control inputZip" id="inputZip1" name="suppZip" readonly>
                            </div>
                          </div>
                      </div>


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
                    <div class="modal fade" id="success2" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">
                            
                              <div class="modal-header">
                                  <h6 class="modal-title" id="modal-title-default">Success!</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              
                              <div class="modal-body">
                                  <p>Supplier successfully deleted</p>
                                  
                              </div>
                              
                              <div class="modal-footer">
                                  
                                  <button type="button" class="btn btn-link  ml-auto" onclick="window.location='../../supplier.html'">Close</button> 
                              </div>
                              
                          </div>
                      </div>
                    </div>
                        
                    </form>
                    <div class="form-row">
                      <div class="form-group col">
                        <div class=" float-right">
                          <button class="btn btn-success " id="btn-add-address" type="button">
                              <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add Address</span>
                          </button>
                          <br>
                          <small>Max 3 adresses allowed</small>
                        </div>
                      </div>
                    </div> 
                      <br>
                      <div class="col">
                        <div class="form-group">
                          <div class="form-group mr-2">
                              <button type="button" class="btn btn-primary mb-3" id="btnSave">Save Changes
                              </button>
                              <!-- <button type="button" class="btn btn-danger mb-3 float-right" id="btnDeleteSupplier">Delete Supplier
                              </button> -->
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
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="../../assets/jqueryui/jquery-ui.js"></script>
  <script src="JS/maintainSupplier.js" type="text/javascript"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>