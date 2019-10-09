<?php
	include_once("../../sessionCheckPages.php");
	$customerID = "";
	$userID = "";
	$addSaleDelivery;
	$saleDeliveryAddressID;
	$saleProducts = Array();
	$lastID;
	$deliveryLongitude;
	$deliveryLatitude;

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
		$customerID = mysqli_real_escape_string($DBConnect, $_POST['customerID']);
		$userID = mysqli_real_escape_string($DBConnect, $_POST['saleUserID']);
		$saleProducts  = $_POST['saleProducts'];
		$addSaleDelivery = $_POST['addSaleDelivery'];
		$saleDeliveryAddressID = $_POST['saleDeliveryID'];
		$deliveryLongitude = mysqli_real_escape_string($DBConnect, $_POST['deliveryLongitude_']);
		$deliveryLatitude = mysqli_real_escape_string($DBConnect, $_POST['deliveryLatitude_']);

		$saleTotal = 0.00;
		$arraySize = sizeof($saleProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{ 
			$lineTotal = (float)$saleProducts[$i]['SELLING_PRICE'] * (int)$saleProducts[$i]['QUANTITY'];
			$saleTotal += $lineTotal;
		}

		$query = "SELECT EMPLOYEE_ID FROM USER WHERE USER_ID = '$userID'";
		$result = mysqli_query( $DBConnect, $query);
		$employeeID = mysqli_fetch_array($result)['EMPLOYEE_ID'];

		$dateTimeNow = date('Y-m-d H:i:s');

		//Add product to database
		$querySale = "INSERT INTO SALE(USER_ID, EMPLOYEE_ID, CUSTOMER_ID, SALE_DATE, SALE_AMOUNT, SALE_STATUS_ID) VALUES( '$userID', '$employeeID', '$customerID', '$dateTimeNow', '$saleTotal', 1)";
		mysqli_query($DBConnect, $querySale);

		$lastIDQuery = "SELECT LAST_INSERT_ID();";        
		$lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
		$lastID = mysqli_fetch_array($lastIDQueryResult)[0];

		//Audit step

		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='7.1';
	    $userID = $_SESSION['userID'];
	    $changes="ID : ".$lastID;
        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
        $audit_result=mysqli_query($DBConnect,$audit_query);

	    ///////////


		$arraySize = sizeof($saleProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{ 
			$productLineProductID = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['PRODUCT_ID']);
			$productLineSellingPrice = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['SELLING_PRICE']);
			$productLineQuantity = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['QUANTITY']);
			$querySaleProduct = "INSERT INTO SALE_PRODUCT(SALE_ID, PRODUCT_ID, SELLING_PRICE, QUANTITY, QUANTITY_ASSIGNED) VALUES( '$lastID','$productLineProductID', '$productLineSellingPrice', '$productLineQuantity','$productLineQuantity')";
			mysqli_query($DBConnect, $querySaleProduct);

			//UPDATE AVAILABLE QUANTITY
			$queryUpdateQuantity = "UPDATE PRODUCT SET QUANTITY_AVAILABLE = QUANTITY_AVAILABLE - $productLineQuantity WHERE PRODUCT_ID = $productLineProductID";
			mysqli_query($DBConnect, $queryUpdateQuantity);
		}

		if($addSaleDelivery =="YES") 
		{
			
			$dateFiveFromNow = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 3, date('Y')));
			$delDate=$_POST["addDeliveryDate"];

			$querySaleDelivery = "INSERT INTO DELIVERY(SALE_ID, EXPECTED_DATE, ADDRESS_ID, LONGITUDE, LATITUDE, DCT_STATUS_ID) VALUES( '$lastID', '$delDate', '$saleDeliveryAddressID', $deliveryLongitude,$deliveryLatitude, 1)";
			mysqli_query($DBConnect, $querySaleDelivery);

			//echo($querySaleDelivery);
		}

		//Close database connection
		mysqli_close($DBConnect);

		//Send success response
		$response = "success".",".$lastID;
		echo $response;
	}
?>