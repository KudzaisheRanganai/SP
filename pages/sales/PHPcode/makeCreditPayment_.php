<?php
	include_once("../../sessionCheckPages.php");
	include_once("functions.php");

	$saleID = "";

	include_once("DBConnection.php");

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