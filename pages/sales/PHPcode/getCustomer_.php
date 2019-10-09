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
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
	;	$customerPhoneNumber = $_POST['customerPhone'];
		$sql_query = "SELECT * FROM CUSTOMER WHERE CONTACT_NUMBER = '$customerPhoneNumber' OR CUSTOMER_ID = '$customerPhoneNumber' LIMIT 1";
		$result = mysqli_query($DBConnect,$sql_query);

		if (mysqli_num_rows($result)>0) 
		{
			$customerDetails=$result->fetch_assoc();
		    echo json_encode($customerDetails);
	    }
	    else
	    {
		    echo "false";
	    }
	    mysqli_close($DBConnect);
	}
?>