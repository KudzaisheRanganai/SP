<?php include_once("../sessionCheckPages.php");
  $help="../../help/MaintainProduct.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Maintain Product - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Maintain Product</a>
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
              <h3 class="mb-0">Update Product details:</h3>
            </div>
            <div class="card-body">
             
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form id="maintainProductForm" class="needs-validation" novalidate>
                      <div class="form-group col">
                        <div class="form-row">
                          <label for="bane">Product Name</label>
                          <input type="text" class="form-control" id="productName" name="product-name" aria-describedby="emailHelp" value='<?php echo $_POST['NAME'] ?>' required>
                        </div>
                      </div>

                      <div class="form-group col">
                        <div class="form-row">
                          <label for="des">Description</label>
                           <textarea type = "text" maxlength="50" class="form-control mb-2" id="productDescription" name="product-description" rows="2" required><?php echo $_POST['PRODUCT_DESCR'] ?></textarea>
                         </div>
                      </div>

                      <div class="form-group col">
                        <div class="form-row">
                          <label for="bane">Product Type</label>
                          <select class="form-control mb-2" id="productType" name="product-type" required>
                            <option></option>
                          </select>
                        </div>
                      </div>
                       <div class="col">
                        <div class="form-row">
                         <div class="form-group col-lg-4">
                          <label for="bane">Number of Units in Case</label>
                          <input type="number" class="form-control" id="unitsInCase" name="units-in-case" aria-describedby="emailHelp" value='<?php echo $_POST['UNITS_PER_CASE'] ?>'  required>
                        </div>
                         <div class="form-group col-lg-4">
                          <label for="bane">Number of Cases in Pallet</label>
                          <input type="number" class="form-control" id="casesInPallet" name="cases-in-pallet" aria-describedby="emailHelp" value='<?php echo $_POST['CASES_PER_PALLET'] ?>' required>
                        </div>
                        <div class="form-group col-8 col-md-8 col-lg-3">
                          <label for="bane">Measurement</label>
                          <input type="number" class="form-control" id="productMeasurement" name="product-measurement" aria-describedby="emailHelp" value='<?php echo $_POST['PRODUCT_MEASUREMENT'] ?>' required>
                        </div>
                        <div class="form-group col-4 col-md-4 col-lg-1">
                          <label for="bane">Unit</label>
                          <select class="form-control mb-2" id="productMeasurementUnit" name="product-measurement-unit" required>
                              <option value="none"></option>
                              <option value="ml">ml</option>
                              <option value="L">L</option>
                              <option value="g">g</option>
                              <option value="kg">kg</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                         <div class="form-group col-lg-4">
                          <label for="bane">Individual Cost Price</label>
                          <div class="input-group "> 
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                            </div>
                            <input type="number" class="form-control" id="costPrice" name="cost-price" aria-describedby="emailHelp" value='<?php echo $_POST['COST_PRICE'] ?>' onchange="setTwoNumberDecimal(this)" step='0.01' required>
                          </div>
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="bane">Individual Guide Discount Price</label>
                          <div class="input-group"> 
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                            </div>
                            <input type="number" class="form-control" id="discountPrice" name="discount-price" aria-describedby="emailHelp" value='<?php echo $_POST['GUIDE_DISCOUNT'] ?>' onchange="setTwoNumberDecimal(this)" step='0.01' required>
                          </div>
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="bane">Individual Selling Price</label>
                          <div class="input-group"> 
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                            </div>
                            <input type="number" class="form-control" id="sellingPrice" name="selling-price" aria-describedby="emailHelp" value='<?php echo $_POST['SELLING_PRICE'] ?>' onchange="setTwoNumberDecimal(this)" step='0.01' required>
                          </div>
                        </div>
                       </div>
                       <button type="button" class="btn btn-primary mb-3 px-4" id="maintainProduct" name="maintain-product" >Save</button>
                      </div>

                      <div class="form-group col-md-2">
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
                    </form>
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
  <input type='' name='CASES_PER_PALLET' value='<?php echo $_POST['CASES_PER_PALLET'] ?>'>
  <input type='hidden' name='COST_PRICE' value='<?php echo $_POST["COST_PRICE"] ?>'>
  <input type='hidden' name='GUIDE_DISCOUNT' value='<?php echo $_POST["GUIDE_DISCOUNT"] ?>'>
  <input type='hidden' name='NAME' value='<?php echo $_POST["NAME"] ?>'>
  <input type='hidden' name='PRODUCT_GROUP_ID' value='<?php echo $_POST["PRODUCT_GROUP_ID"] ?>'>
  <input type='hidden' name='PRODUCT_MEASUREMENT' value='<?php echo $_POST["PRODUCT_MEASUREMENT"] ?>'>
  <input type='hidden' name='PRODUCT_MEASUREMENT_UNIT' value='<?php echo $_POST["PRODUCT_MEASUREMENT_UNIT"] ?>'>
  <input type='hidden' name='SELLING_PRICE' value='<?php echo $_POST["SELLING_PRICE"] ?>'>
  <input type='hidden' name='PRODUCT_TYPE_ID' value='<?php echo $_POST["PRODUCT_TYPE_ID"] ?>'>
  <input type='hidden' name='UNITS_PER_CASE' value='<?php echo $_POST["UNITS_PER_CASE"] ?>'>
  <input type='hidden' name='PRODUCT_DESCR' value='<?php echo $_POST["PRODUCT_DESCR"] ?>'>
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
  <!-- Maintain Product JS -->
  <script src="JS/maintainProduct.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>