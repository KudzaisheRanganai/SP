<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	$currentDate=date("Y-m-d");
	$assignment=(array) json_decode($_POST["assignment"]);
	$stopCount=$_POST["num"]-1;
	for ($i=0; $i<$_POST["num"]; $i++) { 
		if(updateCollectionFinalQty($con,$assignment[0]->ORDER_ID,$_POST["productIDs"][$i],$_POST["productQty"][$i]))
		{
			updateCollectionTruckFinalQty($con,$_POST["COLLECTION_TRUCK_ID"],$assignment[0]->ORDER_ID,$_POST["productIDs"][$i],$_POST["productQty"][$i]);
		}
		
	}
	// var_dump($_POST["productIDs"]);
	$deliveryDifference=getCollectionDifference($con,$assignment[0]->ORDER_ID);
	$deliveryTruckDifference=getCollectionTruckDifference($con,$assignment[0]->ORDER_ID,$_POST["COLLECTION_TRUCK_ID"]);
	if($deliveryDifference[0]["FINAL"]==0)
	{
		if(updateCollectionStatus($con,$assignment[0]->ORDER_ID,5))
		{
			if(updateCollectedDate($con,$assignment[0]->ORDER_ID,$currentDate))
			{
				if(updateCollectionTruckStatus($con,$assignment[0]->ORDER_ID,$assignment[0]->TRUCK_ID,5))
				{
					addAuditForMakeCollection($con,$assignment[0]->TRUCK_ID,$assignment[0]->ORDER_ID,"Collection Complete and Collected");
					echo "T,Collection Complete and Collected";
				}

			}
			else
			{
				echo "F,Date not updated";
			}
			
		}
		else
		{
			echo "F,Fail";
		}
		
	}
	else if($deliveryTruckDifference[0]["FINAL"]==0)
	{
		if(updateCollectionTruckStatus($con,$assignment[0]->ORDER_ID,$assignment[0]->TRUCK_ID,5))
		{
			addAuditForMakeCollection($con,$assignment[0]->TRUCK_ID,$assignment[0]->ORDER_ID,"Collection Assignment Completed");
			echo "T,Collection Assignment Completed";
		}
	}
	else
	{
		addAuditForMakeCollection($con,$assignment[0]->TRUCK_ID,$assignment[0]->ORDER_ID,"Collection Assignment Collected but not completed");
		echo "T,Collection Assignment Collected but not completed";
	}
	mysqli_close($con);
	
?>