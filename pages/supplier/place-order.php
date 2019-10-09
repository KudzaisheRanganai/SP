<?php include_once("../sessionCheckPages.php");
  $help="../../help/PlaceSupplierOrder.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Place Order - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<style type="text/css">
  .dropdown-menu{
    transform: translate3d(0px, 2.7rem, 0px)!important;
  }
</style>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Place Order</a>
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
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
        <div class="col col-sm-12 col-md-12 col-xl-12 px-0">
          <div class="row">
            <div class="col col-sm-12 col-md-12 col-xl-12 px-0">
              <div class="card card-stats shadow bg-secondary">
                <div class="card-body">
                  <div class="row"> 
                    <div class="col-5 py-auto vertical-center pl-6">
                      <div class="input-group input-group-rounded input-group-merge align-middle mt-5">
                        <input type="search" id="supplierSearchInput" placeholder="Enter Supplier Name" title="Type in a name" class="form-control form-control-rounded form-control-prepended">
                        <div class="input-group-prepend">
                          <div class="input-group-text bg-customGreen" id="searchCustomerButton">
                          <span class="fa fa-search" style="color: white"></span>
                          </div>
                        </div>
                        <input type="hidden" id="supplierDropdownToggle" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div id="menuCust" class="dropdown-menu col px-2 mb-2" aria-labelledby="supplierDropdownToggle">
                          <div id="menuOfCustomers"></div>
                          <div id="empty2" class="dropdown-header table-danger" style="color: black">
                            No Supplier found
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-7 ">
                      <div class="row px-0">
                        <div class="card shadow col-10 table ml-5"  style="width: 100%;">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3 d-inline px-2">
                                <div class="mt-3 mb-3">
                                  <a>
                                    <img src="../../images/user.png" class="rounded-circle" style="height:103px; width: 103px">
                                  </a>
                                </div>
                              </div>
                              <div class="px-0 col-9 d-inline">
                                <style type="text/css">
                                  table#customerCard tr
                                  {
                                    padding: 3px;
                                    height:10px !important;
                                  }
                                </style>
                                <table class="table align-items-center table-flush table-borderless table-responsive bg-white mr-0 pr-0" id= "supplierCard">
                                  <tbody class="list">
                                    <tr><td class="mt-6"></td></tr>
                                    <tr class="pt-4">
                                      <th class="py-0"> No Supplier Added</th>
                                      <td >
                                          
                                      </td>
                                    </tr>                  
                                  </tbody>
                                </table>
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

          <div class="row mt-3">
            <div class="col col-sm-12 col-md-12 col-xl-12 px-0">
              <div class="card card-stats shadow">
                <div class="card-header border-0 bg-secondary">
                  <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" id="searchProduct" placeholder="Enter Product Name" autofocus="true">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <span class="fa fa-search"></span>
                      </div>
                    </div>
                    <input type="hidden" id="productsDropdownToggle" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div id="menu" class="dropdown-menu col px-4 mb-3" aria-labelledby="productsDropdownToggle">
                      <div id="menuItems"></div>
                      <div id="empty" class="dropdown-header table-danger" style="color: black">
                        No product found
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-body">
                <div class="table-responsive col pl-0">
                  <table id="productsTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th class="col-3" style="width: 2rem"> Quantity</th>
                      <th class="pl-0" style="width: 20rem"> Item Name</th>
                      <th class="text-right pr-1"> Cost Price</th>
                      <th class="text-right pr-1" style="width: 8rem"> Total </th>
                      <th class="text-centre px-0" style="width: 0.5rem"></th>
                    </tr>
                  </thead>
                  <tbody id="tBody">
                    </tbody>
                    <tfoot class="tfoot-light">
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right pr-1"><b>TOTAL</b></th>
                      <td class="text-right pr-1" id="totalOfSale"><b></b></td>
                      <td></td>
                    </tr>
                     <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right pr-1"><b>VAT (15%)</b></th>
                      <td class="text-right pr-1" id="vatOfSale"><b></b></td>
                      <td></td>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col col-sm-12 col-md-12 col-xl-12 px-0">
            <div class="card card-stats shadow">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="row">
                        <div class="col">
                           <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="addSaleDeliveryCheckbox" type="checkbox" data-toggle="collapse" data-target="#customerAddresses" aria-expanded="false" aria-controls="customerAddresses">
                            <label class="custom-control-label" for="addSaleDeliveryCheckbox">Add Order Collection</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col collapse pl-5" id="customerAddresses">

                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <span class="float-right">
                        <button class="btn btn-success" id="placeOrderButton" data-toggle="modal" data-target="#modal-placeOrderConfirmation">
                          <span class="btn-inner--icon  mr-2">
                            <i class="fas fa-check"></i>
                          </span>
                          <span class="btn-inner--text">
                            Place Order
                          </span>
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

        <div class="modal fade" id="modal-placeOrderConfirmation" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to place the order?</p>
              </div>
              <div class="modal-footer">
                <button type="button" id="confirmPlaceOrder" class="btn btn-success" data-dismiss="modal">Yes</button>
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
  <!-- Make Sale JS -->
  <script src="JS/placeOrder.js"></script>
  <script type="text/javascript">
    var SESSION = eval('(<?php echo json_encode($_SESSION)?>)');
  </script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>