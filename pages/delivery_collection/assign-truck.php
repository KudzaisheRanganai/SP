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
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Assign Truck</a>
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
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
               <div class="input-group input-group-rounded input-group-merge col">
                 
                  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter order or invoice #" title="Type in a name" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-search"></span>
                    </div>
                  </div>
                  <div class="col-2" style="text-align: right;">  <p class="mt-2 mb-0 mr-3">Order By:</p>
                  </div>
                  <!-- Button trigger modal -->
                    <ul class="nav nav-pills" id="myTab" role="tablist">
                     
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                          <i class="ni ni-calendar-grid-58 mr-2"></i>
                          Date
                        </a>
                      </li>
                 
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        <i class="fas fa-city mr-2"></i>
                        City
                        </a>
                      </li>
                    </ul>
            </div>
          </div>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                <div class="table-responsive">
                  <table id="myTable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="header">
                        <th></th>
                        <th>Type</th>
                        <th>Order/Invoice #</th>
                        <th>Date</th>
                        <th>City</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <thead class="table-light" id="dateHeading1">
                        <th><b>25/07/2019</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Delivery</td>
                        <td>321</td>
                        <td>25/07/2019</td>
                        <td>Pretoria</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-delivery.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Collection</td>
                        <td>124</td>
                        <td>25/07/2019</td>
                        <td>Johannesburg</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-collection.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <thead class="table-light" id="dateHeading2">
                        <th><b>26/07/2019</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Collection</td>
                        <td>128</td>
                        <td>26/07/2019</td>
                        <td>Pretoria</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-collection.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Delivery</td>
                        <td>324</td>
                        <td>26/07/2019</td>
                        <td>Johannesburg</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-delivery.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Delivery</td>
                        <td>325</td>
                        <td>26/07/2019</td>
                        <td>Bloemfontein</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-delivery.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <thead class="table-light" id="dateHeading3">
                        <th><b>27/07/2019</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Collection</td>
                        <td>135</td>
                        <td>27/07/2019</td>
                        <td>Johannesburg</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-collection.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr id="emptySearch" style="display: none;" class="table-danger">
                        <td><b>No Delivery/Collection Found</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table id="myTable2" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="header">
                        <th></th>
                        <th>Type</th>
                        <th>Order/Invoice #</th>
                        <th>Date</th>
                        <th>City</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <thead class="table-light" id="cityHeading1">
                        <th><b>Pretoria</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Delivery</td>
                        <td>321</td>
                        <td>25/07/2019</td>
                        <td>Pretoria</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-delivery.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Collection</td>
                        <td>128</td>
                        <td>25/07/2019</td>
                        <td>Pretoria</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-collection.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <thead class="table-light" id="cityHeading2">
                        <th><b>Johannesburg</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Collection</td>
                        <td>124</td>
                        <td>25/07/2019</td>
                        <td>Johannesburg</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-collection.php'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Delivery</td>
                        <td>324</td>
                        <td>26/07/2019</td>
                        <td>Johannesburg</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-delivery.php'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Collection</td>
                        <td>135</td>
                        <td>27/07/2019</td>
                        <td>Johannesburg</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-collection.php'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <thead class="table-light" id="cityHeading3">
                        <th><b>Bloemfontein</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <label class="custom-toggle mt-3" >
                              <input type="checkbox" id="toggle-two" >
                              <span class="custom-toggle-slider rounded-circle"  </span>
                          </label>
                        </td>
                        <td>Delivery</td>
                        <td>325</td>
                        <td>26/07/2019</td>
                        <td>Bloemfontein</td>
                        <td>
                          <button class="btn btn-icon btn-2 btn-success btn-sm" type="button" onclick="window.location='assign-truck-view-delivery.html'">
                            <span class="btn-inner--icon"><i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-inner--text">View</span>
                          </button>
                        </td>
                      </tr>
                      <tr id="emptySearch2" style="display: none;" class="table-danger">
                        <td ><b>No Delivery/Collection Found</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <hr class="mt-0">
              <div class="col mt-4">
                <button class="btn btn-icon btn-2 btn-primary mt-0 mb-3" type="button" data-dismiss="modal" data-toggle="modal" data-target="#select">
                  <span class="btn-inner--text">Assign</span>
                </button>
              </div>
              <div class="modal fade" id="select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to assign the selected delivery(ies)/collection(s)?</p>
                    </div>
                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" onclick="window.location='assign-truck-selection.php'">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            </div>

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
                td = tr[i].getElementsByTagName("td")[2];
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
                document.getElementById("dateHeading1").style.display = "none";
                document.getElementById("dateHeading2").style.display = "none";
                document.getElementById("dateHeading3").style.display = "none";
              } 
              else
              {
                $("#emptySearch").hide();
                document.getElementById("dateHeading1").style.display = "";
                document.getElementById("dateHeading2").style.display = "";
                document.getElementById("dateHeading3").style.display = "";
              }
            

              let input2, filter2, table2, tr2, td2, x, txtValue2;
              input2 = document.getElementById("myInput");
              filter2 = input2.value.toUpperCase();
              table2 = document.getElementById("myTable2");
              tr2 = table2.getElementsByTagName("tr");
              var showCount = 0;
              for (x = 0; x < tr2.length; x++) 
              {
                td2 = tr2[x].getElementsByTagName("td")[2];
                if (td2) 
                {
                  txtValue2 = td2.textContent || td2.innerText;
                  if (txtValue2.toUpperCase().indexOf(filter2)> -1) 
                  {
                    tr2[x].style.display = "";
                    showCount += 1;
                  } 
                  else 
                  {
                    tr2[x].style.display = "none";
                  }
                }       
              }

              if (showCount === 0)
              {
                $("#emptySearch2").show();
                document.getElementById("cityHeading1").style.display = "none";
                document.getElementById("cityHeading2").style.display = "none";
                document.getElementById("cityHeading3").style.display = "none";
              } 
              else
              {
                $("#emptySearch2").hide();
                document.getElementById("cityHeading1").style.display = "";
                document.getElementById("cityHeading2").style.display = "";
                document.getElementById("cityHeading3").style.display = "";
              }
            }
            </script>
          </div>
        </div>
      </div>
  

      <?php include_once("../footer.php");?>
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