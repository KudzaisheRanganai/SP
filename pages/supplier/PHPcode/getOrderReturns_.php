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
		$orderID = mysqli_real_escape_string($DBConnect, $_POST['orderID']);

		//$sql_query = "SELECT * FROM RETURN_PRODUCT WHERE ORDER_ID = '$orderID'";

		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME
			FROM ORDER_RETURN_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID
			WHERE ORDER_ID='$orderID'";

		//echo $sql_query;
	    $result = mysqli_query($DBConnect,$get_query);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	$count=$count+1;
	        }
	        echo json_encode($vals);
	    }
	    else
	    {
	        echo "false";
	    }
	    mysqli_close($DBConnect);
	}
?>