<?php include_once("../sessionCheckPages.php");
  $help="../../help/EmployeeSubsystem.html";
?>
<?php
  

  $employeeID;
  $name; 
  $surname; 
  $contactNumber;
  $email;
  $identityNo;
  $titleName;
  $employeeStatus;
  $zipCode;
  $addressInfo;
  $suburbInfo;
  $cityInfo;
  $employeeType;
  $titleInfo;
  $addressInfoLine1;
  $suburbName;
  $addressID;
  $suburbID;
  $employeeTypeID;
  $cityID;
  $titleID;
  $employeeStatus;
  $wage_earner = false;
  if(isset($_GET["employeeID"]))
  {
    //include_once("PHPcode/connection.php");
    //include_once("PHPcode/functions.php");
    include_once("PHPcode/DBConnection.php");
    
    if($DBConnect === false)
    {
    die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else
    {
    
                $employeeID = $_GET["employeeID"];
               
       
    
    
       
                $sql = "SELECT * FROM EMPLOYEE WHERE (EMPLOYEE_ID=$employeeID)";
                $query_QR = mysqli_query($DBConnect , $sql);
               
                $rowsQuery = mysqli_fetch_assoc($query_QR);
                $success = "success";
                if($query_QR)
                {
                  if($rowsQuery)
                  {
                    $employeeID = $rowsQuery["EMPLOYEE_ID"];
                    $name = $rowsQuery["NAME"];
                    $surname =  $rowsQuery["SURNAME"];
                    $contactNumber = $rowsQuery["CONTACT_NUMBER"];
                    $email = $rowsQuery["EMAIL"];
                    $identityNo = $rowsQuery["IDENTITY_NUMBER"];
                    $addressID = $rowsQuery["ADDRESS_ID"];
                    $employeeTypeID = $rowsQuery["EMPLOYEE_TYPE_ID"];



                    $titleID = $rowsQuery["TITLE_ID"];
                    $employeeStatus = $rowsQuery["EMPLOYEE_STATUS_ID"];
                  }
                  else
                  {
                    echo "Fetched Array is not working";
                  }
                 


                
                }
                else
                {
                    echo "not found";
                }



                $Wagesql = "SELECT EMPLOYEE_TYPE.WAGE_EARNING FROM EMPLOYEE
                INNER JOIN EMPLOYEE_TYPE
                ON EMPLOYEE.EMPLOYEE_TYPE_ID = EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID
                 WHERE (EMPLOYEE_ID='$employeeID')";
                $Wagequery_QR = mysqli_query($DBConnect , $Wagesql);
            
            
            
            
            
            if(mysqli_num_rows($Wagequery_QR)>0)
                {
                    if($Wagerow = mysqli_fetch_assoc($Wagequery_QR))
                    {
                        if($Wagerow["WAGE_EARNING"] == 1)
                        {
                          $wage_earner = true;
                        }
                        else
                        {
                          $wage_earner = false;
                        }
                    }
                }
                mysqli_close($DBConnect);
            
               
    }




   
    //getting the address stuff

    include_once("PHPcode/connection.php");
    include_once("PHPcode/functions.php");



    $addressInfo=getAddressInfo($con,$addressID);
    $suburbInfo=getSuburbInfo($con,$addressInfo["SUBURB_ID"]);
    $cityInfo=getCityInfo($con,$suburbInfo["CITY_ID"]);
    $employeeType=getEmployeeType($con,$employeeTypeID);
    $titleInfo=getTitleInfo($con,$titleID);
    mysqli_close($con);
    

    $titleName = $titleInfo["TITLE_NAME"];
    $zipCode = $suburbInfo["ZIPCODE"];
    $employeeTypeName = $employeeType["NAME"];
    $addressInfoLine1 = $addressInfo["ADDRESS_LINE_1"];
    $suburbName = $suburbInfo["NAME"];
    $cityName = $cityInfo["CITY_NAME"];
    
  }
  else
  {
    include_once("PHPcode/connection.php");
    include_once("PHPcode/functions.php");
    $addressInfo=getAddressInfo($con,$_POST["ADDRESS_ID"]);
    $suburbInfo=getSuburbInfo($con,$addressInfo["SUBURB_ID"]);
    $cityInfo=getCityInfo($con,$suburbInfo["CITY_ID"]);
    $employeeType=getEmployeeType($con,$_POST["EMPLOYEE_TYPE_ID"]);
    $titleInfo=getTitleInfo($con,$_POST["TITLE_ID"]);
    


    $employeeID = $_POST["EMPLOYEE_ID"];  

    $Wagesql = "SELECT EMPLOYEE_TYPE.WAGE_EARNING FROM EMPLOYEE
    INNER JOIN EMPLOYEE_TYPE
    ON EMPLOYEE.EMPLOYEE_TYPE_ID = EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID
     WHERE (EMPLOYEE_ID='$employeeID')";
    $Wagequery_QR = mysqli_query($con, $Wagesql);





if(mysqli_num_rows($Wagequery_QR)>0)
    {
        if($Wagerow = mysqli_fetch_assoc($Wagequery_QR))
        {
            if($Wagerow["WAGE_EARNING"] == 1)
            {
              $wage_earner = true;
            }
            else
            {
              $wage_earner = false;
            }
        }
    }


    mysqli_close($con);



    //Initialise variables
    $name = $_POST["NAME"]; 
    $surname = $_POST["SURNAME"]; 
    $contactNumber = $_POST["CONTACT_NUMBER"]; 
    $email = $_POST["EMAIL"]; 
    $identityNo = $_POST["IDENTITY_NUMBER"];
    $titleName = $titleInfo["TITLE_NAME"];
    $employeeStatus = $_POST["EMPLOYEE_STATUS_ID"];
    $zipCode = $suburbInfo["ZIPCODE"];
    $employeeTypeName = $employeeType["NAME"];
    $addressInfoLine1 = $addressInfo["ADDRESS_LINE_1"];
    $suburbName = $suburbInfo["NAME"];
    $cityName = $cityInfo["CITY_NAME"];

    

  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Employee Profile - Stock Path</title>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Employee</a>
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
    <div class="container-fluid mt--7 ">
      <!-- Table -->
      <div class="row">
        <div class="col d-flex justify-content-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8 order-xl-2 mb-4 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col">
                <div class="card-profile-image">
                  <a>
                <?php

                //Pic to be inserted here.
                        $dir = "images/ProfilePic/" . $employeeID. ".jpg";
                       
                        if(file_exists($dir))
                        {
                            
                            echo '<img src="' . $dir . '" class="rounded-circle" alt="person" style="width: 180px; height: 180px; border: 5px solid white;">';
                           
                        }
                        else
                        {
                         
                          echo '<img src="../../images/user.png" class="rounded-circle" alt="person" style="width: 180px; height: 180px; border: 2px solid white;">';
                            
                        }
                ?>   
                    <!--img src="../../images/user.png" class="rounded-circle"-->
                  </a>
                </div>
              </div>
            </div>


            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="card-body pt-0 pt-md-4 mt-6">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mb-0">
                  </div>
                </div>
              </div>
              <div class="text-center mt-0">
                <h2>
                  <?php echo $titleName." ".$name." ".$surname; ?>
                </h2>
                  <div class="row mb-2" id="ShowDiv">
                    <div class="col d-inline mx-0 px-0">
                      <form action='' method="POST" id="addUserView">
                        <input type="hidden" name="ID" value=<?php echo $employeeID;?>>
                        <input type="hidden" name="wageEarner" id="wager" value=<?php echo $wage_earner;?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $email;?>>

                        <button class="btn btn-icon btn-2 btn-default btn-sm px-2" type="button" id="wageCalc" style="width: 10rem">
                            <span class="btn-inner--icon"><i class="far fa-money-bill-alt"></i>
                            </span>
                            <span class="btn-inner--text">Calculate Wage</span>
                        </button>
                      </form>
                    </div> 
                    <div class="col d-inline mx-0 px-0">
                      <form action='' method="POST" id="addUserView">
                        <input type="hidden" name="ID" value=<?php echo $employeeID;?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $email;?>>

                        <button class="btn btn-icon btn-2 btn-warning btn-sm px-2" type="button" id="checkIn" style="width: 7rem">
                            <span class="btn-inner--icon"><i class="far fa-check-square"></i>
                            </span>
                            <span class="btn-inner--text">Check-in</span>
                        </button>
                      </form>
                    </div> 
                    <div class="col d-inline mx-0 px-0">
                      <form action='' method="POST" id="addUserView">
                        <input type="hidden" name="ID" value=<?php echo $employeeID;?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $email;?>>

                        <button class="btn btn-icon btn-2 btn-warning btn-sm px-2" type="button" id="checkOUT" style="width: 7rem">
                            <span class="btn-inner--icon"><i class="fas fa-check-double"></i>
                            </span>
                            <span class="btn-inner--text">Checkout</span>
                        </button>
                      </form>
                    </div>
                    <div class="col d-inline mx-0 px-0">
                      <button class="btn btn-sm btn-icon btn-default" type="button" data-toggle="modal" data-target="#del" style="width: 10rem">
                        <span class="btn-inner--icon"><i class="fas fa-id-card"></i>
                        </span>
                        <span class="btn-inner--text">Re-generate Tag</span>
                      </button>
                    </div>
                  </div>
                </div>
                <hr class="h5 font-weight-300 pb-0 mt-3">
                   <div class="pt-2"><b>Employee ID : </b><p class="d-inline" id="employee_ID"><?php echo $employeeID;?></p></div>
                   <div class="pt-2">
                      <b>Employee Type : </b>
                      <p class="d-inline" id="eEmployeeTypeName"><?php echo $employeeTypeName;?></p>
                   </div>                 
                </hr>
                <hr class="h5 font-weight-300 pb-0 mt-3">

                  <div class="pt-2"><b>ID Number : </b><p class="d-inline"><?php echo $identityNo;?></p></div>

                  <div class="pt-2"><b>Email : </b><p class="d-inline"><?php echo $email;?></p></div>
                  
                  <div class="pt-3"><b>Contact Number : </b><p class="d-inline"><?php echo $contactNumber ?></p></div>
                </hr>
                <?php 
                
                $address = $addressInfoLine1;
                ?>
                <hr class="h5 font-weight-300 pb-0 mt-3 pt-0">
                  <i class="ni location_pin mr-2 text-center"></i>
                  <h3 class="text-center pt-0 mt-0"><b>Address :</b></h3>
                  <p class="mb-0" id="AddressMan"><?php echo $addressInfoLine1;?></p>
                  <p class="mb-0" id="eSuburb"><?php echo $suburbName.", ".$cityName.", ".$zipCode;?></p>
                  <p class="mb-0">South Africa</p>
                </div>
                <hr class="my-2 d-flex justify-content-center">
                  <div class="row mb-2">
                    <div class="col d-inline mx-0 px-0">
                      <form id="formMaintain" action="maintain.php" method="POST">
                        <input type="hidden" name="ID" value=<?php echo $employeeID;?>>
                        <input type="hidden" name="NAME" id="NAME" value=<?php echo $name;?>>
                        <input type="hidden" name="SURNAME" value=<?php echo $surname;?>>
                        <input type="hidden" name="CONTACT_NUMBER" value=<?php echo $contactNumber;?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $email;?>>
                         <input type="hidden" name="IDENTITY_NUMBER" value=<?php echo $identityNo;?>>
                        <input type="hidden" name="TITLE_NAME" value=<?php echo $titleName;?>>
                        <input type="hidden" id="EMPLOYEE_TYPE_NAME" name="EMPLOYEE_TYPE_NAME">
                        <input type="hidden" name="EMPLOYEE_STATUS_ID" value=<?php echo $employeeStatus;?>>
                        <input type="hidden" name="ADDR" id="ADDR" value="<?php echo $address?>">
                        <input type="hidden" name="SUBURB" id="SUBURB" value=<?php echo $suburbName;?>>
                        <input type="hidden" name="CITY" id="CITY" value=<?php echo $cityName;?>>
                        <input type="hidden" name="ZIP" value=<?php echo $zipCode;?>>
                        <button class="btn btn-icon btn-2 btn-primary btn-sm px-3" type="submit" style="width: 7rem">
                          <span class="btn-inner--icon"><i class="fas fa-wrench"></i>
                          </span>
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </form>
                    </div>
                    <div class="col d-inline mx-0 px-0">
                      <form action='../user/add-user.php' method="POST" id="addUserView">
                        <input type="hidden" name="ID" value=<?php echo $employeeID;?>>
                        <input type="hidden" name="EMAIL" value=<?php echo $email;?>>

                        <button class="btn btn-icon btn-2 btn-success btn-sm px-2" type="submit" style="width: 7rem">
                            <span class="btn-inner--icon"><i class="fas fa-user-plus"></i>
                            </span>
                            <span class="btn-inner--text">Add User</span>
                        </button>
                      </form>
                    </div> 
                    <div class="col d-inline mx-0 px-0">
                      <button class="btn btn-icon btn-danger btn-sm" type="button" data-toggle="modal" data-target="#dismiss" style="width: 7rem">
                        <span class="btn-inner--icon"><i class="fas fa-trash"></i>
                        </span>
                        <span class="btn-inner--text">Delete</span>
                      </button>
                    </div> 
                  </div>
                </hr>
                <hr class="my-2 d-flex justify-content-center">
                  <div class="d-flex justify-content-center">
                     <button type="button" class="btn btn-link mx-auto" data-dismiss="modal"  onclick="window.history.go(-1); return false;">Close</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
          </div>
          <div class="modal fade errorModal successModal text-center" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header" id="modalHeader">
                                <h6 class="modal-title" id="modal-title-default">Success!</h6>
                               
                            </div>      
                            <div class="modal-body text-center">
                                <p id="modalText"></p>
                                  <div id="animation" style="text-align:center;">

                                  </div>                             
                            </div>
                            <div class="modal-footer">  
                                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"id="btnClose" onclick="">Close</button> 
                            </div>
                        </div>
                    </div>
                  </div>

                <div class="modal fade " id="dismiss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to dismiss the selected employee?</p>
                      </div>
                      <div class="modal-body text-left">
                        <div class="col mb-4">
                          <label for="c2">Reason for dismissal</label>
                          <div class="input-group"> 
                            <input type="text" value=""  class="form-control" placeholder="Breach of contract" id="reasonOFDismissal" autofocus />
                            <input type="hidden"  class="form-control " id="EMPLOYEE_ID" value=<?php echo $employeeID;?> />
                          </div> 
                        </div>
                      </div>
  
                      <div class="modal-footer">
                        
                      <button type="button" class="btn btn-success" data-dismiss="modal" id="deleteButton">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade " id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body text-left">
                      <p>Are you sure you want to generate a new employee tag for the selected employee?</p>
                    </div>
                    <div class="modal-footer">   
                      <button type="button" class="btn btn-success" id="btnClick" data-dismiss="modal" >Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade errorModal successModal text-center" id="dismissEmployeeSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    <div class="modal-header" id="modalHeader">
                      <h6 class="modal-title" id="modal-title-defaultDismiss">Success!</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body text-center">
                      <p id="modalTextDismiss"></p>
                        <div id="animation" style="text-align:center;">

                        </div>
                        
                    </div>
                    <div class="modal-footer">                       
                      <button type="button"  id="btnCloseDismiss" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="">Close</button> 
                    </div>
                  </div>
                </div>
              </div>
        

  

      <?php include_once("../footer.php");?>
      </div>
      </div>
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
  <script type="text/javascript" src="JS/viewEmployee.js"></script>
  <script type="text/javascript" src= "JS/dismissEmployee.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>