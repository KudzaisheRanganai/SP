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

		$sql_query = "SELECT * FROM RETURN_PRODUCT WHERE ORDER_ID = '$orderID'";
		//echo $sql_query;
	    $result = mysqli_query($DBConnect,$sql_query);

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