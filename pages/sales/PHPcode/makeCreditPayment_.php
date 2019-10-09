<?php
	include_once("../../sessionCheckPages.php");
	include_once("functions.php");

	$saleID = "";

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
	  $response = "database Error";
	  echo $response;
	}
	else
	{
		// Retrieve product details from $_POST
		$saleID = mysqli_real_escape_string($DBConnect, $_POST['saleID']);
		$customerID = mysqli_real_escape_string($DBConnect, $_POST['customerID']);
		$saleTotal = mysqli_real_escape_string($DBConnect, $_POST['saleTotalAmount']);

		//echo json_encode($saleProducts);

		//UPDATE AVAILABLE QUANTITY
		$queryUpdateSaleStatus = "UPDATE SALE SET SALE_STATUS_ID = 2 WHERE SALE_ID = $saleID";
		mysqli_query($DBConnect, $queryUpdateSaleStatus);

		$queryUpdateBalance = "UPDATE CUSTOMER_ACCOUNT SET BALANCE = BALANCE + $saleTotal WHERE CUSTOMER_ID = $customerID";
		mysqli_query($DBConnect, $queryUpdateBalance);

		$dte=Date('Y-m-d');
		if(recordPayment($DBConnect,$saleID,$_POST["saleTotalAmount"],$dte,2))
		{
			$DateAudit = date('Y-m-d H:i:s');
			$Functionality_ID='7.5';
			$userID = $_SESSION['userID'];
			$changes="Sale ID : ".$saleID;
		    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
		    $audit_result=mysqli_query($DBConnect,$audit_query);
			$response = "success";
			echo $response;
		}


		//Close database connection
		mysqli_close($DBConnect);

	}
?>