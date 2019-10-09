<?php include_once("../sessionCheckPages.php");
  $help="../../help/PlaceStockItem.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Place Stock Item - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Place Stock Item</a>
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
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row mb-3">
          <div class="card shadow col">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Place Stock Details</h3>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col">
                  <div class="card card-stats py-2 px-5" id="myTabContent" >
                    <h3 class="text-center">Select Current Warehouse</h3>
                    <div class="row pt-3 px-5" id="sourceW">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card shadow">
                    <div class="card-header border-0">
                      <div class="input-group input-group-rounded input-group-merge">
                          <button class="btn btn-default dropdown-toggle btn-block col" type="button" id="dropdown_coins" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Add Product
                          </button>
                          <div id="menu" class="dropdown-menu col px-4 mb-4" aria-labelledby="dropdown_coins">
                              <form class="px-1 py-2">
                                <div class="input-group input-group-rounded input-group-merge">
                                  <input type="search" class="form-control form-control-rounded form-control-prepended" id="searchProduct" placeholder="Enter Product Name" autofocus="true">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <span class="fa fa-search"></span>
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <div id="menuItems"></div>
                              <div id="empty" class="dropdown-header table-danger" style="color: black">
                                No products found
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table id="myTable" class="table align-items-center table-flush">
                         <thead class="thead-light">
                        <tr class="header">
                          <th class="text-center"> Quantity To Place</th>
                          <th>Item Name</th>
                          <th class="text-center">Quantity</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="tBody"> 
                      </tbody>
                      </table>

                      <script>
                      // function myFunction() {
                      //   var input, filter, table, tr, td, i, txtValue;
                      //   input = document.getElementById("myInput");
                      //   filter = input.value.toUpperCase();
                      //   table = document.getElementById("myTable");
                      //   tr = table.getElementsByTagName("tr");
                      //   for (i = 0; i < tr.length; i++) {
                      //     td = tr[i].getElementsByTagName("td")[1];
                      //     if (td) {
                      //       txtValue = td.textContent || td.innerText;
                      //       if (txtValue.toUpperCase().indexOf(filter) > -1) {
                      //         tr[i].style.display = "";
                      //       } else {
                      //         tr[i].style.display = "none";
                      //       }
                      //     }       
                      //   }
                      // }
                      </script>
                    </div>
                </div>
                <div class="card card-stats mt-3 py-2 px-5" id="myTabContent" >
                  <div class="form-group">
                    <h3 for="bane">Choose Destination Warehouse</h3>
                    <select class="form-control" id="destinationWarehouse">
                    </select>
                  </div>
                </div>
              </div>
              <br>

                <div class="col mt-4">
                  <button class="btn btn-icon btn-2 btn-success mt-0" type="button" data-toggle="modal" data-target="#modal-confirm">
                    <span class="btn-inner--text">Place Stock</span>
                  </button>
                </div>
                <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content"> 
                      <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-default">Place Stock?</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <div class="col text-left">
                          <p>Are you sure you want to place the selected products to the selected warehouse?</p>   
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" id="btnSave">Yes</button>
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
  <script type="text/javascript" src="JS/placestock.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>