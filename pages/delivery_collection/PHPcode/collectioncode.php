<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	if($_POST["choice"]==1)
	{
		if(addCollection($con,$_POST["ORDER_ID"],$_POST["dDate"],$_POST["ADDRESS_ID"],1,$_POST["latitude"],$_POST["longitude"]))
		{
			echo "T,Order Collection Added Successfully";
		}
		else
		{
			echo "F, Collection Not Added";
		}
	}
	elseif($_POST["choice"]==2)
	{
		if(deleteCollection($con,$_POST["collectionID"]))
		{
			echo "T,Collection Cancelled Successfully";
		}
		else
		{
			echo "F,Collection Not Cancelled";
		}
	}
	mysqli_close($con);
?>