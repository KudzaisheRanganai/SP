<?php
	include_once("../../sessionCheckPages.php");
	$productTypeID = "";
  	$productTypeName = "";
	$productTypeDescription = "";
	$previousProductTypeName = "";
	$previousProductTypeDescription = "";

	include_once("DBConnection.php");

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
		$productTypeID = mysqli_real_escape_string($DBConnect, $_POST['productTypeID_']);
		$productTypeName = mysqli_real_escape_string($DBConnect, $_POST['productTypeName_']);
		$productTypeDescription  = mysqli_real_escape_string($DBConnect, $_POST['productTypeDescription_']);
		$previousProductTypeName = mysqli_real_escape_string($DBConnect, $_POST['prevProductTypeName_']);
		$previousProductTypeDescription = mysqli_real_escape_string($DBConnect, $_POST['prevProductTypeDescription_']);


		$changes=$productTypeID;

		$changesMade = 0;
		$query = "UPDATE PRODUCT_TYPE SET ";

		if($productTypeName != $previousProductTypeName) 
		{	
			$changes=$changes." | Name : ".$previousProductTypeName;
			$query .= "TYPE_NAME = '$productTypeName'";

			$queryCheck = "SELECT * FROM PRODUCT_TYPE WHERE TYPE_NAME = '$productTypeName'";
		    $result = mysqli_query( $DBConnect, $queryCheck);
		    if (mysqli_num_rows($result)) 
		    {
		        $exists = true;
		    }

			$changesMade++;
		}
		if ($productTypeDescription != $previousProductTypeDescription) 
		{	
			$changes=$changes." | Description : ".$previousProductTypeDescription;
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "DESCRIPTION = '$productTypeDescription'";
			$changesMade++;
		}

		if ($changesMade > 0) 
		{

			$query .= " WHERE PRODUCT_TYPE_ID = '$productTypeID'";

		    if($exists == false)
		    {	
				//Update product type in database
		      	mysqli_query($DBConnect, $query);

			     $DateAudit = date('Y-m-d H:i:s');
			     $Functionality_ID='8.5';
			     $userID = $_SESSION['userID'];
		         $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
		         mysqli_query($DBConnect,$audit_query);


				//Send success response
				$response = "success";
		      	echo $response;
		    }
		    else
		    {
		    	$response = "product type exists";
		      	echo $response;
		    }
		}
		else
		{
			$response = "no changes made";
		   	echo $response;
		}

	    //Close database connection
		mysqli_close($DBConnect);
	}
?>