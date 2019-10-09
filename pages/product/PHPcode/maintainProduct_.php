<?php
	include_once("../../sessionCheckPages.php");
	$productName = "";
	$productDescription = "";
	$productTypeID = "";
	$unitsInCase = "";
	$casesInPallet = "";
	$costPrice = "";
	$discountPrice = "";
	$sellingPrice = "";
	$measurement = "";
	$measurementUnit = "";
	$prevProductName = "";
	$prevProductDescription = "";
	$prevProductType = "";
	$prevUnitsInCase = "";
	$prevCasesInPallet = "";
	$prevCostPrice = "";
	$prevDiscountPrice = "";
	$prevSellingPrice = "";
	$prevMeasurement = "";
	$prevMeasurementUnit = "";
	$productGroupID = "";

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
	  	$response = "database error";
      	echo $response;
      	//die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		$exists = false;

		// Retrieve product details from $_POST
		$productName = mysqli_real_escape_string($DBConnect, $_POST['productName_']);
		$productDescription  = mysqli_real_escape_string($DBConnect, $_POST['productDescription_']);
		$productTypeID  = mysqli_real_escape_string($DBConnect, $_POST['productTypeID_']);
		$unitsInCase  = mysqli_real_escape_string($DBConnect, $_POST['unitsInCase_']);
		$casesInPallet  = mysqli_real_escape_string($DBConnect, $_POST['casesInPallet_']);
		$costPrice  = mysqli_real_escape_string($DBConnect, $_POST['costPrice_']);
		$discountPrice  = mysqli_real_escape_string($DBConnect, $_POST['discountPrice_']);
		$sellingPrice  = mysqli_real_escape_string($DBConnect, $_POST['sellingPrice_']);
		$measurement  = mysqli_real_escape_string($DBConnect, $_POST['measurement_']);
		$measurementUnit  = mysqli_real_escape_string($DBConnect, $_POST['measurementUnit_']);

		$prevProductName = mysqli_real_escape_string($DBConnect, $_POST['prevProductName_']);
		$prevProductDescription  = mysqli_real_escape_string($DBConnect, $_POST['prevProductDescription_']);
		$prevProductType  = mysqli_real_escape_string($DBConnect, $_POST['prevProductTypeID_']);
		$prevUnitsInCase  = mysqli_real_escape_string($DBConnect, $_POST['prevUnitsPerCase_']);
		$prevCasesInPallet  = mysqli_real_escape_string($DBConnect, $_POST['prevCasesPerPallet_']);
		$prevCostPrice  = mysqli_real_escape_string($DBConnect, $_POST['prevCostPrice_']);
		$prevDiscountPrice  = mysqli_real_escape_string($DBConnect, $_POST['prevGuideDiscount_']);
		$prevSellingPrice  = mysqli_real_escape_string($DBConnect, $_POST['prevSellingPrice_']);
		$prevMeasurement  = mysqli_real_escape_string($DBConnect, $_POST['prevProductMeasurement_']);
		$prevMeasurementUnit  = mysqli_real_escape_string($DBConnect, $_POST['prevProductMeasurementUnit_']);

		$productGroupID = mysqli_real_escape_string($DBConnect, $_POST['productGroupID_']);



		$changes="";
		$changesMade = 0;
		$query = "UPDATE PRODUCT SET ";

		if($productName != $prevProductName) 
		{	
			$query .= "NAME = '$productName'";
			$changes=$changes." | Name :  ".$prevProductName;
			$queryCheck = "SELECT * FROM PRODUCT WHERE NAME = '$productName' AND PRODUCT_MEASUREMENT = '$measurement' AND PRODUCT_MEASUREMENT_UNIT = '$measurementUnit'";
		    $result = mysqli_query( $DBConnect, $queryCheck);
		    if (mysqli_num_rows($result)) 
		    {
		        $exists = true;
		    }

			$changesMade++;
		}
		if ($productDescription != $prevProductDescription) 
		{	
			$changes=$changes." | Description :".$prevProductDescription;
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "PRODUCT_DESCR = '$productDescription'";
			$changesMade++;
		}
		if ($productTypeID != $prevProductType) 
		{	
			$changes=$changes." | Product Type: ".$productTypeID;
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "PRODUCT_TYPE_ID = '$productTypeID'";
			$changesMade++;
		}
		if ($unitsInCase != $prevUnitsInCase) 
		{	
			$changes=$changes." | Units in case: ".$prevUnitsInCase;
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "UNITS_PER_CASE = '$unitsInCase'";
			$changesMade++;
		}
		if ($casesInPallet != $prevCasesInPallet) 
		{	
			$changes=$changes." | Units in pallets: ".$prevCasesInPallet;
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "CASES_PER_PALLET = '$casesInPallet'";
			$changesMade++;
		}
		if ($measurement != $prevMeasurement) 
		{	
			$changes=$changes." | Measurement: ".$prevMeasurement;

			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "PRODUCT_MEASUREMENT = '$measurement'";
			$changesMade++;
		}
		if ($measurementUnit != $prevMeasurementUnit) 
		{	

			$changes=$changes." | Measurement unit: ".$prevMeasurementUnit;
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "PRODUCT_MEASUREMENT_UNIT = '$measurementUnit'";
			$changesMade++;
		}

		$priceChangesMade = 0;

		$pricesIndividualQuery = "UPDATE PRODUCT SET ";
		$pricesCasesQuery = "UPDATE PRODUCT SET ";
		$pricesPalletQuery = "UPDATE PRODUCT SET ";

		//price changes
		if ($costPrice != $prevCostPrice) 
		{
			$changes=$changes." | Cost Price: ".$prevCostPrice;
			$costPriceCase = $_POST['costPrice_'] * $_POST['unitsInCase_'];
			$costPriceCase = mysqli_real_escape_string($DBConnect, $costPriceCase);

			$costPricePallet = $_POST['costPrice_'] * $_POST['unitsInCase_'] * $_POST['casesInPallet_'];
			$costPricePallet = mysqli_real_escape_string($DBConnect, $costPricePallet);	

			$pricesIndividualQuery .= "COST_PRICE = '$costPrice'";
			$pricesCasesQuery .= "COST_PRICE = '$costPriceCase'";
			$pricesPalletQuery .= "COST_PRICE = '$costPricePallet'";
			$priceChangesMade++;
		}
		if ($discountPrice != $prevDiscountPrice) 
		{	
			$changes=$changes." | Discount Price: ".$prevDiscountPrice;
			if ($priceChangesMade > 0) 
			{
				$pricesIndividualQuery .= ", ";
				$pricesCasesQuery .= ", ";
				$pricesPalletQuery .= ", ";
			}
			$guideDiscountCase = $_POST['discountPrice_'] * $_POST['unitsInCase_'];
		    $guideDiscountCase = mysqli_real_escape_string($DBConnect, $guideDiscountCase);
			$guideDiscountPallet = $_POST['discountPrice_'] * $_POST['unitsInCase_'] * $_POST['casesInPallet_'];
		    $guideDiscountPallet = mysqli_real_escape_string($DBConnect, $guideDiscountPallet);

			$pricesIndividualQuery .= "GUIDE_DISCOUNT = '$discountPrice'";
			$pricesCasesQuery .= "GUIDE_DISCOUNT = '$guideDiscountCase'";
			$pricesPalletQuery .= "GUIDE_DISCOUNT = '$guideDiscountPallet'";
			$priceChangesMade++;
		}
		if ($sellingPrice != $prevSellingPrice) 
		{	
			$changes=$changes." | Selling Price: ".$prevSellingPrice;
			if ($priceChangesMade > 0) 
			{
				$pricesIndividualQuery .= ", ";
				$pricesCasesQuery .= ", ";
				$pricesPalletQuery .= ", ";
			}

			$sellingPriceCase = $_POST['sellingPrice_'] * $_POST['unitsInCase_'];
		    $sellingPriceCase = mysqli_real_escape_string($DBConnect, $sellingPriceCase);
		    $sellingPricePallet = $_POST['sellingPrice_'] * $_POST['unitsInCase_'] * $_POST['casesInPallet_'];
			$sellingPricePallet = mysqli_real_escape_string($DBConnect, $sellingPricePallet);

			$pricesIndividualQuery .= "SELLING_PRICE = '$sellingPrice'";
			$pricesCasesQuery .= "SELLING_PRICE = '$sellingPriceCase'";
			$pricesPalletQuery .= "SELLING_PRICE = '$sellingPricePallet'";
			$priceChangesMade++;
		}

		//if there were changes
		if ($changesMade > 0 && $priceChangesMade > 0) 
		{

			$query .= " WHERE PRODUCT_GROUP_ID = '$productGroupID'";
			$pricesIndividualQuery .= " WHERE PRODUCT_GROUP_ID = '$productGroupID' AND PRODUCT_SIZE_TYPE = 1";
			$pricesCasesQuery .= " WHERE PRODUCT_GROUP_ID = '$productGroupID' AND PRODUCT_SIZE_TYPE = 2";
			$pricesPalletQuery .= " WHERE PRODUCT_GROUP_ID = '$productGroupID' AND PRODUCT_SIZE_TYPE = 3";
			
		    if($exists == false)
		    {	
				//Update product type in database
		      	mysqli_query($DBConnect, $query);

		      	//Update Prices
				mysqli_query($DBConnect, $pricesIndividualQuery);
				mysqli_query($DBConnect, $pricesCasesQuery);
				mysqli_query($DBConnect, $pricesPalletQuery);

				//Send success response
				$response = "success";
		      	echo $response;
		    }
		}
		else if ($changesMade > 0) 
		{
			$query .= " WHERE PRODUCT_GROUP_ID = $productGroupID";
			
		    if($exists == false)
		    {	
				//Update product type in database
		      	mysqli_query($DBConnect, $query);

		      	//Update Prices
		      	if ($priceChangesMade > 0) 
				{
					mysqli_query($DBConnect, $pricesIndividualQuery);
					mysqli_query($DBConnect, $pricesCasesQuery);
					mysqli_query($DBConnect, $pricesPalletQuery);
				}

				//Send success response
				$response = "success";
		      	echo $response;
		    }
		    else
		    {
		    	$response = "product exists";
		      	echo $response;
		    }
		}
		else if ($priceChangesMade > 0) 
		{
			$pricesIndividualQuery .= " WHERE PRODUCT_GROUP_ID = '$productGroupID' AND PRODUCT_SIZE_TYPE = 1";
			$pricesCasesQuery .= " WHERE PRODUCT_GROUP_ID = '$productGroupID' AND PRODUCT_SIZE_TYPE = 2";
			$pricesPalletQuery .= " WHERE PRODUCT_GROUP_ID = '$productGroupID' AND PRODUCT_SIZE_TYPE = 3";
		
		    if($exists == false)
		    {	
		      	//Update Prices
				mysqli_query($DBConnect, $pricesIndividualQuery);
				mysqli_query($DBConnect, $pricesCasesQuery);
				mysqli_query($DBConnect, $pricesPalletQuery);

				//Send success response
				$response = "success";
		      	echo $response;
		    }
		    else
		    {
		    	$response = "product exists";
		      	echo $response;
		    }
		}
		else
		{
			$response = "no changes made";
		   	echo $response;
		}



		//audit step 

		if($changes!=""){
			 $changes = $productGroupID."  ".$changes;
			 $DateAudit = date('Y-m-d H:i:s');
		     $Functionality_ID='8.2';
		     $userID = $_SESSION['userID'];
	         $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	         mysqli_query($DBConnect,$audit_query);
		}


	    //Close database connection
		mysqli_close($DBConnect);
	}
?>