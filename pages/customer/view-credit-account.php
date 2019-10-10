<?php include_once("../sessionCheckPages.php");
  $help="../../help/ViewCreditAccount.html";
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Customer Credit Account - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Credit Account</a>
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
              <h3 class="mb-0">Customer Credit Account Details</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="card card-stats" id="myTabContent" style="height:22rem;">
                    <div class="card-header" style="background-color: #81b69d">
                        <h5 class="card-title mb-0">Customer Details</h5>
                    </div>
                    <div class="card-body">
                      <div class="table-borderless table-responsive">
                        <div>
                          <table class="table align-items-center table-flush">
                            <tbody class="list">    <tr id="acc">
                                    <th>
                                        Account No
                                    </th>
                                   
                                </tr>                               
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <td >
                                       <?=$_GET["NAME"]?>
                                    </td>
                                </tr> 
                                <tr>
                                    <th>
                                        Surname
                                    </th>
                                    <td >
                                        <?=$_GET["SURNAME"]?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Customer ID
                                    </th>
                                    <td id="ID" value="<?=$_GET['ID']?>">
                                        <?=$_GET["ID"]?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Email
                                    </th>
                                    <td >
                                        <?=$_GET["EMAIL"]?>
                                    </td>
                                </tr>                      
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-6">
                  <div class="card card-stats" id="myTabContent" style="height:22rem;">
                    <div class="card-header" style="background-color: #81b69d">
                        <h5 class="card-title mb-0">Account Details</h5>
                    </div>
                    <div class="card-body">
                      <div class="table-borderless">
                        <div>
                          <table class="table align-items-center table-flush">
                            <tbody class="list">                          
                                <tr id="balance">
                                    <th>
                                        Outstanding Balance
                                    </th>
                                  
                                </tr>
                      
                             
                                <tr id="limit">
                                    <th>
                                        Current Credit Limit
                                    </th>
                                 
                                </tr> 
                                <tr class="mt-0 pt-0">
                                    <th>
                                        
                                    </th>
                                    <td class="text-right pt-0 pb-3 pr-3">
                                        <button class="btn btn-icon btn-2 btn-primary btn-sm mt-0 py-2" type="button" data-toggle="modal" data-target="#modal-creditlimit">
                                        <span class="btn-inner--icon"><i class="fas fa-exchange-alt"></i>
                                        </span>
                                        <span class="btn-inner--text">Change Credit Limit</span>
                                      </button>
                                      <div class="modal fade" id="modal-creditlimit" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                          <div class="modal-content">
                                            
                                              <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-default">Change Credit Limit</h6>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              
                                              <div class="modal-body text-left">
                                                <form action="" method="POST" id="limit-form">
                                                  <div class="col mb-4">
                                                    <label for="c2">Credit Limit</label>
                                                    <div class="input-group"> 
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                                                      </div>

                                                      <input type="number" value="10000" min="0" step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="credit-limit" name="credit-limit" />
                                                      <input type="number" name="customerID" id="customerID" value="<?=$_GET['ID']?>" hidden>
                                                    </div> 
                                                  </div>
                                                  <input type="submit" class="btn btn-success  ml-auto" /> 

                                                </form>
                                              </div>
                                              <div class="modal-footer">
                                                  
                                                  
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
                                              
                                              <div class="modal-body text-left">
                                                <p>Credit Limit successfully updated</p>
                                                  
                                              </div>
                                              
                                              <div class="modal-footer">
                                                  
                                                  <a  href="../../customer.php" class="btn btn-link  ml-auto" data-dismiss="modal">Close</a> 
                                              </div>
                                              
                                          </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <th>
                                  </th>
                                  <td class="text-right pt-0 pb-3 pr-3">
                                    <a href="#" id="viewBS" class="btn btn-icon btn-2 btn-primary btn-sm mt-0 py-2" target="_blank">View Bank Statement</a>
                                  </td>
                                </tr>
                                <tr>
                                  <th>
                                  </th>
                                  <td class="text-right pt-0 pb-3 pr-3">
                                    <a href="#" id="viewID" class="btn btn-icon btn-2 btn-primary btn-sm mt-0 py-2" target="_blank">View ID Copy</a>
                                  </td>
                                </tr>
                                <tr>
                                  <th>
                                  </th>
                                  <td class="text-right pt-0 pb-3 pr-3">
                                    <a href="#" id="viewRes" class="btn btn-icon btn-2 btn-primary btn-sm mt-0 py-2" target="_blank">View Proof Of Residence</a>
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
            <br>
            <!-- Table -->
            <div class="row">
              <div class="col">
                <div class="card shadow">
                  <div class="card-header border-0">
                     <div class="input-group input-group-rounded input-group-merge">
                       
                       <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search transactions by reference number" title="Type in a name" class="form-control form-control-rounded form-control-prepended" aria-label="Search">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <span class="fa fa-search"></span>
                          </div>
                        </div>
                  </div>
                </div>
                <div class="table-responsive">

                  <table id="myTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th> Date</th>
                      <th> Reference</th>
                      <th> Description</th>
                      <th class="text-right"> Amount</th>
                      <th class="text-right"> Payment</th>
                      <th class="text-right"> Amount Due</th>
                    </tr>
                  </thead>
                  <tbody id="tBody">
                    </tbody>
                    <tfoot class="tfoot-light">
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>TOTAL DUE</b></th>
                      <td class="text-right"><b id="total"></b></td>
                    </tr>
                    
                    </tfoot>
                  </table>

                  <script>
                  function myFunction() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                      td = tr[i].getElementsByTagName("td")[1];
                      if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                          tr[i].style.display = "";
                        } else {
                          tr[i].style.display = "none";
                        }
                      }       
                    }
                  }
                  </script>
                </div>
              </div>
            </div>
          </div>
              <div class="col ">
                
                <button type="button" class="btn btn-success mb-3 mt-4 float-right" data-toggle="modal" id="btnPay">
                  <span><i class="fas fa-money-check-alt mr-2"></i></span>
                <span class="btn-inner--text">Pay Off Account</span>
                </button>
              </div>
              <div class="modal fade" id="modal-default1" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Email Account Statement</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group col">
                            <label for="bane">Email Address</label>
                            <input type="email" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter email address">
                          </div>    
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-success  ml-auto" data-dismiss="modal" data-toggle="modal" data-target="#modal-success">Send</button> 
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Print Account Statement</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Account statement successfully sent to email....</p>
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../customer.php'">Close</button> 
                        </div>
                    </div>
                </div>
              </div>
              
              <div class="modal fade" id="modal-default2" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Print Account Statement</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <p>Printing account statement....</p>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../customer.php'">Close</button> 
                        </div>
                        
                    </div>
                </div>
              </div>
              <div class="modal fade" id="modal-pay" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content"> 
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Make Payment</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body text-left">
                      <form action="" method="POST">
                        <div class="col mb-4">
                            <label for="c2">Enter Amount Received</label>
                            <div class="input-group"> 
                              <div class="input-group-prepend">
                                <span class="input-group-text " id="inputGroupFileAddon01">R</span>
                              </div>
                              <input type="number" value="" min="0" step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="amount" name="amount" autofocus >
                              <input type="number" name="customerID" id="customerID" value="<?=$_GET['ID']?>" hidden >
                            </div> 
                          </div>
  
                          <input type="submit" id="btnPayOff" class="btn btn-success  ml-auto">

                      </form>
                    </div>
                    <div class="modal-footer">
                          
                    
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
              <div class="modal fade" id="modal-change" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Success!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>  
                    <div class="modal-body text-left">
                      <div class="mb-4 px-2">
                        <table class="table table-sm">
                          <tr>
                            <td class="table-light">Amount Received</td>
                            <td class="text-right">R2 900.00</td>
                          </tr>
                          <tr>
                            <td class="table-light">Total Outstanding</td>
                            <td class="text-right">R2 820.00</td>
                          </tr>
                          <tfoot>
                            <td class="table-success">Change</td>
                            <td class="text-right table-success">R80.00</td>
                          </tfoot>
                        </table>
                      </div>
                      <p class="ml-2">Account payment successful. Printing payment invoice...</p>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="window.location='../../customer.php'">Close</button> 
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
  <script type="text/javascript" src="JS/viewAccount.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>