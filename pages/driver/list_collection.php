<?php
  include_once("../sessionCheckPages.php");
  $help="../../help/MakeCollection-ListCollection.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Make Collection - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Make Collection</a>
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

                      <div class="form-row ">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-group mb-4">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                  </div>
                                  <input class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Enter order #" title="Type in a name" type="text">
                                </div>
                              </div>
                            </div>
                      </div>
                      <div class="form-row">
                        <p class="mt-2 mb-0 mr-3">Order By:</p>
                          <div class="form-group col">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                     
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Date (Oldest)</a>
                                </li>
                           
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nearest</a>
                                </li>
                              </ul>
                          </div>
                      </div>



          </div>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                <div class="table-responsive">
                  <label hidden="true" id="aData"><?php echo $_POST["ass"];?></label>
                  <label hidden="true" id="apData"><?php echo $_POST["assP"];?></label>
                  <table id="myTable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="header">
                       
                        <th></th>
                        <th>Supplier Order#</th>
                    
                      </tr>
                    </thead>
                    <tbody id="tBody">
                      <!-- <thead class="table-light" id="dateHeading1">
                        <th><b>04/07/2019</b></th>
                        <th></th>
                      </thead> -->
                      
                      <!-- <thead class="table-light" id="dateHeading2">
                        <th><b>05/07/2019</b></th>
                        <th></th>
                      </thead> -->
                      <tr id="emptySearch" style="display: none;" class="table-danger">
                        <td><b>No Collection Found</b></td>
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
                        <th>Order#</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                      <thead class="table-light"  id="cityHeading1">
                        <th><b>Pretoria</b></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <button class="btn btn-icon btn-2 btn-primary btn-sm" type="button" data-dismiss="modal" data-toggle="modal" data-target="#select" >
                            <span class="btn-inner--icon"><i class="fas fa-truck"></i>
                            </span>
                            <span class="btn-inner--text">Make Collection</span>
                          </button>
                        </td>
                        <td>321</td>

                      </tr>
                      <tr>
                       
                        <td>
                          <button class="btn btn-icon btn-2 btn-primary btn-sm" type="button" onclick="window.location='assign-truck-view-collection.php'">
                            <span class="btn-inner--icon"><i class="fas fa-truck"></i>
                            </span>
                            <span class="btn-inner--text">Make Collection</span>
                          </button>
                        </td>
                        <td>255</td>
                     
                        
                      </tr>
                      <thead class="table-light"  id="cityHeading2">
                        <th><b>Kimberly</b></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <button class="btn btn-icon btn-2 btn-primary btn-sm" type="button" onclick="window.location='assign-truck-view-collection.php'">
                            <span class="btn-inner--icon"><i class="fas fa-truck"></i>
                            </span>
                            <span class="btn-inner--text">Make Collection</span>
                          </button>
                        </td>
                        <td>128</td>
                      </tr>

                      <thead class="table-light"  id="cityHeading3">
                        <th><b>Nelspruit</b></th>
                        <th></th>
                      </thead>
                      <tr>
                        <td>
                          <button class="btn btn-icon btn-2 btn-primary btn-sm" type="button" onclick="window.location='assign-truck-view-collection.php'">
                            <span class="btn-inner--icon"><i class="fas fa-truck"></i>
                            </span>
                            <span class="btn-inner--text">Make Collection</span>
                          </button>
                        </td>
                        <td>135</td>
                      </tr>
                      <tr id="emptySearch2" style="display: none;" class="table-danger">
                        <td><b>No Collection Found</b></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
       

              <div class="modal fade" id="select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to make the selected collection?</p>
                    </div>
                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" onclick="window.location='finalise_collection.php'">Yes</button>
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
                td2 = tr2[x].getElementsByTagName("td")[1];
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
  <script type="text/javascript" src="JS/listCollection.js"></script>
</body>

</html>