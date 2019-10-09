<?php
  $employeeID;
  if(isset($_GET["employeeID"]))
  {
      $employeeID = $_GET["employeeID"];
     // $employeeID = intval($employeeID)
      //var_dump($employeeID);
  }

  $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');

  $DBConnect = mysqli_connect($hostname, $username, $password, $database);

  if($DBConnect === false)
  {
    //Send error response
      $response = "databaseError";
        echo $response;
  }
  else
  {
    $sql_query = "SELECT B.TITLE_NAME, A.NAME, A.SURNAME, A.EMPLOYEE_ID, C.NAME AS EMPLOYEE_TYPE_NAME
      FROM EMPLOYEE A
      JOIN TITLE B ON A.TITLE_ID = B.TITLE_ID
      JOIN EMPLOYEE_TYPE C ON A.EMPLOYEE_TYPE_ID = C.EMPLOYEE_TYPE_ID 
      WHERE EMPLOYEE_ID = '$employeeID'";

    $result = mysqli_query($DBConnect,$sql_query);
    $employeeDetails = $result->fetch_assoc();

    mysqli_close($DBConnect);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Employee Tag - Stock Path</title>
  <link type="text/css" href="employeeTag/employee-tag.css" rel="stylesheet" >
  <!-- Favicon -->
  <link href="../../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
</head>
<body>
  <div class="card">
    <header>
      <div class="logo">
          <img id="qrcodeImg" src="employeeTag/GreensLogo.png" style="height: 50px; width: auto;">
      </div>
    </header>
    <div class="announcement">
      <div class="details">
        <h3><?php echo $employeeDetails["NAME"]." ".$employeeDetails["SURNAME"]; ?></h3>
        <h5><?php echo $employeeDetails["EMPLOYEE_TYPE_NAME"] ; ?></h5>
      </div>
      <div class="qr">
        <img src="userQr/<?php echo $employeeID; ?>.png"  alt="QR code" style="height: 150px; width: auto;">
    </div>
    <div class="stockpath">
        <img src="employeeTag/stockpath.png" style="height: 40px; width: auto;">
    </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
  //window.print();
</script>







