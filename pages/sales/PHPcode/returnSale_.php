<?php
	include_once("../../sessionCheckPages.php");
	$customerID = "";
	$userID = "";
	$addSaleDelivery;
	$saleDeliveryAddressID;
	$saleReturnProducts = Array();
	$lastID;
	$deliveryLongitude;
	$deliveryLatitude;

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
		$reasonForReturn = mysqli_real_escape_string($DBConnect, $_POST['reasonForReturn']);
		$saleReturnProducts  = $_POST['saleReturnProducts'];

		// echo var_dump($_POST);
		// echo($saleID);
		// echo ($reasonForReturn);
		// echo ($saleReturnProducts);

		$dateTimeNow = date('Y-m-d');

		//Add return to database
		$queryReturn = "INSERT INTO RETURN_ (REASON, RETURN_DATE) VALUES( '$reasonForReturn', '$dateTimeNow')";
		mysqli_query($DBConnect, $queryReturn);
		//echo($queryReturn);
		//Audit step

		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='7.2';
	    $userID = $_SESSION['userID'];
	    $changes="ID : ".$saleID;
        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
        $audit_result=mysqli_query($DBConnect,$audit_query);

	    ///////////





		$lastIDQuery = "SELECT LAST_INSERT_ID();";        
		$lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
		$returnID = mysqli_fetch_array($lastIDQueryResult)[0];

		$arraySize = sizeof($saleReturnProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{ 
			$returnProductLineProductID = mysqli_real_escape_string($DBConnect, $saleReturnProducts[$i]['PRODUCT_ID']);
			$returnProductLineReturnQuantity = mysqli_real_escape_string($DBConnect, $saleReturnProducts[$i]['RETURN_QUANTITY']);

			if ($saleReturnProducts[$i]['RETURN_QUANTITY'] != 0) 
			{
				$querySaleReturnProduct = "INSERT INTO SALE_RETURN(SALE_ID, PRODUCT_ID, RETURN_ID, QUANTITY) VALUES( '$saleID','$returnProductLineProductID', '$returnID', '$returnProductLineReturnQuantity')";
				mysqli_query($DBConnect, $querySaleReturnProduct);
				//echo($querySaleReturnProduct);

				//UPDATE AVAILABLE QUANTITY
				$queryUpdateQuantity = "UPDATE PRODUCT SET QUANTITY_AVAILABLE = QUANTITY_AVAILABLE + $returnProductLineReturnQuantity, QTY_ON_HAND = QTY_ON_HAND + $returnProductLineReturnQuantity WHERE PRODUCT_ID = $returnProductLineProductID";
				mysqli_query($DBConnect, $queryUpdateQuantity);

				// $queryUpdateSaleProductQuantity = "UPDATE SALE_PRODUCT SET QUANTITY = QUANTITY - $returnProductLineReturnQuantity WHERE PRODUCT_ID = $returnProductLineProductID AND SALE_ID = '$saleID'";
				// mysqli_query($DBConnect, $queryUpdateSaleProductQuantity);

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
			    	$queryUpdateWarehouseQuantity = "UPDATE WAREHOUSE_PRODUCT SET QUANTITY = QUANTITY + $returnProductLineReturnQuantity WHERE WAREHOUSE_ID = 4 AND PRODUCT_ID = '$returnProductLineProductID'";
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