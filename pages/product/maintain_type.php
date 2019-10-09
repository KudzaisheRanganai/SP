<?php include_once("../sessionCheckPages.php");
  $help="../../help/MaintainProductType.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Maintain Product Type - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- Validation Stylesheet -->
  <link rel="stylesheet" href="../../assets/css/site-demos.css">
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Maintain Product Type</a>
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
              <h3 class="mb-0">Update Product Type details:</h3>
            </div>
            <div class="card-body">
             
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form  id="maintainProductTypeForm" class="needs-validation" novalidate>
                      <div class="form-group col">
                        <div class="form-row">
                          <label for="productTypeName">Product Type Name</label>
                          <input type="text" class="form-control" name="product-type-name" id="productTypeName" aria-describedby="emailHelp" value='<?php echo $_POST['TYPE_NAME'] ?>' required>
                        </div>
                      </div>

                      <div class="form-group col">
                        <div class="form-row">
                          <label for="productTypeDescription">Type Description</label>
                           <textarea class="form-control mb-1" name="product-type-descrption" id="productTypeDescription" rows="2" required><?php echo $_POST['DESCRIPTION'] ?></textarea>
                         </div>
                      </div>

                      <div class="form-group col">
                        <div class="form-row">
                          <button type="button" id="maintainProductType" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                    </form>
                    <input type='hidden' name='prev-TYPE_NAME' id="previousTypeName" value='<?php echo $_POST['TYPE_NAME'] ?>'>
                    <input type='hidden' name='prev-DESCRIPTION' id="previousDescription" value='<?php echo $_POST['DESCRIPTION'] ?>'>
                    <input type='hidden' name='PRODUCT_TYPE_ID' id="ProductTypeID" value='<?php echo $_POST['PRODUCT_TYPE_ID'] ?>'>

                    <div class="modal fade" id="successfullyAdded" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                              <h6 class="modal-title" id="modal-title-default">Success!</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <p id="modalText">Successfully Saved</p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" id="modalCloseButton" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../product.php'">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="modal-del" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">
                            
                              <div class="modal-header">
                                  <h6 class="modal-title" id="modal-title-default">Warning!</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              
                              <div class="modal-body">
                                  <p>Are you sure you want to delete the product type? </p>
                                  
                              </div>
                              
                              <div class="modal-footer">                                 
                                  <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#displayModal">Yes</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> 
                              </div>
                              
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
  <script src="../../assets/js/jquery.validate.min.js"></script>
  <script src="../../assets/js/additional-methods.min.js"></script>
  <!-- Add Product Type JS -->
  <script src="JS/maintainProductType.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>