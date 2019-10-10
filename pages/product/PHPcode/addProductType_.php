<?php
	include_once("../../sessionCheckPages.php");
  	$productTypeName = "";
	$productTypeDescription = "";

	include_once("DBConnection.php");

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