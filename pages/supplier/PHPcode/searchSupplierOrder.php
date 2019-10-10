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
		$sql_query = "
		SELECT A.ORDER_ID, A.ORDER_DATE, B.NAME AS SUPPLIER_NAME, C.STATUS_NAME AS ORDER_STATUS
		FROM ORDER_ A
		JOIN SUPPLIER B ON A.SUPPLIER_ID = B.SUPPLIER_ID
		JOIN ORDER_STATUS C ON A.ORDER_STATUS_ID = C.ORDER_STATUS_ID";
	    $result = mysqli_query($DBConnect,$sql_query);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
	        }
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else
	    {
	        echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	    }
	    mysqli_close($DBConnect);
	}
?>