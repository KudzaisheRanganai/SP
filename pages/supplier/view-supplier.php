<?php include_once("../sessionCheckPages.php");?>
<?php
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  $supID=$_POST["ID"];
  $account=getSupplierAccountID($con,$supID);
  $addressIDs=getSupplierAddressIDs($con,$supID);
  $addressInfo=[];
  $suburbInfo=[];
  $cityInfo=[];
  for ($i=0;$i<count($addressIDs);$i++)
  { 
    $addressInfo[$i]=getAddressInfo($con,$addressIDs[$i]["ADDRESS_ID"]);
  }
  for ($i=0;$i<count($addressIDs);$i++)
  { 
    $suburbInfo[$i]=getSuburbInfo($con,$addressInfo[$i]["SUBURB_ID"]);
  }
  for ($i=0;$i<count($addressIDs);$i++)
  { 
    $cityInfo[$i]=getCityInfo($con,$suburbInfo[$i]["CITY_ID"]);
  }
  mysqli_close($con);


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Supplier Profile - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Supplier Profile</a>
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
    <div class="container-fluid mt--7 ">
      <!-- Table -->
      <div class="row">
        <div class="col d-flex justify-content-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col ">
                <div class="card-profile-image">
                  <a>
                    <img src="../../images/user.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>

            <div class="card-body pt-0 pt-md-4 mt-6">
              <div class="text-center mt-0">
                <h2 id="supName">
                  <?php echo $_POST["NAME"];?>
                </h2>
                <hr class="h5 font-weight-300 pb-0 mt-3">
                  <div class="pt-2"><b>Supplier ID : </b><p class="d-inline"><?php echo $_POST["ID"];?></p></div>
                  <div class="pt-2"><b>VAT Number : </b><p class="d-inline"><?php echo $_POST["VAT"];?></p></div>            
                  <div class="pt-2"><b>Email : </b><p class="d-inline"><?php echo $_POST["EMAIL"];?></p></div>
                  <div class="pt-3"><b>Contact Number : </b><p class="d-inline"><?php echo $_POST["PHONE"];?></p></div>
                  <label id="addresses" hidden="true"><?php echo json_encode($addressInfo);?></label>
                  <label id="suburbs" hidden="true"><?php echo json_encode($suburbInfo);?></label>
                  <label id="cities" hidden="true"><?php echo json_encode($cityInfo);?></label>
                </hr>
                <hr class="h5 font-weight-300 pb-0 mt-3 pt-0">
                  <div class="px-auto">
                    <ul class="nav nav-pills px-auto" id="listAddress" role="tablist" style="width: auto;">
                    </ul>
                  </div>
                  <div class="tab-content" id="pills-tabContent"></div>
                </hr>
                <hr class="my-1 mt-3 d-flex justify-content-center pt-1">
                  <div class="row mb-2">
                    <div class="col d-inline mx-0 px-0">
                      <label hidden="true" id="sID"><?php echo $supID;?></label>
                      <form id="formMaintain" action="maintain-supplier.php" method="POST" class="d-inline">
                        <input type="hidden" name="ID" value=<?php echo $supID;?>>
                        <input type="hidden" name="NAME" id="NAME">
                        <input type="hidden" name="VAT" value=<?php echo $_POST["VAT"];?>>
                        <input type="hidden" name="PHONE" value=<?php echo $_POST["PHONE"];?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $_POST["EMAIL"];?>>
                        <input type="hidden" name="ADDR" id="ADDR">
                        <input type="hidden" name="SUBURB" id="SUBURB">
                        <input type="hidden" name="CITY" id="CITY">
                        <!-- <input type="hidden" name="ZIP" value=<?php echo json_encode($suburbInfo);?>> -->
                        <button class="btn btn-icon btn-2 btn-primary btn-sm px-5" type="submit">
                          <span class="btn-inner--icon"><i class="fas fa-wrench"></i>
                          </span>
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </form>
                    </div>
                    <div class="col d-inline mx-0 px-0">
                      <button class="btn btn-icon btn-2 btn-danger btn-sm px-3" type="button" data-toggle="modal" data-target="#del">
                        <span class="btn-inner--icon"><i class="fas fa-trash"></i>
                        </span>
                        <span class="btn-inner--text">Delete Supplier</span>
                      </button>
                    </div>
                    <div class="col d-inline mx-0 px-0">
                      <form id="formViewAccount" action="view-credit-account.php">
                        <input type="hidden" name="ID" value=<?php echo $supID;?>>
                        <input type="hidden" name="NAME" id="accName"value=<?php echo $_POST["NAME"];?>>
                        <input type="hidden" name="EMAIL" id="accEmail" value=<?php echo $_POST["EMAIL"];?>>
                        <input type="hidden" name="PHONE" id="accContact" value=<?php echo $_POST["PHONE"];?>>
                        <input type="hidden" name="account" id="accCheck" value=<?php echo $account;?>>
                        <button class="btn btn-icon btn-2 btn-default btn-sm px-3" id="btnViewAccount" type="submit>
                          <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                          </span>
                          <span class="btn-inner--text">View Supplier Account</span>
                        </button>
                      </form>
                    </div>       
                  </div>
                </hr>
                <hr class="my-2 d-flex justify-content-center">
                  <div class="d-flex justify-content-center">
                     <button type="button" class="btn btn-link mx-auto" data-dismiss="modal"  onclick="window.history.go(-1); return false;">Close</button>
                  </div>
                </hr>
              </div>
            </div>
          </div>
        <?php include_once("../footer.php");?>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </div>

  <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
        </div>
        <div class="modal-body text-left">
          <p>Are you sure you want to delete the selected supplier?</p>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" id="btnDelete">Yes</button>
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

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script type="text/javascript" src="JS/viewSupplier.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>