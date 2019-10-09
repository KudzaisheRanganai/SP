<?php
  session_start();

  $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $DBConnect = mysqli_connect($hostname, $username, $password, $database);

    $userID=$_SESSION['userID'];
	$DateAudit = date('Y-m-d H:i:s');
	$Functionality_ID='3.6';
	$changes="ID : ".$userID.". Logout due to inactivity";
	$audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";


	$audit_result=mysqli_query($DBConnect,$audit_query);
  $_SESSION = array(); 
  session_destroy();

  header("location: ../../../index.php");
  exit;
?>