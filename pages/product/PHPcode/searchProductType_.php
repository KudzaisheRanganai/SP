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
		$sql_query = "SELECT * FROM PRODUCT_TYPE ORDER BY TYPE_NAME";
	    $result = mysqli_query($DBConnect,$sql_query);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row = $result->fetch_assoc())
	        {
	        	$vals[] = $row;
	        	$count = $count+1;
	        }
	        echo json_encode($vals);
	        
	    }
	    else
	    {
	        echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	    }
	    mysqli_close($DBConnect);
	}
?>