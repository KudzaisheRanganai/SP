<?php include_once("../sessionCheckPages.php");?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Order - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Order</a>
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
              <div class="row">
                <div class="col-4">
                  <h3 class="mb-0">Order Details</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">

                <div class="mb-5 col">
                  <ol class="progtrckr" data-progtrckr-steps="3">
                    <li class="progtrckr-done">Order Sent</li>
                    <li class="progtrckr-done">Order Confirmed</li>
                    <li class="progtrckr-todo">Order Received</li>
                   
                  </ol>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-6">
                  <div class="card card-stats" id="myTabContent" >
                    <div class="card-header" style="background-color: #81b69d">
                        <h5 class="card-title mb-0">Supplier Details</h5>
                    </div>
                    <div class="card-body px-3">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Supplier ID
                              </th>
                              <td >
                                  12
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Name
                              </th>
                              <td >
                                  Caines Foods
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                  Contact No
                              </th>
                              <td >
                                  067 345 6789
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Email
                              </th>
                              <td >
                                  caines.foods@gmail.com
                              </td>
                            </tr>                 
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
                <div class="col-6">
                  <div class="card card-stats" id="myTabContent" >
                    <div class="card-body px-3" style="height: 18.5rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                Date 
                              </th>
                              <td >
                                04/07/2019
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                Order #
                              </th>
                              <td >
                                321
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                Sales Manager
                              </th>
                              <td >
                                Jabu
                              </td>
                            </tr>      
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card shadow">
                <div class="table-responsive">

                  <table id="myTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th class="text-center"> Quantity</th>
                      <th> Item Name</th>
                      <th class="pl-4 text-right"> Unit Price</th>
                      <th class="text-right"> Total </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="py-3 text-center">30</td>
                      <td class="py-3">All Gold Tomato Sauce (6x350ml) Case</td>
                      <td class="text-right py-3">R83.00</td>
                      <td class="text-right py-3">R2 490.00</td>
                    </tr>

                    <tr>
                      <td class="py-3 text-center">30</td>
                      <td class="py-3">Apple Munch (96x50ml) Pallet</td>
                      <td class="text-right py-3">R81.00</td>
                      <td class="text-right py-3">R2 430.00</td>
                    </tr>
                    <tr>
                      <td class="py-3 text-center">80</td>
                      <td class="py-3">Kingsley Cola (6x2l) Case</td>
                      <td class="text-right py-3">R47.00</td>
                      <td class="text-right py-3">R3 760.00</td>
                    </tr>
                    <tr>
                      <td class="py-3 text-center">20</td>
                      <td class="py-1">Monster Energy Drink (24x500ml) Case</td>
                      <td class="text-right py-3">R130.00</td>
                      <td class="text-right py-3">R2 600.00</td>
                    </tr>

                    
                    </tbody>
                    <tfoot class="tfoot-light">
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>TOTAL</b></th>
                      <td class="text-right"><b>R11 280.00</b></td>
                    </tr>
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>VAT (15%)</b></th>
                      <td class="text-right"><b>R2 820.00</b></td>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <br>
 
            
          

              <div class="col mt-4">
                <button class="btn btn-icon btn-2 btn-primary mt-0" type="button" onclick="window.history.go(-1); return false;">
                  <span class="btn-inner--text">Close</span>
                </button>  
                <button class="btn btn-icon btn-2 btn-danger mt-0 float-right mr-2" type="button" data-toggle="modal" data-target="#del">
                  <span class="btn-inner--icon"><i class="fas fa-times-circle"></i></span>
                  <span class="btn-inner--text" >Cancel Order</span>
                </button>
                <button class="btn btn-icon btn-2 btn-warning mt-0 float-right mr-2" type="button" onclick="window.location='../stock/return-order.html'" disabled>
                  <span class="btn-inner--icon"><i class="fas fa-undo"></i></span>
                  <span class="btn-inner--text">Make Return</span>
                </button>
                <button class="btn btn-icon btn-2 btn-success mt-0 float-right mr-2" type="button" onclick="window.location='../stock/receive-order.html'">
                  <span class="btn-inner--icon"><i class="fas fa-layer-group"></i></span>
                  <span class="btn-inner--text" >Receive Order</span>
                </button>
                <button class="btn btn-icon btn-2 btn-default mt-0 float-right mr-2" type="button" data-toggle="modal" data-target="#modal-addCollection">
                  <span class="btn-inner--icon">
                    <i class="fas fa-truck"></i>
                  </span>
                  <span class="btn-inner--text" >Add Collection</span>
                </button>
              </div>
              <div class="modal fade" id="modal-addCollection" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Warning</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group col">
                        <label for="bane">Are you sure you want to add a collection to the order?</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-accountSuccess" onclick="window.location='../delivery_collection/add_collection.html'">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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
                    <div class="modal-body">
                      <p>Are you sure you want to cancel the selected order?</p>
                    </div>
                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-succ">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modal-succ" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    
                      <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-default">Success!</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      
                      <div class="modal-body">
                          <p>Order successfully cancelled. The supplier has been sent an email. </p>
                          <p>Printing cancellation slip...</p>
                          
                      </div>
                      
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-link  ml-auto" onclick="window.location='../../supplier.html'">Close</button> 
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
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>