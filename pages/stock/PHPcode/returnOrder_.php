<?php
	include_once("../../sessionCheckPages.php");
	include_once("functions.php");
	$customerID = "";
	$userID = "";
	$saleDeliveryAddressID;
	$orderReturnProducts = Array();
	$lastID;
	$deliveryLongitude;
	$deliveryLatitude;

	// orderID: "2"
	// reasonForReturn: "bad"
	// saleReturnProducts: Array(3)

	// PRODUCT_ID: "3"
	// RETURN_QUANTITY

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
		$orderID = mysqli_real_escape_string($DBConnect, $_POST['orderID']);
		$reasonForReturn = mysqli_real_escape_string($DBConnect, $_POST['reasonForReturn']);
		$orderReturnProducts  = $_POST['orderReturnProducts'];

		$dateTimeNow = date('Y-m-d');

		//Add return to database
		$queryReturn = "INSERT INTO ORDER_RETURN(RETURN_DATE, REASON) VALUES('$dateTimeNow', '$reasonForReturn')";
		mysqli_query($DBConnect, $queryReturn);
		//echo($queryReturn);
		addAuditForReturnStock($DBConnect,$orderID,$reasonForReturn);
		$lastIDQuery = "SELECT LAST_INSERT_ID();";        
		$lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
		$returnID = mysqli_fetch_array($lastIDQueryResult)[0];

		$arraySize = sizeof($orderReturnProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{ 
			$returnProductLineProductID = mysqli_real_escape_string($DBConnect, $orderReturnProducts[$i]['PRODUCT_ID']);
			$returnProductLineReturnQuantity = mysqli_real_escape_string($DBConnect, $orderReturnProducts[$i]['RETURN_QUANTITY']);

			if ($orderReturnProducts[$i]['RETURN_QUANTITY'] != 0) 
			{
				$querySaleReturnProduct = "INSERT INTO ORDER_RETURN_PRODUCT(RETURN_ID, PRODUCT_ID, ORDER_ID, QUANTITY) VALUES( '$returnID','$returnProductLineProductID', '$orderID', '$returnProductLineReturnQuantity')";
				mysqli_query($DBConnect, $querySaleReturnProduct);
				//echo($querySaleReturnProduct);

				//UPDATE AVAILABLE QUANTITY
				$queryUpdateQuantity = "UPDATE PRODUCT SET QUANTITY_AVAILABLE = QUANTITY_AVAILABLE - $returnProductLineReturnQuantity, QTY_ON_HAND = QTY_ON_HAND - $returnProductLineReturnQuantity WHERE PRODUCT_ID = $returnProductLineProductID";
				mysqli_query($DBConnect, $queryUpdateQuantity);


				//echo($queryUpdateQuantity);

				$exists = false;
				$warehouseQuery = "SELECT * FROM WAREHOUSE_PRODUCT WHERE WAREHOUSE_ID = 4 AND PRODUCT_ID = '$returnProductLineProductID'";
			    $result = mysqli_query( $DBConnect, $warehouseQuery);
			    if (mysqli_num_rows($result)) 
			    {
			        $exists = true;
			    } 

			    if ($exists == true) 
			    {
			    	$queryUpdateWarehouseQuantity = "UPDATE WAREHOUSE_PRODUCT SET QUANTITY = QUANTITY - $returnProductLineReturnQuantity WHERE WAREHOUSE_ID = 4 AND PRODUCT_ID = '$returnProductLineProductID'";
					mysqli_query($DBConnect, $queryUpdateWarehouseQuantity);
			    }
			    else
			    {
			    	$queryWarehouseProductAdd = "INSERT INTO WAREHOUSE_PRODUCT(WAREHOUSE_ID, PRODUCT_ID, QUANTITY) VALUES( 4,'$returnProductLineProductID', '$returnProductLineReturnQuantity')";
					mysqli_query($DBConnect, $queryWarehouseProductAdd);
			    }

			}
		}
		//Close database connection
		mysqli_close($DBConnect);

		//Send success response
		$response = "success";
		echo $response;
	}
?>