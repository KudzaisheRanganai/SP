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
		$saleID = mysqli_real_escape_string($DBConnect, $_POST['saleID']);

		$sql_query = "SELECT * FROM SALE_RETURN WHERE SALE_ID = $saleID";
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