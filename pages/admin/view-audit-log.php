<?php include_once("../sessionCheckPages.php");
  $help="../../help/ViewAuditLog.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Audit Log - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Audit Log</a>
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
            <div class="card-header border-0">
              <div class="row">
               <div class="input-group input-group-rounded input-group-merge col">
                 
                 <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter audit log search details" title="Type in a name" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-search"></span>
                    </div>
                  </div>
                  <div class="col-2" style="text-align: right;"><p class="mt-2 mb-0">Search By:</p></div>
                  <!-- Button trigger modal -->

                   <button type="button" class="btn btn-success mr-1 " id="refresh" ><i class="fas fa-sync-alt"></i></button>
                    <button type="button" class="btn btn-success mr-1  col-2" data-toggle="modal" data-target="#modal-form">Advanced Search</button>
      
                </div>
              </div>
              <div class="row mt-4 mb-2">
                    <div class="col-md-4 ">
        
                      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                  <div class="card bg-secondary shadow border-0">
                                      <div class="card-header bg-transparent pb-3">
                                          <div class="text-muted text-center mt-2 mb-3"><small>Advanced Search</small></div>
                                      </div>
                                      <div class="card-body px-lg-5 py-lg-5">
                                          <form  id="advanced_search_form">
                                            <div class="form-row">
                                              <div class="form-group mb-3 col-6">
                                                 <label for="username">Employee Name & Surname</label>
                                                  <div class="input-group input-group-alternative ">
                                                     
                                                      <input class="form-control"id="username" name="username" placeholder="Name & Surname" type="text">
                                                  </div>
                                              </div>
                                              <div class="form-group mb-3 col-6">
                                                 <label for="function_name">Function</label>
                                                  <div class="input-group input-group-alternative">
                                                    <select class="form-control " id="function_name" name="function_name" required>
                                                     <option value="none">-none-</option>
                                                    </select>
                                                      <!-- <input class="form-control" placeholder="Password" type="select"> -->
                                                  </div>

                                              </div>
                                            </div>
                                            <div class="form-row">
                                              <div class="form-group mb-3 col-12">
                                                 <label for="data_changed">Data/Changed </label>
                                                  <div class="input-group input-group-alternative ">
                                                     
                                                      <input class="form-control"  id="data_changed" name="data_changed" placeholder="Data changed" type="text">
                                                  </div>
                                              </div>
                                            </div>
                                           <div class="form-row">
                                              <div class="form-group mb-3 col-12">
                                                 <label for="data_changed">Date </label>
                                                  <div class="input-group input-group-alternative "> 
                                                      <input class="form-control"  id="date_" name="date_"  type="date">
                                                  </div>
                                              </div>
                                            </div>

                                              <div class="text-center">
                                                  <button type="button" id="advanced_search" class="btn btn-success my-4">Search</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
      

          </div>
          <div class="table-responsive">

            <table id="myTable" class="table align-items-center table-flush">
               <thead class="thead-light">
              <tr class="header">
                
                <th> Employee Name</th>
                <th> DATE : TIME</th>
                <th> Function Used</th>
                <th> Added/Changed Data</th>
               
              </tr>
            </thead>
            <tbody id="tBody">
              <tr id="emptySearch" style="display: none;" class="table-danger mb-3">
                <td><b>No Audit Log Entry Found</b></td>
                <td></td>
                <td></td>
                <td></td>                
              </tr>
              </tbody>
            </table>
            <div class=" card-footer row">
            <div class="form-group col-10 mt-3">
              <button type="button" class="btn btn-4 btn-primary mb-3" data-toggle="modal" data-target="#modal-default" onclick="window.history.go(-1); return false;">Back</button>
            </div>
            <div class="form-group float-right col-2 mt-3">
              <a href="PHPcode/export_audit.json" class="btn btn-4 btn-warning" download>Export Audit log</a>
            </div>
          </div>
            <script>
              var indexer=0;

              function setIndexer(i){
                indexer=i;
              }


              function myFunction() 
              {
                var input, filter, table, tr, td,td3,td4, i, txtValue,txtValue3,txtValue4;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                var showCount = 0;
                //console.log(tr.length);
                for (i = 0; i < tr.length; i++) 
                {
                  td = tr[i].getElementsByTagName("td")[0];
                 
                  td4 = tr[i].getElementsByTagName("td")[2];
                  td3 = tr[i].getElementsByTagName("td")[3];

                  if (td || td3 || td4) 
                  {
                    txtValue = td.textContent || td.innerText;
                    
                    txtValue4 = td4.textContent || td4.innerText;
                    txtValue3 = td3.textContent || td3.innerText;
                    if ((txtValue.toUpperCase().indexOf(filter)> -1) ||(txtValue4.toUpperCase().indexOf(filter)> -1) || (txtValue3.toUpperCase().indexOf(filter)> -1)) 
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
    </div>
  

      <!-- Footer -->
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
  <!-- Moment JS -->
  <script src="../../assets/js/moment.js"></script>
  <script type="text/javascript" src="JS/viewAudit.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>