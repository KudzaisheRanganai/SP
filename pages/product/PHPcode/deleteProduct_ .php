<?php

  	$productName = "";
	$productDescription = "";
	$productType = "";
	$unitsInCase = "";
	$casesInPallet = "";
	$costPrice = "";
	$discountPrice = "";
	$sellingPrice = "";
	$measurement = "";
	$measurementUnit = "";

	include_once("DBConnection.php");

	if($DBConnect === false)
	{
		//Send error response
	  	$response = "databaseError";
      	echo $response;
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		//$exists = false;

		// Retrieve product details from $_POST
		// $productName = mysqli_real_escape_string($DBConnect, $_POST['productName_']);
		// $productDescription  = mysqli_real_escape_string($DBConnect, $_POST['productDescription_']);
		// $productType  = mysqli_real_escape_string($DBConnect, $_POST['productType_']);
		// $unitsInCase  = mysqli_real_escape_string($DBConnect, $_POST['unitsInCase_']);
		// $casesInPallet  = mysqli_real_escape_string($DBConnect, $_POST['casesInPallet_']);
		// $costPrice  = mysqli_real_escape_string($DBConnect, $_POST['costPrice_']);
		// $discountPrice  = mysqli_real_escape_string($DBConnect, $_POST['discountPrice_']);
		// $sellingPrice  = mysqli_real_escape_string($DBConnect, $_POST['sellingPrice_']);
		// $measurement  = mysqli_real_escape_string($DBConnect, $_POST['measurement_']);
		// $measurementUnit  = mysqli_real_escape_string($DBConnect, $_POST['measurementUnit_']);

		//$query = "SELECT * FROM PRODUCT WHERE NAME = '$productName' AND PRODUCT_MEASUREMENT = '$measurement' AND PRODUCT_MEASUREMENT_UNIT = '$measurementUnit'";
	  //   $result = mysqli_query( $DBConnect, $query);
	  //   if (mysqli_num_rows($result)) 
	  //   {
	  //       $exists = true;
	  //   } 
	  //   else 
	  //   {
	  //       $exists = false;
	  //   }

	  //   if($exists == false)
	  //   {	
	  //     	$lastIDQuery = "SELECT PRODUCT_ID FROM PRODUCT ORDER BY PRODUCT_ID DESC LIMIT 1";        
		 //    $lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
		 //    $lastID = mysqli_fetch_array($lastIDQueryResult)[0];
		 //    $nextProductID = $lastID + 1;

			// //Add product to database
			// $queryIndividual = "INSERT INTO PRODUCT(NAME, PRODUCT_DESCR, QTY_ON_HAND, CASES_PER_PALLET, UNITS_PER_CASE, COST_PRICE, GUIDE_DISCOUNT, SELLING_PRICE, QUANTITY_AVAILABLE, PRODUCT_TYPE_ID, PRODUCT_SIZE_TYPE, PRODUCT_MEASUREMENT, PRODUCT_MEASUREMENT_UNIT, PRODUCT_GROUP_ID) 
	  //                 VALUES( '$productName', '$productDescription',0 , '$casesInPallet', '$unitsInCase', '$costPrice', '$discountPrice', '$sellingPrice', 0, '$productType', 1, '$measurement', '$measurementUnit', $nextProductID)";
	  //     	mysqli_query($DBConnect, $queryIndividual);

	  //     	$costPriceCase = $_POST['costPrice_'] * $_POST['unitsInCase_'];
	  //     	$guideDiscountCase = $_POST['discountPrice_'] * $_POST['unitsInCase_'];
	  //     	$sellingPriceCase = $_POST['sellingPrice_'] * $_POST['unitsInCase_'];

	  //     	$costPriceCase = mysqli_real_escape_string($DBConnect, $costPriceCase);
	  //     	$guideDiscountCase = mysqli_real_escape_string($DBConnect, $guideDiscountCase);
	  //     	$sellingPriceCase = mysqli_real_escape_string($DBConnect, $sellingPriceCase);


	  //     	$queryCase = "INSERT INTO PRODUCT(NAME, PRODUCT_DESCR, QTY_ON_HAND, CASES_PER_PALLET, UNITS_PER_CASE, COST_PRICE, GUIDE_DISCOUNT, SELLING_PRICE, QUANTITY_AVAILABLE, PRODUCT_TYPE_ID, PRODUCT_SIZE_TYPE, PRODUCT_MEASUREMENT, PRODUCT_MEASUREMENT_UNIT, PRODUCT_GROUP_ID) 
	  //                 VALUES( '$productName', '$productDescription',0 , '$casesInPallet', '$unitsInCase', '$costPriceCase', '$guideDiscountCase', '$sellingPriceCase', 0, '$productType', 2, '$measurement', '$measurementUnit', $nextProductID)";
	  //     	mysqli_query($DBConnect, $queryCase);

	  //     	$costPricePallet = $_POST['costPrice_'] * $_POST['unitsInCase_'] * $_POST['casesInPallet_'];
	  //     	$guideDiscountPallet = $_POST['discountPrice_'] * $_POST['unitsInCase_'] * $_POST['casesInPallet_'];
	  //     	$sellingPricePallet = $_POST['sellingPrice_'] * $_POST['unitsInCase_'] * $_POST['casesInPallet_'];

	  //     	$costPricePallet = mysqli_real_escape_string($DBConnect, $costPricePallet);
			// $guideDiscountPallet = mysqli_real_escape_string($DBConnect, $guideDiscountPallet);
			// $sellingPricePallet = mysqli_real_escape_string($DBConnect, $sellingPricePallet);

	  //     	$queryPallet = "INSERT INTO PRODUCT(NAME, PRODUCT_DESCR, QTY_ON_HAND, CASES_PER_PALLET, UNITS_PER_CASE, COST_PRICE, GUIDE_DISCOUNT, SELLING_PRICE, QUANTITY_AVAILABLE, PRODUCT_TYPE_ID, PRODUCT_SIZE_TYPE, PRODUCT_MEASUREMENT, PRODUCT_MEASUREMENT_UNIT, PRODUCT_GROUP_ID) 
	  //                 VALUES( '$productName', '$productDescription',0 , '$casesInPallet', '$unitsInCase', '$costPricePallet', '$guideDiscountPallet', '$sellingPricePallet', 0, '$productType', 3, '$measurement', '$measurementUnit', $nextProductID)";
	  //     	mysqli_query($DBConnect, $queryPallet);

	      	//Close database connection
			mysqli_close($DBConnect);

			//Send success response
			$response = "success";
	      	echo $response;
	    // }
	    // else
	    // {
	    // 	mysqli_close($DBConnect);
	    // 	$response = "product name exists";
	    //   	echo $response;
	    // }
	}
?>