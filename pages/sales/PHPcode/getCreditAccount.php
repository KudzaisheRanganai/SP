<?php

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