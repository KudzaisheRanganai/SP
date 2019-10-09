<?php
    include_once("../sessionCheckPages.php");
    include_once("PHPcode/connection.php");
    include_once("PHPcode/functions.php");
    $help="../../help/AssignCollection.html";
    $truckData=getAllTrucks($con);
    $deliveryData=getUnassignedCollections($con,1);
    $addressData=getCompleteAddressCollection($con);
    $deliveryCity=getCollectionCities($con);
    $saleData=getOrderSupplier($con);
    $saleProductData=getAllOrderProducts($con);
    $truckProductData=getTruckProductDataCollection($con);
    $deliveryTruckData=getCollectionTruckData($con);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Assign Collection - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../assets/css/hummingbird-treeview.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script> -->
    <style type="text/css">
      .directions li span.arrow {
        display:inline-block;
        min-width:28px;
        min-height:28px;
        background-position:0px;
        background-image: url("https://heremaps.github.io/maps-api-for-javascript-examples/map-with-route-from-a-to-b/img/arrows.png");
        position:relative;
        top:8px;
      }
      .directions li span.depart  {
        background-position:-28px;
      }
      .directions li span.rightUTurn  {
        background-position:-56px;
      }
      .directions li span.leftUTurn  {
        background-position:-84px;
      }
      .directions li span.rightFork  {
        background-position:-112px;
      }
      .directions li span.leftFork  {
        background-position:-140px;
      }
      .directions li span.rightMerge  {
        background-position:-112px;
      }
      .directions li span.leftMerge  {
        background-position:-140px;
      }
      .directions li span.slightRightTurn  {
        background-position:-168px;
      }
      .directions li span.slightLeftTurn{
        background-position:-196px;
      }
      .directions li span.rightTurn  {
        background-position:-224px;
      }
      .directions li span.leftTurn{
        background-position:-252px;
      }
      .directions li span.sharpRightTurn  {
        background-position:-280px;
      }
      .directions li span.sharpLeftTurn{
        background-position:-308px;
      }
      .directions li span.rightRoundaboutExit1 {
        background-position:-616px;
      }
      .directions li span.rightRoundaboutExit2 {
        background-position:-644px;
      }
      
      .directions li span.rightRoundaboutExit3 {
        background-position:-672px;
      }
      
      .directions li span.rightRoundaboutExit4 {
        background-position:-700px;
      }
      
      .directions li span.rightRoundaboutPass {
        background-position:-700px;
      }
      
      .directions li span.rightRoundaboutExit5 {
        background-position:-728px;
      }
      .directions li span.rightRoundaboutExit6 {
        background-position:-756px;
      }
      .directions li span.rightRoundaboutExit7 {
        background-position:-784px;
      }
      .directions li span.rightRoundaboutExit8 {
        background-position:-812px;
      }
      .directions li span.rightRoundaboutExit9 {
        background-position:-840px;
      }
      .directions li span.rightRoundaboutExit10 {
        background-position:-868px;
      }
      .directions li span.rightRoundaboutExit11 {
        background-position:896px;
      }
      .directions li span.rightRoundaboutExit12 {
        background-position:924px;
      }
      .directions li span.leftRoundaboutExit1  {
        background-position:-952px;
      }
      .directions li span.leftRoundaboutExit2  {
        background-position:-980px;
      }
      .directions li span.leftRoundaboutExit3  {
        background-position:-1008px;
      }
      .directions li span.leftRoundaboutExit4  {
        background-position:-1036px;
      }
      .directions li span.leftRoundaboutPass {
        background-position:1036px;
      }
      .directions li span.leftRoundaboutExit5  {
        background-position:-1064px;
      }
      .directions li span.leftRoundaboutExit6  {
        background-position:-1092px;
      }
      .directions li span.leftRoundaboutExit7  {
        background-position:-1120px;
      }
      .directions li span.leftRoundaboutExit8  {
        background-position:-1148px;
      }
      .directions li span.leftRoundaboutExit9  {
        background-position:-1176px;
      }
      .directions li span.leftRoundaboutExit10  {
        background-position:-1204px;
      }
      .directions li span.leftRoundaboutExit11  {
        background-position:-1232px;
      }
      .directions li span.leftRoundaboutExit12  {
        background-position:-1260px;
      }
      .directions li span.arrive  {
        background-position:-1288px;
      }
      .directions li span.leftRamp  {
        background-position:-392px;
      }
      .directions li span.rightRamp  {
        background-position:-420px;
      }
      .directions li span.leftExit  {
        background-position:-448px;
      }
      .directions li span.rightExit  {
        background-position:-476px;
      }
      .directions li span.ferry  {
        background-position:-1316px;
      }

      div.progress
      {
        height: 10px !important; 
        width: 12rem !important;
      }
      </style>
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
   <!-- <img src='http://i.imgur.com/pKopwXp.gif' hidden="true" id="loadImage" alt='loading...' style="display:block; margin:0 auto;" /> -->
  <div class="main-content">
    <!-- Top navbar -->
      <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
          <!-- Brand -->
          <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Assign Collection</a>
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
      <div class="row">
      
        <!-- <div class="col-xl-4 mb-3" id="accordion" >
            <div class="card bg-default">
              <div class="card-body " id="headingOne">
                <div class="row">
                  <div class="col-10">
                    <label hidden="true" id="tData"><?php echo json_encode($truckData);?></label>
                    <h4 class="mb-0 text-white text-uppercas ">My Trucks</h4> 
                </div>
              </div>
              </div>
            </div>
          </div> -->
        <!-- <div class="col-12 mb-3" >
          <div class="card">
            <div class="card-header  border-0 bg-default">
              <h3 class="mb-0 text-white">
                <i class="fas fa-truck-moving mr-2"></i>
                Trucks Available
              </h3>
            </div>
            <div class="card-body " >
              <div class="table-responsive">
                <table id="myTable" class="table align-items-center table-flush">
                  <thead class="thead-light">
                  <tr class="header bg-primary">
                    <th style="width:1rem;"></th>
                    <th> Regstration #</th>
                    <th> Name</th>
                    <th> Capacity</th>
                    <th> Status</th>
                    <th></th>
                    <th style="width:1rem;"></th>
                  </tr>
                </thead>
                <tbody id="tBody">
                  
                 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> -->
      </div>
        <div class="row">
          <div class="col-12">
            <div class="car shadow border-0">
               <!-- <div id="map">Hello</div> -->
               <div id="map" style="height: 35rem; width: 100%; top: 0px; left: 0px; background-color: rgb(229, 227, 223); border: 3px solid white"></div>
            </div>
          </div>

        </div>
        
        <div class="row mt-3">
        <div class="col-xl-7 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0 bg-primary">
              <div class="row align-items-center">
                <div class="col ">
                  <label hidden="true" id="dData"><?php echo json_encode($deliveryData);?></label>
                  <label hidden="true" id="dcData"><?php echo json_encode($deliveryCity);?></label>
                  <label hidden="true" id="aData"><?php echo json_encode($addressData);?></label>
                   <label hidden="true" id="sData"><?php echo json_encode($saleData);?></label>
                    <label hidden="true" id="spData"><?php echo json_encode($saleProductData);?></label>
                    <label hidden="true" id="tpData"><?php echo json_encode($truckProductData);?></label>
                    <label hidden="true" id="dtData"><?php echo json_encode($deliveryTruckData);?></label>
                  <h3 class="mb-0 text-white"><i class="fas fa-truck-loading mr-2"></i>Collections Pending</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Order NO#</th>
                    <th scope="col">Date</th>
                    <th scope="col">City</th>
                    
                  </tr>
                </thead>
                <tbody id="dBody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-5">
          
          <div class="card shadow">
            <div class="card-header  border-0 bg-default">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-white">
                    <i class="fas fa-truck-moving mr-2"></i>
                    <span id="selectTruckName">No Truck Selected</span>
                  </h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <div>
                <table class="table align-items-center">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Order #</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody class="list" id="tSelected">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card shadow mt-4">
            <div class="card-header  border-0 bg-primary">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-white"><i class="fas fa-truck-loading mr-2"></i><span id="assignDelHeading">Item(s)</span></h3>
                </div>
                
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Qty</th>
                    <th scope="col">Product Name</th>
            
                  </tr>
                </thead>
                <tbody id="enterProducts">
                </tbody>
                <tfoot>
                  <td></td>
                  <td>
                    <a href="#!" class="btn btn-lg btn-success py-2 float-right" id="btnAssign">
                      <i class="fas fa-plus mr-2"></i>
                      Assign
                    </a>
                  </td>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="card-shadow mt-4">
            <div class="card-header border-0 bg-warning">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-white"><i class="fas fa-lightbulb mr-2"></i><span>Suggestion</span></h3>
                </div>
              </div> 
            </div>
            <div class="card-body bg-light">
              <p id="suggestion"></p>
            </div> 
          </div>
          <button type="button" class="btn btn-info mt-4" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-directions mr-2"></i>
          Show Directions
        </button>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Route Directions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="panel"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group col-md-2 errorModal successModal text-center">
            <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                  <div class="modal-header" id="modalHeader">
                      <h6 class="modal-title" id="MHeader">Success</h6>
                  </div>
                  <div class="modal-body">
                    <p id="MMessage">Successfully Added</p>
                    
                    <div id="animation" style="text-align:center;">

                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="btnClose">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-header  border-0 bg-default">
          <h3 class="mb-0 text-white">
            <i class="fas fa-truck-moving mr-2"></i>
            Trucks Available
          </h3>
        </div>
        <div class="card-body " >
          <div class="table-responsive">
            <table id="myTable" class="table align-items-center table-flush">
              <thead class="thead-light">
              <tr class="header bg-primary">
                <th style="width:1rem;"></th>
                <th> Regstration #</th>
                <th> Name</th>
                <th> Capacity</th>
                <th> Status</th>
                <th></th>
                <th style="width:1rem;"></th>
              </tr>
            </thead>
            <tbody id="tBody">
              
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
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
 <label hidden="true" id="tData"><?php echo json_encode($truckData);?>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <!-- <script type="text/javascript" src="JS/assignTruckMap.js"></script> -->
  <script type="text/javascript" src="../../assets/js/hummingbird-treeview.js"></script>
  <script type="text/javascript" src="JS/assignCollection.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>