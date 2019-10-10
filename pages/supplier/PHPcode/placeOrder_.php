<?php
	
	include_once("../../sessionCheckPages.php");

	function getOrderAmount($con,$orderid)
	{
		$get_query="SELECT SUM(A.PRICE) AS TOTAL_AMOUNT,B.ORDER_ID
			FROM ORDER_PRODUCT A
			JOIN ORDER_ B ON A.ORDER_ID=B.ORDER_ID
			WHERE B.ORDER_ID='$orderid'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["TOTAL_AMOUNT"];
		}
		else
		{
			$cityID=false;
		}
		return $cityID;
	}

	function getSupplierAccountID($con,$supid)
	{
		$get_query="SELECT * FROM SUPPLIER_ACCOUNT WHERE SUPPLIER_ID='$supid'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["SUPPLIER_ACCOUNT_ID"];
		}
		else
		{
			$cityID=false;
		}
		return $cityID;
	}

	function insertSupplierAccount($con,$supid,$amount)
	{
		$add_query="INSERT INTO SUPPLIER_ACCOUNT (AMOUNT_OWED,SUPPLIER_ID) VALUES ('$amount','$supid')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateSupplierAccountAmount($con,$supid,$amount)
	{
		$update_query="UPDATE SUPPLIER_ACCOUNT SET AMOUNT_OWED=AMOUNT_OWED+'$amount' WHERE SUPPLIER_ID='$supid'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	$supplierID = "";
	$userID = "";
	$addOrderCollection;
	$orderCollectionAddressID;
	$orderProducts = Array();
	$lastID;
	$collectionLongitude;
	$collectionLatitude;

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
		$supplierID = mysqli_real_escape_string($DBConnect, $_POST['supplierID']);
		$userID = mysqli_real_escape_string($DBConnect, $_POST['orderUserID']);
		$orderProducts  = $_POST['orderProducts'];
		$addOrderCollection = $_POST['addOrderCollection'];
		$orderCollectionAddressID = $_POST['orderCollectionAddressID'];
		$collectionLongitude = mysqli_real_escape_string($DBConnect, $_POST['collectionLongitude']);
		$collectionLatitude = mysqli_real_escape_string($DBConnect, $_POST['collectionLatitude']);

		//echo(var_dump($_POST));

		$orderTotal = 0.00;
		$arraySize = sizeof($orderProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{ 
			$lineTotal = (float)$orderProducts[$i]['COST_PRICE'] * (int)$orderProducts[$i]['QUANTITY'];
			$orderTotal += $lineTotal;
		}

		$query = "SELECT EMPLOYEE_ID FROM USER WHERE USER_ID = '$userID'";
		$result = mysqli_query( $DBConnect, $query);
		$employeeID = mysqli_fetch_array($result)['EMPLOYEE_ID'];

		$dateTimeNow = date('Y-m-d H:i:s');

		//Add product to database
		$queryOrder = "INSERT INTO ORDER_(SUPPLIER_ID, ORDER_DATE, ORDER_STATUS_ID, USER_ID, EMPLOYEE_ID) VALUES( '$supplierID', '$dateTimeNow', 1, '$userID', '$employeeID')";
		
		mysqli_query($DBConnect, $queryOrder);

		$lastIDQuery = "SELECT LAST_INSERT_ID();";        
		$lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
		$lastID = mysqli_fetch_array($lastIDQueryResult)[0];

		//Audit step

		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='5.4';
	    $userID = $_SESSION['userID'];
	    $changes="ID : ".$lastID;
        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
        $audit_result=mysqli_query($DBConnect,$audit_query);

        ///////////////////// Insert or Update Supplier Account

        $supplierAccountID=getSupplierAccountID($DBConnect,$supplierID);
        if($supplierAccountID==false)
        {
        	insertSupplierAccount($DBConnect,$supplierID,$orderTotal);
        }
        else
        {
        	updateSupplierAccountAmount($DBConnect,$supplierID,$orderTotal);
        }


	    ///////////

		$arraySize = sizeof($orderProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{ 
			$productLineProductID = mysqli_real_escape_string($DBConnect, $orderProducts[$i]['PRODUCT_ID']);
			$productLineCostPrice = mysqli_real_escape_string($DBConnect, $orderProducts[$i]['COST_PRICE']);
			$productLineQuantity = mysqli_real_escape_string($DBConnect, $orderProducts[$i]['QUANTITY']);
			$queryOrderProduct = "INSERT INTO ORDER_PRODUCT(ORDER_ID, PRODUCT_ID, QUANTITY,QUANTITY_TO_RECEIVE,QUANTITY_ASSIGNED, PRICE) VALUES( '$lastID','$productLineProductID', '$productLineQuantity','$productLineQuantity','$productLineQuantity', '$productLineCostPrice')";
			mysqli_query($DBConnect, $queryOrderProduct);

		}

		if ($addOrderCollection === true) 
		{
			$dateFiveFromNow = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 3, date('Y')));

			$querySaleDelivery = "INSERT INTO COLLECTION(ORDER_ID, EXPECTED_DATE, ADDRESS_ID, LONGITUDE, LATITUDE, COLLECTION_STATUS_ID) VALUES( '$lastID', '$dateFiveFromNow', '$orderCollectionAddressID', $collectionLongitude,$collectionLatitude, 1)";
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