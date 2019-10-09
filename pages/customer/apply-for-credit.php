<?php include_once("../sessionCheckPages.php");
  $help="../../help/ApplyForCredit.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Apply For Credit - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- Validation  -->
  <link href="../../assets/jqueryui/jquery-ui.css" rel="stylesheet">
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Apply For Credit</a>
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
              <h3 class="mb-0">Credit Account Application Details:</h3>
            </div>
            <div class="card-body">
   
            
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                    <form id="uploadForm">
                      <div class="form-row mb-4 col">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <label for="exampleInputPassword1">Copy of Bank Statement</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="file-1" id="bankStatement" onchange="PreviewBS();" required>
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>
                          <div class="card shadow" style="clear:both">
                             <iframe id="BSViewer" frameborder="0" scrolling="no" style="height: 230px; width: 100%;"></iframe>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <label for="exampleInputPassword1">Copy of ID</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="file-2" id="idCopy" onchange="PreviewID();" required>
                              <label class="custom-file-label btn-primary" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>
                          <div class="card shadow" style="clear:both">
                             <iframe id="IDViewer" frameborder="0" scrolling="no" style="height: 230px; width: 100%;"></iframe>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <label for="exampleInputPassword1">Proof Of Residence</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="file-3" id="proofOfResidence" onchange="PreviewRS();" required>
                              <label class="custom-file-label btn-primary" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>
                          <div class="card shadow" style="clear:both">
                             <iframe id="RSViewer" frameborder="0" scrolling="no" style="height: 230px; width: 100%;"></iframe>
                          </div>
                        </div>
                      </div>
                      <div class="form-row col"></div>
                        <div class="col-4 mb-4">
                          <label for="c2">Credit Limit</label>
                          <div class="input-group"> 
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                            </div>
                            <input type="number" id="customerID" name="customerID" value="<?=$_GET["ID"]?>" hidden />
                            <input type="number" value="1000" min="0"  data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" name="credit-limit" id="creditLimit" required />
                          </div> 
                        </div>
                        <div class="form-row col">
                          <button type="submit" class="btn  btn-primary mb-3" id="submitForm">Submit</button>
                        </div>
                      </form>
                  
                      <div class="form-group col-md-2">

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

                      </div>
                    </div>

                    <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" data-backdrop="static" data-keyboard="false" tabindex="-1">
                      <div class="modal-dialog modal-sm">
                          <div class="modal-content px-auto" style="">
                              <img class="loading" src="../../assets/img/loading/loading.gif">
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
  <!-- Validation JS -->
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <!-- Apply For Credit JS -->
  <script src="JS/apply-for-credit.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>