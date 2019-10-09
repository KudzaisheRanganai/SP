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
		$accessLevelID = $_POST['accessLevelID'];

		$userSubFunctionalityQ = "SELECT * FROM ACCESS_LEVEL_SUB_FUNCTIONALITY WHERE ACCESS_LEVEL_ID ='$accessLevelID'";
        $userSubFunctionalityQResult = mysqli_query($DBConnect, $userSubFunctionalityQ);

        $subFunctionality = array();
        while( $functionality = mysqli_fetch_array($userSubFunctionalityQResult))
        { 
            array_push($subFunctionality, $functionality['SUB_FUNCTIONALITY_ID']);
        }

        echo json_encode($subFunctionality);

	    mysqli_close($DBConnect);
	}
?>