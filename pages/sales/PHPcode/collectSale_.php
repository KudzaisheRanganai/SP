<?php
	include_once("../../sessionCheckPages.php");
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
		$saleProducts  = $_POST['saleProducts'];

		//echo json_encode($saleProducts);

		//UPDATE AVAILABLE QUANTITY
		$queryUpdateSaleStatus = "UPDATE SALE SET SALE_STATUS_ID = 3 WHERE SALE_ID = $saleID";
		mysqli_query($DBConnect, $queryUpdateSaleStatus);

		//Audit step

		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='7.4';
	    $userID = $_SESSION['userID'];
	    $changes="ID : ".$saleID;
        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
        $audit_result=mysqli_query($DBConnect,$audit_query);

	    ///////////


		$arraySize = sizeof($saleProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{
			$productLineProductID = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['PRODUCT_ID']);
			$productLineQuantity = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['QUANTITY']);

			$queryUpdateSaleProductQuantity = "UPDATE SALE_PRODUCT SET QTY_ON_HAND = QTY_ON_HAND - $productLineQuantity WHERE PRODUCT_ID = $productLineProductID AND SALE_ID = '$saleID'";
			mysqli_query($DBConnect, $queryUpdateSaleProductQuantity);
		}

		//Close database connection
		mysqli_close($DBConnect);

		//Send success response
		$response = "success";
		echo $response;
	}
?>