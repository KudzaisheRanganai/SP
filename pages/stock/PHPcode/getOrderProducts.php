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
		$orderID = $_POST['orderID'];
		
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME
			FROM ORDER_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID
			WHERE ORDER_ID='$orderID'";
		$get_result=mysqli_query($DBConnect,$get_query);
		
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$vals[]=$get_row;
			}
			echo json_encode($vals);
		}
		else
		{
			return false;
		}
	    mysqli_close($DBConnect);
	}
?>