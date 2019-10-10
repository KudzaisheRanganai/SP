<?php include_once("../sessionCheckPages.php");
  $help="../../help/Introduction.html"
?>
<?php

  include_once("DBConnection.php");
  
  if($DBConnect === false)
  {
    //Send error response
      $response = "databaseError";
        echo $response;
  }
  else
  {
    $employeeID = $_SESSION['employeeID'];
    $sql_query = "SELECT B.TITLE_NAME, A.NAME AS FIRST_NAME, A.SURNAME, A.EMPLOYEE_ID, C.NAME AS EMPLOYEE_TYPE, A.IDENTITY_NUMBER, A.EMAIL, A.CONTACT_NUMBER, D.ADDRESS_LINE_1, E.NAME AS SUBURB_NAME, F.CITY_NAME, E.ZIPCODE
    FROM EMPLOYEE A
    JOIN TITLE B ON A.TITLE_ID = B.TITLE_ID
    JOIN EMPLOYEE_TYPE C ON A.EMPLOYEE_TYPE_ID = C.EMPLOYEE_TYPE_ID 
    JOIN ADDRESS D ON A.ADDRESS_ID = D.ADDRESS_ID 
    JOIN SUBURB E ON D.SUBURB_ID = E.SUBURB_ID
    JOIN CITY F ON E.CITY_ID = F.CITY_ID
    WHERE EMPLOYEE_ID = '$employeeID'";

    $result = mysqli_query($DBConnect,$sql_query);
    $myProfileDetails = $result->fetch_assoc();

    mysqli_close($DBConnect);
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Profile - Stock Path</title>
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

<body >
  <?php include_once("../header.php");?>
  <!-- Main content -->
  <div class="main-content ">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid ">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../../index.html">My Profile</a>

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
    <div class="container-fluid mt--7 "  id="details">
      <!-- Table -->
      <div class="row">
        <div class="col d-flex justify-content-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
              <div class="row justify-content-center">
                <div class="col ">
                  <div class="card-profile-image">
                    <a>
                      <img alt="Image placeholder" class="rounded-circle" src="../employee/images/ProfilePic/<?php echo $_SESSION["employeeID"]?>.jpg" onerror="this.onerror=null;this.src='../../images/user.png';this.style.border = '2px';" style="width: 180px; height: 180px; border: 5px solid white;">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 mt-4 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                  <td>

                  </td>
                </div>
              </div>
              <div class="card-body pt-0 pt-md-4">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-2 mb-0">
                    </div>
                  </div>
                </div>
                <div class="text-center mt-2">
                  <h2 id="userFullName">
                    <?php echo $myProfileDetails["TITLE_NAME"]." ".$myProfileDetails["FIRST_NAME"]." ".$myProfileDetails["SURNAME"]; ?>
                  </h2>
                  <hr class="h5 font-weight-300 py-1 mt-3 ">
                     <div class="pt-2">
                      <b>Employee ID : </b>
                      <p class="d-inline" id="myEmployeeID"><?php echo $myProfileDetails["EMPLOYEE_ID"]; ?></p>
                     </div>
                     <div class="pt-2" >
                      <b>Employee Type : </b>
                      <p class="d-inline" id="myEmployeeType">
                        <?php echo $myProfileDetails["EMPLOYEE_TYPE"]; ?>
                      </p>
                    </div>                 
                  </hr>
                  <hr class="h5 font-weight-300 pb-0 mt-3">
                    <div class="pt-2">
                      <b>ID Number : </b>
                      <p class="d-inline" id="myIDNumber">
                        <?php echo $myProfileDetails["IDENTITY_NUMBER"]; ?>
                      </p>
                    </div>
                    <div class="pt-2">
                      <b>Email : </b>
                      <p class="d-inline" id="myEmail">
                        <?php echo $myProfileDetails["EMAIL"]; ?>
                      </p>
                    </div>
                    <div class="pt-3">
                      <b>Contact Number : </b>
                      <p class="d-inline" id="myContactNumber">
                        <?php echo $myProfileDetails["CONTACT_NUMBER"]; ?>
                      </p>
                    </div>
                  </hr>
                  <hr class="h5 font-weight-300 pb-1 mt-3">
                    <i class="ni location_pin mr-2 text-center"></i>
                    <h3 class="text-center pt-0 mt-0"><b>Address :</b></h3>
                    <p class="mb-0" id="myAddressLine1">
                      <?php echo $myProfileDetails["ADDRESS_LINE_1"]; ?>
                    </p>
                    <p class="mb-0" id="mySuburbCityZipcode">
                      <?php echo $myProfileDetails["SUBURB_NAME"].", ".$myProfileDetails["CITY_NAME"].", ".$myProfileDetails["ZIPCODE"]; ?>
                    </p>
                    <p class="mb-0">South Africa</p>
                  </hr>
                  <hr class="my-2 d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                       <button type="button" class="btn btn-link mx-auto" data-dismiss="modal"  onclick="window.history.go(-1); return false;">Close</button>
                    </div>
                  </hr>
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

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>