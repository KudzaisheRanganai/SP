<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Assign Truck - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Select Truck</a>
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
      <div class="row mb-3">
          <div class="card shadow col">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Select Truck</h3>
            </div>
            <div class="card-body">
              <div class="card shadow">
                <div class="card-header border-0">
                  <div class="input-group input-group-rounded input-group-merge col">
                   
                     <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter truck registration details" title="Type in a name" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
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
                      <th></th>
                      <th> Registration #</th>
                      <th> Truck Name</th>
                      <th> Capacity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" id="customCheck1" type="checkbox">
                          <label class="custom-control-label" for="customCheck1"> &nbsp;</label>
                        </div>
                      </td>
                      <td>BBC 123 NW</td>
                      <td>2015 Isuzu NPR</td>
                      <td>10 Pallets</td>

                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" id="customCheck2" type="checkbox">
                          <label class="custom-control-label" for="customCheck2"> &nbsp;</label>
                        </div>
                      </td>
                      <td>DSM 032 NW</td>
                      <td>2017 GMC Savana G33903</td>
                      <td>25 Pallets</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" id="customCheck3" type="checkbox">
                          <label class="custom-control-label" for="customCheck3"> &nbsp;</label>
                        </div>
                      </td>
                      <td>CAD 347 NW</td>
                      <td>2017 Freightliner M2</td>
                      <td>40 Pallets</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" id="customCheck4" type="checkbox">
                          <label class="custom-control-label" for="customCheck4"> &nbsp;</label>
                        </div>
                      </td>
                      <td>ADW 586 NW</td>
                      <td>2016 Volvo VNL84430</td>
                      <td>50 Pallets</td>
                    </tr>
                    <tr id="emptySearch" style="display: none;">
                      <td >No Truck Found</td>
                    </tr>
                    </tbody>
                  </table>

                  <script>
                  function myFunction() 
                  {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    var showCount = 0;
                    for (i = 0; i < tr.length; i++) 
                    {
                      td = tr[i].getElementsByTagName("td")[1];
                      if (td) 
                      {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter)> -1) 
                        {
                          tr[i].style.display = "";
                          showCount += 1;
                        } 
                        else 
                        {
                          tr[i].style.display = "none";
                        }
                      }       
                    }

                    if (showCount === 0)
                    {
                      $("#emptySearch").show();
                    } 
                    else
                    {
                      $("#emptySearch").hide();
                    }
                  }
                  </script>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row mb-3">
              </div>
              <div class="col mt-4">
                <button class="btn btn-icon btn-2 btn-primary mt-0" type="button" data-dismiss="modal" data-toggle="modal" data-target="#finalise">
                  <span class="btn-inner--text">Select Truck</span>
                </button>
              </div>
            </div>
            <div class="modal fade" id="finalise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to assign this truck to the selected delivery(ies)/collection(s)?</p>
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
                          <p>Truck assigned successfully</p>
                          
                      </div>
                      
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"  onclick="window.location='../../delivery_collection.php'">Close</button> 
                      </div>
                      
                  </div>
              </div>
            </div>
          </div>
        </div>
        
        <?php include_once("../footer.php");?>
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
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>