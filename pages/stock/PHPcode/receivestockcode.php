<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	$currentDate=date("Y-m-d");
	$stopCount=$_POST["num"]-1;
	for ($i=0; $i <$_POST["num"]; $i++) { 
		if(updateQtyReceived($con,$_POST["orderID"],$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
		{
			if(updateQtyToReceive($con,$_POST["orderID"],$_POST["productIDs"][$i],$_POST["differenceQty"][$i]))
			{
				if(updateProductQty($con,$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
				{
					if(checkWarehouseProduct($con,2,$_POST["productIDs"][$i]))
					{
						if(updateWarehouseProductQty($con,2,$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
						{
							if($i==$stopCount)
							{
								$receiveCount=countReceivedQuantity($con,$_POST["orderID"]);
								if($receiveCount[0]["FINAL"]==0)
								{
									if(updateOrderReceived($con,$_POST["orderID"],$currentDate))
									{
										addAuditForReceiveStock($con,$_POST["orderID"],"Complete");
										echo "T,Stock Received successfully";
									}
									else
									{
										echo "F,Order not updated";
									}
								}
								else
								{
									addAuditForReceiveStock($con,$_POST["orderID"],"Received but Incomplete");
									echo "T,Stock Received but Order Still to be completed";
								}
							}
						}
						else
						{
							echo "F,Fail Update to Warehouse".$i;
						}
					}
					else
					{
						if(addWarehouseProduct($con,2,$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
						{
							if($i==$stopCount)
							{
								$receiveCount=countReceivedQuantity($con,$_POST["orderID"]);
								if($receiveCount[0]["FINAL"]==0)
								{
									if(updateOrderReceived($con,$_POST["orderID"],$currentDate))
									{
										addAuditForReceiveStock($con,$_POST["orderID"],"Complete");
										echo "T,Stock Received successfully";
									}
									else
									{
										echo "F,Order not updated";
									}
								}
								else
								{
									addAuditForReceiveStock($con,$_POST["orderID"],"Received but Incomplete");
									echo "T,Stock Received but Order Still to be completed";
								}
							}
						}
						else
						{
							echo "F,Fail Add to Warehouse".$i;
						}
					}
				}
			}
		}
		else
		{
			echo "F,Database Error";
		}
	}
	mysqli_close($con);
?>