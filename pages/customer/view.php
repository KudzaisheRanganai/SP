
<?php
  include_once("PHPcode/connection.php");
  include_once("PHPcode/functions.php");
  $help="../../help/ViewCustomerProfile.html";
  $cusID=$_POST["ID"];
  $titleName="";
  if($_POST["CUSTOMER_TYPE_ID"]==1)
  {
    $titleInfo=getTitleInfo($con,$_POST["TITLE_ID"]);
    $titleName=$titleInfo["TITLE_NAME"];
  }
  $addressIDs=getCustomerAddressIDs($con,$cusID);
  if(checkCreditAccount($con,$cusID))
  {
    $creditAccountCheck="True";
  }
  else
  {
    $creditAccountCheck="False";
  }
  $customerTypeName=getCustomerTypeName($con,$_POST["CUSTOMER_TYPE_ID"]);
  $customerStatus=getCustomerStatus($con,$_POST["STATUS_ID"]);
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
<?php include_once("../sessionCheckPages.php");?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Customer Profile - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Customer</a>
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

            <div class="card-body pt-0 pt-md-4 mt-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-2 mb-0">
                  </div>
                </div>
              </div>
              <div class="text-center mt-0">
                <h2>
                  <?php
                    if($_POST["SURNAME"]=="null")
                    {
                      echo $_POST["NAME"]." Organisation";
                    }
                    else
                    {
                      echo $_POST["NAME"]." ".$_POST["SURNAME"];
                    }
                    ?>
                </h2>
                <label hidden="true" id="cName"><?php echo $_POST["NAME"];?></label>
                <hr class="h5 font-weight-300 pb-0 mt-3 pt-1">
                  
                  <div class="pt-2"><b>Email : </b><p class="d-inline"><?php echo $_POST["EMAIL"];?></p></div>
                  
                  <div class="pt-3"><b>Contact Number : </b><p class="d-inline"><?php echo $_POST["CONTACT_NUMBER"];?></p></div>
                  <div class="pt-3"><b>Customer Type : </b><p class="d-inline"><?php echo $customerTypeName[0]["CUSTOMER_TYPE_NAME"];?></p></div>
                  <div class="pt-3"><b>Customer Status : </b><p class="d-inline"><?php echo $customerStatus[0]["STATUS_NAME"];?></p></div>
                  <label id="addresses" hidden="true"><?php echo json_encode($addressInfo);?></label>
                  <label id="suburbs" hidden="true"><?php echo json_encode($suburbInfo);?></label>
                  <label id="cities" hidden="true"><?php echo json_encode($cityInfo);?></label>
                </hr>
                <hr class="h5 font-weight-300 pb-0 mt-3 pt-0">
                  <ul class="nav nav-pills" id="listAddress" role="tablist">
                    <!-- <li class="nav-item">
                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Address1</a>
                    </li> -->
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                  </div>
                </div> 
                <hr class="my-1 mt-3 d-flex justify-content-center pt-1">
                  <div class="row mb-2 text-center">
                    <div class="col d-inline mx-0 px-0">
                      <form id="formMaintain" action="maintain.php" method="POST" class="d-inline">
                        <input type="hidden" name="ID" value=<?php echo $cusID;?>>
                        <input type="hidden" name="NAME" id="NAME">
                        <input type="hidden" name="SURNAME" id="SURNAME" value=<?php echo $_POST["SURNAME"];?>>
                        <input type="hidden" name="VAT" value=<?php echo $_POST["VAT"];?>>
                        <input type="hidden" name="CONTACT_NUMBER" value=<?php echo $_POST["CONTACT_NUMBER"];?>>
                        <input type="hidden" name="TITLE_NAME" value=<?php echo $titleName;?>>
                        <input type="hidden" name="CUSTOMER_TYPE_ID" value=<?php echo $_POST["CUSTOMER_TYPE_ID"];?>>
                        <input type="hidden" name="STATUS" value=<?php echo $_POST["STATUS_ID"];?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $_POST["EMAIL"];?>>
                        <input type="hidden" name="ADDR" id="ADDR">
                        <input type="hidden" name="SUBURB" id="SUBURB">
                        <input type="hidden" name="CITY" id="CITY">
                        <!-- <input type="hidden" name="ZIP" value=<?php echo json_encode($suburbInfo);?>> -->
                        <button class="btn btn-icon btn-2 btn-primary btn-sm px-5" type="submit" style="width: 10rem">
                          <span class="btn-inner--icon"><i class="fas fa-wrench"></i>
                          </span>
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </form>
                    </div>
                    <div class="col d-inline mx-0 px-0">
                      <form id="formDelete" type='POST' class="d-inline">
                        <input type="hidden" name="ID" value=<?php echo $cusID;?>>
                        <button class="btn btn-icon btn-2 btn-danger btn-sm" type="submit" style="width: 10rem">
                          <span class="btn-inner--icon"><i class="fas fa-trash"></i>
                          </span>
                          <span class="btn-inner--text">Delete</span>
                        </button>
                      </form>
                    </div>
                    <div class="col d-inline mx-0 px-0">
                      <label hidden="true" id="cAccountCheck"><?php echo $creditAccountCheck;?></label>
                      <form id="formAccount" type='POST' class="d-inline">
                        <input type="hidden" name="ID" value=<?php echo $cusID;?>>
                        <input type="hidden" name="NAME" value=<?php echo $_POST["NAME"];?>>
                        <input type="hidden" name="SURNAME" value=<?php echo $_POST["SURNAME"];?>>
                        <input type="hidden" name="VAT" value=<?php echo $_POST["VAT"];?>>
                        <input type="hidden" name="CONTACT_NUMBER" value=<?php echo $_POST["CONTACT_NUMBER"];?>>
                        <input type="hidden" name="CUSTOMER_TYPE_ID" value=<?php echo $_POST["CUSTOMER_TYPE_ID"];?>>
                        <input type="hidden" name="STATUS" value=<?php echo $_POST["STATUS_ID"];?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $_POST["EMAIL"];?>>
                        <input type="hidden" name="ADDR" id="accountADDR">
                        <input type="hidden" name="SUBURB" id="accountSUBURB">
                        <input type="hidden" name="CITY" id="accountCITY">
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

        

  

      <!-- Footer -->
      <?php include_once("../footer.php");?>
      </div>
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
  <script type="text/javascript" src="JS/viewCustomer.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>