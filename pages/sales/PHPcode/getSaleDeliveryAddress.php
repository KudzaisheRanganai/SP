<?php

	include_once("DBConnection.php");

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