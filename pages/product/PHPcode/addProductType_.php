<?php
	include_once("../../sessionCheckPages.php");
  	$productTypeName = "";
	$productTypeDescription = "";

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
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		$exists = false;

		// Retrieve product details from $_POST
		$productTypeName = mysqli_real_escape_string($DBConnect, $_POST['productTypeName_']);
		$productTypeDescription  = mysqli_real_escape_string($DBConnect, $_POST['productTypeDescription_']);

		$query = "SELECT * FROM PRODUCT_TYPE WHERE TYPE_NAME = '$productTypeName'";
	    $result = mysqli_query( $DBConnect, $query);
	    if (mysqli_num_rows($result)) 
	    {
	        $exists = true;
	    } 
	    else 
	    {
	        $exists = false;
	    }

	    if($exists == false)
	    {	

			//Add product type to database
			$query = "INSERT INTO PRODUCT_TYPE(TYPE_NAME, DESCRIPTION) 
	                  VALUES( '$productTypeName', '$productTypeDescription')";
	      	mysqli_query($DBConnect, $query);
	      	$last_id = mysqli_insert_id($DBConnect);
	      	$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='8.4';
		    $userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($DBConnect,$audit_query);
	        if($audit_result)
	        {
	          
	        }
	        else
	        {
	          
	        }
	      	//Close database connection
			mysqli_close($DBConnect);

			//Send success response
			$response = "success";
	      	echo $response;
	    }
	    else
	    {
	    	mysqli_close($DBConnect);
	    	$response = "product type exists";
	      	echo $response;
	    }
	}
?>