<?php
	include_once("../../sessionCheckPages.php");
	$url = 'mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';
	
	$dbparts = parse_url($url);
	$hostname = $dbparts['host'];
	$username = $dbparts['user'];
	$password = $dbparts['pass'];
	$database = ltrim($dbparts['path'],'/');

	$con = mysqli_connect($hostname, $username, $password, $database);

	//Check connection
		
		if (!$con) {
		  die("Connection failed: " . mysqli_connect_error());
		}
		$customerID = $_POST["ID"];




		$update_query="DELETE FROM CUSTOMER WHERE CUSTOMER_ID='$customerID'";
		if(mysqli_query($con,$update_query)){

			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.4';
		    $changes="ID : ".$customerID;
		    $userID = $_SESSION['userID'];
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
			echo "success";
		}
		else
		{
			echo "failed";
		}	

		mysqli_close($con);

?>