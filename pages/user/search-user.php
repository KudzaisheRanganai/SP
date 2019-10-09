<?php include_once("../sessionCheckPages.php");
  $help="../../help/SearchUser.html";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Search User - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Search User</a>
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
               <div class="input-group input-group-rounded input-group-merge">
                 
                 <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by employee name or surname or access level" title="Type in a name" class="form-control form-control-rounded form-control-prepended" aria-label="Search">
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
                <th>User ID</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Access Level</th>
                <th style="width:1rem;"></th>
              </tr>
            </thead>
            <tbody id="tBody">
              <tr id="emptySearch" style="display: none;" class="table-danger mb-3">
                <td><b>No User Found</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
            <div class="form-group col-md-2 mt-3">
              <button type="button" class="btn btn-block btn-primary mb-3" data-toggle="modal" data-target="#modal-default" onclick="window.history.go(-1); return false;">Back</button>
            </div>

            <script>
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
                  td = tr[i].getElementsByTagName("td")[2];
                 
                  td4 = tr[i].getElementsByTagName("td")[4];
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
  <script src="JS/searchUser.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>