<?php
 include_once("../../sessionCheckLanding.php");
 $help="../../help/CollectWage.html";
 
include_once("PHPcode/DBConnection.php");

if($DBConnect === false)
{
die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{

  $employee_ID = $_GET["employeeID"];
  //echo $employee_ID;
           
   

if(isset($employee_ID))//check if session has userID too when you get userID
{


  $today = mktime(
    date("H"), date("i"), date("s"), date("m") ,date("d"), date("Y")
    );
    $TodaysDate = date("Y-m-d H:i:s",$today);
    $newDate = new DateTime($TodaysDate);
    $newDate =  $newDate->format("Y-m-d");



$endDate=mktime(
    date("H"), date("i"), date("s"), date("m") ,date("d")-6, date("Y")
    );
    $previousDate = date("Y-m-d H:i:s",$endDate);
    $usedDate = new DateTime($previousDate);
    $usedDate =  $usedDate->format("Y-m-d");


           
  $sql = "SELECT * FROM EMPLOYEE WHERE (EMPLOYEE_ID=$employee_ID)";
  $query_QR = mysqli_query($DBConnect , $sql);

  $wageQuery = "SELECT WAGE_ID FROM WAGE WHERE (EMPLOYEE_ID=$employee_ID)";
  $submitwageQuery = mysqli_query($DBConnect , $wageQuery);

  //for employee , who is receiving wage , wage ID
  $queryFilter = mysqli_fetch_assoc($submitwageQuery);
  
  //for employee , who is receiving wage , employee ID
  $rows = mysqli_fetch_assoc($query_QR);


    
  ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Collect Wage - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Collect Wage</a>
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
              <h3 class="mb-0">Wage Details</h3>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-6">
                  <div class="card card-stats" id="myTabContent" >
                    <div class="card-header" style="background-color: #81b69d">
                        <h5 class="card-title mb-0"> Employee Details</h5>
                    </div>
                    <div class="card-body px-3">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Employee ID
                              </th>
                              <td >
                                  <?php echo $rows["EMPLOYEE_ID"];?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Name
                              </th>
                              <td >
                              <?php echo $rows["NAME"];?>
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                  Surname
                              </th>
                              <td >
                              <?php echo $rows["SURNAME"];?>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Contact No
                              </th>
                              <td >
                              <?php echo $rows["CONTACT_NUMBER"];?>
                              </td>
                            </tr>
                            <tr>
                              <div class="mx-2">
                                <div class="input-group input-group-rounded input-group-merge mx-2">
                                  
              
                                </div>
                            </div>
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
                              <?php $date = date("Y-m-d");
                                      echo $date;?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                Employee Wage ID #
                              </th>
                              <td >
                                <?php echo $queryFilter["WAGE_ID"];?>
                              </td>
                            </tr> 
                            <tr>
                              <th>
                                Bookeeper
                              </th>
                              <td >
                                <?php echo  $_SESSION['name'];?>
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
                  <div class="card-header border-0">
                  <form>
                      <div class="col-4"> 
                        <div class="input-group">
                          <label class="mt-2 mr-3">Wage Rate Per Hour</label>
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">R</span>
                          </div>
                         
                          <input type="hidden" min="0" step="100" data-number-to-fixed="2" value=<?php echo $employee_ID;?> class="form-control currency" id="employee_ID" autofocus />
                              <input type="number" value="" min="0" step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="payRate" autofocus />
                              
     
                        </div>
                    </div> 
                        <!--button class="btn btn-icon btn-2 btn-success mt-3" type="submit" id="submitRate">
                                    <span>Set Pay Rate</span>
                          </button-->
                  </form>
                  </div>
                  <?php
                  $getTimes = "SELECT * FROM EMPLOYEE_HOUR WHERE (EMPLOYEE_ID=$employee_ID && DATE BETWEEN '$usedDate' AND  '$newDate')";
                  $executeTimes =mysqli_query($DBConnect , $getTimes);
                  //var_dump($getTimes);
                  $count= 0;
                   
                  ?>
                  
                <div class="table-responsive">

                  <table id="myTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th class="text-centre">Date</th>
                      <th> Time In</th>
                      <th> Time Out</th>
                      <th> Hours Worked</th>
                      <th class="text-right"> Total Pay </th>
                    </tr>
                  </thead>
                  <tbody id='wagesBody'>
                  <?php  
                  $count=0;
                  while($wageArray = mysqli_fetch_assoc($executeTimes))
                    {

                      $justdate = new DateTime($wageArray['DATE']);
                      $justdate = $justdate->format("Y-m-d");

                      $checkInTime = new DateTime($wageArray['CHECK_IN_TIME']);
                      $checkInTime = $checkInTime->format("H:i:s");

                      $checkOutTime = new DateTime($wageArray['CHECK_OUT_TIME']);
                      $checkOutTime = $checkOutTime->format("H:i:s");

                      $first_date = new DateTime($wageArray['CHECK_IN_TIME']);
                      $second_date = new DateTime($wageArray['CHECK_OUT_TIME']);
                      $interval = $first_date->diff($second_date);


                      
                      
                      

                    echo "<tr id='rows'>
                        <td>".$justdate ."</td>
                        <td id='checkInTime'>". $checkInTime ." </td>
                        <td id='cehckOutTime'>". $checkOutTime ." </td>
                        <td id='EHourWorked".$count."'></td>
                        <td class='text-right' id='RateMoney".$count."'>...</td>
                      </tr>";
                      $count =$count +1;

                    }
                   ?>
                  </tbody>
                  <tfoot class="tfoot-light">
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>TOTAL</b></th>
                      <td class="text-right" id="totalAmountPayable"></td>
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
            <br>

              <div class="col mt-4">
                <button class="btn btn-icon btn-2 btn-success mt-0"  id="submitWagePayment" type="button" >
                  <span class="btn-inner--text">Finalise Wage Collection</span>
                </button>
              </div>
              <div class="modal fade errorModal successModal text-center" id="finaliseWage" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      
                        <div class="modal-header" id="modalHeader">
                            <h6 class="modal-title" id="modal-title-default">Success!</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body text-left">
                          <p id="modalText"></p>
                            <div id="animation" style="text-align:center;">

                                  </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="closeWage">Close</button> 
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

<?php
}
  mysqli_close($DBConnect);
}
?>


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
  <script src="JS/calculateWage.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>
?>