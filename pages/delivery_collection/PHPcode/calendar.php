<?php
	include_once("connection.php");
	$sql_query="SELECT * FROM DELIVERY";
	$result=mysqli_query($con,$sql_query);
	if (mysqli_num_rows($result)>0)
	{
	    while ($row=$result->fetch_assoc())
	    {
	       	$vals[]=$row;
	    }
	    echo json_encode($vals);
	        
	}
	else
	{
	    echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
?>
