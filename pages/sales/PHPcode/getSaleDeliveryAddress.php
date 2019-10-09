<?php

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
	  	$response = "databaseError";
      	echo $response;
	}
	else
	{
		$customerID = $_POST['customerID'];
		$sql_query = "SELECT A.ADDRESS_ID, B.ADDRESS_LINE_1, C.NAME, D.CITY_NAME, C.ZIPCODE
		FROM CUSTOMER_ADDRESS A 
		JOIN ADDRESS B ON A.ADDRESS_ID = B.ADDRESS_ID 
		JOIN SUBURB C ON B.SUBURB_ID = C.SUBURB_ID
		JOIN CITY D ON C.CITY_ID = D.CITY_ID
		WHERE CUSTOMER_ID = '$customerID'";

		$result = mysqli_query($DBConnect,$sql_query);

		if (mysqli_num_rows($result)>0) 
		{
			$addresses = array();
			for ($i=0; $i < mysqli_num_rows($result); $i++) 
			{ 
				array_push($addresses, $result->fetch_assoc());
			}
		    echo json_encode($addresses);
	    }
	    else
	    {
		    echo "false";
	    }
	    mysqli_close($DBConnect);
	}
?>