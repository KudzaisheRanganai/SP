<?php

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
		$customerID = mysqli_real_escape_string($DBConnect, $_POST['customerID']);

		//echo json_encode($saleProducts);
		$query = "SELECT * FROM CUSTOMER_ACCOUNT WHERE CUSTOMER_ID = '$customerID'";
	    $result = mysqli_query( $DBConnect, $query);
	    if (mysqli_num_rows($result)) 
	    {
	    	$response = "true";
	    	echo $response;
	    } 
	    else 
	    {
	        $response = "false";
	        echo $response;
	    }

		//Close database connection
		mysqli_close($DBConnect);

	}
?>