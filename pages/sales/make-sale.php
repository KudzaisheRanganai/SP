<?php include_once("../sessionCheckPages.php");
  $help="../../help/MakeSale.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Make Sale - Stock Path</title>
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
  <!-- validation -->
  <link href="../../assets/jqueryui/jquery-ui.css" rel="stylesheet">
  <!-- Validation Stylesheet -->
  <link rel="stylesheet" href="../../assets/css/site-demos.css">
  <!-- calander -->
  <link href='../../assets/fullcalender/packages/core/main.css' rel='stylesheet' />
  <link href='../../assets/fullcalender/packages/daygrid/main.css' rel='stylesheet' />
  <link href='../../assets/fullcalender/packages/bootstrap/main.css' rel='stylesheet' />
</head>

<style type="text/css">
  .dropdown-menu{
    transform: translate3d(0px, 2.7rem, 0px)!important;
  }
  .ui-autocomplete, #displayModal
    {
        position:absolute;
        cursor:default;
        z-index:4000 !important
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Make Sale</a>
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
    <div class="container-fluid mt--9">
      <div class="col col-sm-12 col-md-12 col-xl-12 px-0 bg-transparent float-lg-top">

      <div class="row">
        <div class="col col-sm-12 col-md-12 col-xl-12 px-0">
          <div class="card card-stats shadow bg-secondary">
            <div class="card-body">
              <div class="row"> 
                <div class="col-3 py-auto vertical-center">
                  <div class="input-group input-group-rounded input-group-merge align-middle mt-5">
                    <input type="search" id="customerSearchInput" placeholder="Enter Customer Name" title="Type in a name" class="form-control form-control-rounded form-control-prepended">
                    <div class="input-group-prepend">
                      <div class="input-group-text bg-customGreen" id="searchCustomerButton">
                      <span class="fa fa-search" style="color: white"></span>
                      </div>
                    </div>
                    <input type="hidden" id="customerDropdownToggle" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div id="menuCust" class="dropdown-menu col px-2 mb-2" aria-labelledby="customerDropdownToggle">
                      <div id="menuOfCustomers"></div>
                      <div id="empty2" class="dropdown-header table-danger" style="color: black">
                        No Customer found
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 ">
                  <div class="row">
                    <div class="card shadow table ml-5"  style="width: 100%;">
                      <div class="card-body">
                        <div class="row">
                          <div class=" col-3 d-inline pl-3">
                              <a>
                                <img src="../../images/user.png" class="rounded-circle" style="height:103px; width: 103px">
                              </a>
                          </div>
                          <div class="px-3 col-9 d-inline">
                            <style type="text/css">
                              table#customerCard tr
                              {
                                padding: 5px;
                                height:10px !important;
                              }
                            </style>
                            <table class="table align-items-center table-flush table-borderless table-responsive bg-white mr-0 pr-0" id= "customerCard">
                              <tbody class="list">
                                <tr></tr> 
                                <tr></tr> 
                                <tr></tr> 
                                <tr>
                                  <th class="py-0"> No Customer Added</th>
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
                <div class="col-3 py-auto vertical-center pl-3 pt-5">
                  <span class=" my-auto align-middle">
                    <button class="btn bg-gradient-custom float-right px-4" style="width: 13rem;" data-toggle="modal" data-target="#registerCustomerModal">
                        <span class="btn-inner--icon mr-2">
                          <i class="fas fa-user-plus"></i>
                        </span>
                        <span class="btn-inner--text">
                          Add Customer
                        </span>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Table -->
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
            <div class="table-responsive col-12 pl-0">

              <table id="productsTable" class="table align-items-center table-flush">
                 <thead class="thead-light">
                <tr class="header">
                  <th class="col-3" style="width: 2rem"> Quantity</th>
                  <th class="pl-0" style="width: 20rem"> Item Name</th>
                  <th class="pl-4" style="text-align: center;"> Unit Price</th>
                  <th class="text-right pr-1 pl-2"> Guide Price</th>
                  <th class="text-right pr-1"> Cost Price</th>
                  <th class="text-right pr-1"> Profit </th>
                  <th class="text-right pr-1" style="width: 8rem"> Subtotal </th>
                  <th class="text-centre px-0" style="width: 0.5rem"></th>
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
                  <td></td>
                  <th class="text-right pr-1"><b>TOTAL</b></th>
                  <td class="text-right pr-1" id="totalOfSale"><b></b></td>
                  <td></td>
                </tr>
                 <tr class="footer">
                  <td></td>
                  <td></td>
                  <td></td>
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

        <div class="modal fade" id="modal-salesManagerPassword" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="modal-title-default">Finalise Sale</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group col">
                  <label for="bane">Sales Manager Password</label>
                  <input type="password" class="form-control" id="salesManagerPassword" aria-describedby="emailHelp" placeholder="Enter password" required>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-success  ml-auto" id="confirmSalesManagerPassword">Approve Sale</button> 
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
        </div>

        <div class="row mt-0">
          <div class="col col-sm-12 col-md-12 col-xl-12 px-0">
            <div class="card card-stats shadow">
              <div class="card-header">
                         <button type="button" class="btn btn-info  " data-toggle="modal" data-target="#exampleModal">
                        <i class="far fa-calendar-alt"></i>
                        Show Calander
                        </button>
              </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="row">
                        <div class="col">
                           <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="addSaleDeliveryCheckbox" type="checkbox" data-toggle="collapse" data-target="#customerAddresses" aria-expanded="false" aria-controls="customerAddresses">
                            <label class="custom-control-label pt-1" for="addSaleDeliveryCheckbox">Add Sale Delivery</label>
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
               
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-info">
                                <h5 class="modal-title" id="exampleModalLabel">Calander</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div id="calender"></div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      </span>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-success float-right" id="finaliseSale" data-toggle="modal" data-target="#modal-salesManagerPassword">
                          <span class="btn-inner--icon  mr-2">
                            <i class="fas fa-check"></i>
                          </span>
                          <span class="btn-inner--text">
                            Finalise Sale
                          </span>
                        </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php include_once("../footer.php");?>
    </div>
  </div>

  <div class="modal fade" id="registerCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Add Customer</h3>
        </div>
        <div class="modal-body">
          <div class="col">
              <div class="row">

                <ul class="nav nav-pills ml-3" id="myTab" role="tablist">
                 
                  <li class="nav-item">
                    <a class="nav-link active" id="cIndividual" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                      <i class="far fa-user mr-2"></i>
                    Individual</a>
                  </li>
             
                  <li class="nav-item">
                    <a class="nav-link" id="cOrganisation" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-building mr-2"></i>
                    Organisation</a>
                  </li>
                </ul>
              </div>
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form method="POST" action="" id="mainfind">
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="name-indi">Name</label>
                          <input type="text" class="form-control" id="name-indi" name="name-indi" placeholder="Enter name" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="surname-indi">Surname</label>
                          <input type="text" class="form-control" id="surname-indi" name="surname-indi" placeholder="Surname" required>
                        </div>
                      </div>
                      <div class="form-row ">
                        <div class="form-group col-lg-2 col-md-4 col-sm-12">
                          <label for="title">Title</label>
                          <select class="form-control" id="titleSelect" name="title">
                            <option>Mr</option>
                            <option>Ms</option>
                            <option>Mrs</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-10 col-md-8 col-sm-12">
                          <label for="number-indi">Contact Number</label>
                          <input type="text" maxlength="10" class="form-control" id="number-indi" name="number-indi" placeholder="Contact Number" required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col">
                          <label for="email-indi">Email</label>
                          <input type="email" class="form-control" id="email-indi" name="email-indi" placeholder="Email" required>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col">
                          <label for="address1">Address line 1</label>
                          <input type="text" class="form-control indinputAddress" id="indinputAddress" placeholder="1234 Main St" name="address1" required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="suburb">Suburb</label>
                          <input type="text" class="form-control indinputSuburb" id="indinputSuburb" name="suburb" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                          <label for="inputState">City</label>
                          <input type="text" class="form-control indinputCity" id="indinputCity" name="suburb" readonly>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12">
                          <label for="zip">Zip</label>
                          <input type="text" class="form-control indinputZip" id="indinputZip" name="zip" readonly>
                        </div>
                      </div> 
                    </form>
                    <div class="row">
                       <div class="col-md-2 text-center float-right">
                        <button class="btn btn-success " id="btn-add-address-ind" type="button">
                          <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add Address</span>
                        </button>         
                      </div>
                     </div>
                     <div class="row">
                      <div class="col-md-2 mt-3 text-center">
                        <button id="btnSaveind" type="button" class="btn btn-primary">
                            Submit
                          </button>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade " id="profile"  aria-labelledby="profile-tab">
                    <form method="POST" action="" id="mainforg" novalidate>
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="email-org">Name of organisation</label>
                          <input type="text" class="form-control" id="name-org" name="name-org"  placeholder="Name" required>
    
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                          <label for="password-indi">Business email</label>
                          <input type="email" class="form-control" id="email-org" name="password-indi" placeholder="Email" required>
                        </div>
                      </div>
                      <div class="form-row ">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="vat">VAT Number</label>
                          <input type="number" class="form-control" id="vat-org" name="vat" placeholder="Vat number" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="number-org">Business Contact Number</label>
                          <input type="number" class="form-control" id="number-org" name="number-org" placeholder="Contact number" required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col">
                          <label for="address1-org">Address line 1</label>
                          <input type="text" class="form-control orginputAddress" id="orginputAddress" name="address1-org" placeholder="1234 Main St" required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                          <label for="orginputSuburb">Suburb</label>
                          <input type="text" class="form-control orginputSuburb" id="orginputSuburb" name="suburb-org" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                          <label for="city-org">City</label>
                          <input type="text" class="form-control orginputCity" id="orginputCity" name="suburb-org" readonly="">
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12">
                          <label for="zip-org">Zip</label>
                          <input type="text" class="form-control orginputZip" id="orginputZip" name="zip-org" readonly="">
                        </div>
                      </div>  
                    </form>
                    <div class="row">
                      <div class="col-md-2 float-right">
                        <button class="btn btn-success " id="btn-add-address-org" type="button">
                            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add Address</span>
                        </button>   
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 mt-3 text-center">
                          <button id="btnSaveorg" type="button" class="btn btn-primary" >
                              Submit
                          </button>
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
  <div class="modal fade errorModal successModal text-center" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" id="displayModal">
    <div class="modal-dialog modal- modal-dialog-centered modal- " role="document">
      <div class="modal-content">
        <div class="modal-header" id="modalHeader2">
            <h6 class="modal-title" id="modal-title-default">Success!</h6>
        </div>
        <div class="modal-body">
            <p id="MMessage"></p>
            <div id="animation2" style="text-align:center;">

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link ml-auto" data-dismiss="modal" id="btnClose" >Close</button> 
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
  <script src="../../assets/jqueryui/jquery-ui.js"></script>
  <!-- Make Sale JS -->
  <script src="JS/makeSale.js"></script>
  <!-- Register Customer JS -->
  <script src="JS/registerCustomer.js"></script>
  <!-- Get Session Variable -->
  <script type="text/javascript">
    var SESSION = eval('(<?php echo json_encode($_SESSION)?>)');
  </script>
  <script src='../../assets/fullcalender/packages/core/main.js'></script>
  <script src='../../assets/fullcalender/packages/daygrid/main.js'></script>
  <script src='../../assets/fullcalender/packages/timegrid/main.js'></script>
  <script src='../../assets/fullcalender/packages/list/main.js'></script>
  <script src='../../assets/fullcalender/packages/bootstrap/main.js'></script>
  <script type="text/javascript" src="JS/calendarForAdd.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>

