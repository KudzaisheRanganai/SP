<?php
  session_start();

  include_once("DBConnection.php");

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