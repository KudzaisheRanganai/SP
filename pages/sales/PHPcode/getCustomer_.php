<?php

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