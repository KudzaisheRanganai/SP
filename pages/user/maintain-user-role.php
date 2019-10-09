<?php include_once("../sessionCheckPages.php");
  $help="../../help/MaintainUserRole.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Maintain User Role - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  
  <!-- Validation Stylesheet -->
  <link rel="stylesheet" href="../../assets/css/site-demos.css">

</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Maintain User Role</a>
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
      <input type="hidden" id="userRoleID" value=<?php echo $_POST["ACCESS_LEVEL_ID"];?>>
      <input type="hidden" id="oldRoleName" value=<?php echo $_POST["ACCESS_LEVEL_NAME"];?>>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">User Role Details</h3>
            </div>
            <div class="card-body">
             
              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form id="addUserRoleForm" class="needs-validation" novalidate>
                      <div class="form-row col">
                        <div class="form-group col">
                          <label for="userRoleName">User Role Name</label>
                          <!-- <input type="text" name="user-role-name" class="form-control" id="userRoleName" aria-describedby="emailHelp" value="<?php //echo $_POST['ROLE_NAME'] ?>" required> -->
                          <input type="text" name="user-role-name" class="form-control" id="userRoleName" aria-describedby="emailHelp" value=<?php echo $_POST["ACCESS_LEVEL_NAME"];?> required>
                        </div>
                      </div>
                      <div class="form-row col">
                        <div class="form-group col">
                         <label for="subFunctionalitites"l>User Role Functions
                         </label>
                         <select class="form-control select"  id="subFunctionalitites" name="sub-functionalitites[]" multiple  style="color: #8898aa" required>

                         </select>
                        </div>
                      </div>
                      <div class="form-row col">
                        <div class="col">
                          <button type="button" id="addUserRole" class="btn btn-primary mb-3">Save</button>
                        </div>
                        <div class="col float-right">
                          <button type="button"  id="deleteUserRole" class="btn btn-danger mb-3 float-right" data-toggle="modal" data-target="#dismiss">Delete</button>
                        </div>
                      </div>

                      <div class="modal fade" id="dismiss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete the selected user role?</p>
                      </div>
  
                      <div class="modal-footer">
                        
                      <button type="button" class="btn btn-success" data-dismiss="modal" id="deleteButton">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="dismissEmployeeSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-defaultDismiss">Success!</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <p id="modalTextDismiss"></p>
                            
                        </div>
                        
                        <div class="modal-footer">
                            
                            <button type="button"  id="btnCloseDismiss" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="">Close</button> 
                        </div>
                        
                    </div>
                </div>
              </div>

                      <div class="form-group col-md-2">
                          <div class="modal fade errorModal successModal text-center" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
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
                                          <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"id="modalCloseButton" onclick="">Close</button> 
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>


                        

                    </form>
                  </div>
                        
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

  
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
    <!-- Validation JS -->
  <script src="../../assets/js/jquery.validate.min.js"></script>
  <script src="../../assets/js/additional-methods.min.js"></script>
  <!-- Bootstrap Multiselect -->
  <script src="../../assets/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="../../assets/css/bootstrap-multiselect.css" />
  <!-- Add Product JS -->
  <script src="JS/maintainUserRole.js"></script>
  <script src="JS/deleteUserRole-JS.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>