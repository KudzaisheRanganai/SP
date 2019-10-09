<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	$currentDate=date("Y-m-d");
	$assignment=(array) json_decode($_POST["assignment"]);
	$stopCount=$_POST["num"]-1;
	for ($i=0; $i<$_POST["num"]; $i++) { 
		if(updateDeliveryFinalQty($con,$assignment[0]->SALE_ID,$_POST["productIDs"][$i],$_POST["productQty"][$i]))
		{
			updateDeliveryTruckFinalQty($con,$_POST["DELIVERY_TRUCK_ID"],$assignment[0]->SALE_ID,$_POST["productIDs"][$i],$_POST["productQty"][$i]);
		}
		
	}
	// var_dump($_POST["productIDs"]);
	generateImage($_POST["image"],$assignment[0]->SALE_ID);
	$deliveryDifference=getDeliveryDifference($con,$assignment[0]->SALE_ID);
	$deliveryTruckDifference=getDeliveryTruckDifference($con,$assignment[0]->SALE_ID,$_POST["DELIVERY_TRUCK_ID"]);
	if($deliveryDifference[0]["FINAL"]==0)
	{
		if(updateDeliveryStatus($con,$assignment[0]->SALE_ID,5))
		{
			if(updateDeliveredDate($con,$assignment[0]->SALE_ID,$currentDate))
			{
				if(updateDeliveryTruckStatus($con,$assignment[0]->SALE_ID,$assignment[0]->TRUCK_ID,5))
				{
					addAuditForMakeDelivery($con,$assignment[0]->TRUCK_ID,$assignment[0]->SALE_ID,"Delivery Complete and Delivered");
					echo "T,Delivery Complete and Delivered";
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
		if(updateDeliveryTruckStatus($con,$assignment[0]->SALE_ID,$assignment[0]->TRUCK_ID,5))
		{
			addAuditForMakeDelivery($con,$assignment[0]->TRUCK_ID,$assignment[0]->SALE_ID,"Delivery Assignment Delivered");
			echo "T,Delivery Assignment Delivered";
		}
	}
	else
	{
		addAuditForMakeDelivery($con,$assignment[0]->TRUCK_ID,$assignment[0]->SALE_ID,"Delivery Assignment Delivered but not completed");
		echo "T,Delivery Assignment Delivered but not completed";
	}
	mysqli_close($con);
	
?>