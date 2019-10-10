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
		$sql_query = "SELECT * FROM PRODUCT ORDER BY NAME";
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
	        echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	    }
	    mysqli_close($DBConnect);
	}
?>