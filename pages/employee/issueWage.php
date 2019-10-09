<?php include_once("../sessionCheckPages.php");
  $help="../../help/CollectWage.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Issue Employee Wage- Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">

  
 <!-- Link scanning library -->
 <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>	
</head>

<body>
<?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Employee Wage Issue</a>
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
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Issue Employee Wage</h3>
            </div>
            <div class="card-body ">

              <div class="row d-flex justify-content-center">
                
                  <style>
                  #qrscan {
                  
                    width: 400px;
                    height: 400px;
                    background-image:url("../../assets/img/brand/qr.png");
                    background-size: 400px;
                  }
                  #videoElement {
                    width: 500px;
                    height: 400px;
                    
                  }
                  </style>
              
                  <div id="qrscan"  class="embed-responsive embed-responsive-16by9">
                    <video autoplay="true" id="videoElement" class="embed-responsive-item">

                    
                    </video>
                  </div>
                  <script>
                    /* var video = document.querySelector("#videoElement");

                      if (navigator.mediaDevices.getUserMedia) {
                        navigator.mediaDevices.getUserMedia({ video: true })
                          .then(function (stream) {
                            video.srcObject = stream;
                          })
                          .catch(function (err0r) {
                            console.log("Something went wrong!");
                          });
                      }*/



                  let scanner = new Instascan.Scanner(
                      {
                        video: document.getElementById('videoElement')
                      }
                  );

                  scanner.addListener('scan', function(content) {

                    $("#scanQr").click(function(e) {

                      e.preventDefault();
                      console.log(content);
                  let savedID = content;
                  $.ajax({
                  type: 'POST',
                  url: 'PHPcode/collect_wage_scanner.php',
                  data: {qrCode : content},
                  beforeSend:()=>
                              {
                                  
                              }
                  })
                  .done(data => {
                  // do something with data
                          console.log(data);
                          let confirmation = data.trim();
                         
                          if(confirmation.includes("success"))
                          {
                              //Add this when fully done.
                              
                            
                                $('#modal-title-default').text("Success!");
                                $('#modalText').text("Employee found , wage will be calculated on next screen...");
                                $('#scannerSearch').modal("show");

                                $("#successSearch").click(function(e) {

                                    e.preventDefault();
                                   
                                    window.location=`wage_calc.php?employeeID='${savedID}'`;
                                });
                               /* setTimeout(function(){redirect()},10000);
                              
                              function redirect()
                              {
                                // go do that thing
                                  
                               
                              }*/


                              // alert('The scanned content is: ' + content);
                             // window.open(content, "_blank");

                          }
                          else if(confirmation != "success")
                          {
                            $('#modal-title-default').text("Error!");
                            $('#modalText').text(confirmation);
                            $('#scannerSearch').modal("show");
                          }
                      })
                      .fail(()=>
                          {
                              console.log("ajax failed");
                          });

                          
              });
                    });
                


              Instascan.Camera.getCameras().then(cameras => 
              {
                  if(cameras.length > 0){
                      scanner.start(cameras[0]);
                  } else {
                      console.error("No Camera Device");
                  }
              });


                  </script>
                
              </div>
              <div class="row icon-examples d-flex justify-content-center">
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard" id="scanQr" >
                    <div>
                      <i class="fas fa-qrcode"></i></i>
                      <span>Scan Employee QR</span>
                    </div>
                  </button>

                        <div class="modal fade" id="scannerSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modal-title-default"></h5>
                              </div>
                              <div class="modal-body">
                                <p id="modalText"></p>
                              </div>
                              <div class="modal-footer">
                                
                                
                              <button type="button" class="btn btn-secondary" id="successSearch" data-dismiss="modal" >Close</button>
                          
                          </div>
                        </div>
                      </div>
                  </div>

                </div>
              </div>
              <div class="row icon-examples d-flex justify-content-center">
                <div class="col-lg-4 col-md-6">
                  <button type="button" class="btn-icon-clipboard" onclick="window.location='search.php?wage_collect=1'">
                    <div>
                      <i class="fa fa-search"></i>
                      <span>Search Employee</span>
                    </div>
                  </button>
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
  <script src="../InactivityLogoutPages/autologout.js"></script>
  <!-- Argon JS -->
  <!--script src="../../assets/js/argon.js?v=1.0.0"></script-->
</body>

</html>