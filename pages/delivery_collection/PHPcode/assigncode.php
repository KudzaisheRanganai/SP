<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	if($_POST["choice"]==1)
	{
		$stopCount=$_POST["num"]-1;
		for ($i=0; $i <$_POST["num"] ; $i++) { 
			if(updateSaleProductAssignedQty($con,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i],$_POST["QTY"][$i]))
			{
				if($i==$stopCount)
				{
					
					$assignCount=countAssignment($con,$_POST["SALE_ID"]);
					if($assignCount==0)
					{
						if(updateDeliveryStatus($con,$_POST["SALE_ID"],2))
						{
							echo "TT";
						}
						else
						{
							echo "TF";
						}
					}
					else
					{
						echo "T";
					}
				}
			}
			else
			{
				echo "F".$i;
			}
		}
		
	}
	elseif($_POST["choice"]==2)
	{
		if(checkAssignment($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]))
		{
				$stopProductCount=$_POST["num"]-1;
				$delivery_truck_id=getDeliveryTruckID($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]);
				for ($i=0; $i <$_POST["num"] ; $i++) 
				{ 
					if(checkProductAssignment($con,$delivery_truck_id,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i]))
					{
						if($_POST["QTY"][$i]>0)
						{
							if(updateProductAssignment($con,$delivery_truck_id,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i],$_POST["QTY"][$i]))
							{
								if($i==$stopProductCount)
								{
									addAuditForAssignDelivery($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]);
									echo "T,Delivery Assignment Complete";
								}
							}
							else
							{
								echo "F,Failed to update assignment".$i;
							}
						}
							
					}
					else
					{
						if($_POST["QTY"][$i]>0)
						{
							if(insertProductAssignment($con,$delivery_truck_id,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i],$_POST["QTY"][$i]))
							{
								if($i==$stopProductCount)
								{
									addAuditForAssignDelivery($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]);
									echo "T,Delivery Assignment Complete";
								}
								else
								{
									echo "F,F".$i;
								}
							}
							else
							{
								echo "F,Failed to insert".$i;
							}
						}
					}
				}
		}
		else
		{
			if(insertAssignment($con,$_POST["DELIVERY_ID"],$_POST["SALE_ID"],$_POST["TRUCK_ID"],2))
			{
				$stopProductCount=$_POST["num"]-1;
				$delivery_truck_id=getDeliveryTruckID($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]);
				for ($i=0; $i <$_POST["num"] ; $i++) 
				{ 
					if(checkProductAssignment($con,$delivery_truck_id,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i]))
					{
						if($_POST["QTY"][$i]>0)
						{
							if(updateProductAssignment($con,$delivery_truck_id,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i],$_POST["QTY"][$i]))
							{
								if($i==$stopProductCount)
								{
									addAuditForAssignDelivery($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]);
									echo "T,Delivery Assignment Complete";
								}
							}
							else
							{
								echo "F,Failed to update assignment".$i;
							}
						}
						
					}
					else
					{
						if($_POST["QTY"][$i]>0)
						{
							if(insertProductAssignment($con,$delivery_truck_id,$_POST["SALE_ID"],$_POST["PRODUCT_ID"][$i],$_POST["QTY"][$i]))
							{
								if($i==$stopProductCount)
								{
									addAuditForAssignDelivery($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"]);
									echo "T,Delivery Assignment Complete";
								}
							}
							else
							{
								echo "F,Failed to insert".$i;
							}	
						}
						
					}
				}
			}
			else
			{
				echo "F,Failed to insert in del_truck";
			}
		}
	}
	elseif($_POST["choice"]==3)
	{
		$assignCount=$_POST["num"]-1;
		$removeCount=0;
		for ($i=0; $i<$_POST["num"]; $i++) 
		{ 
			if($_POST["productremove"][$i]=="true")
			{
				$removeCount=$removeCount+1;
				if(deleteMaintainProductAssignment($con,$_POST["deltruckIDs"][$i],$_POST["saleIDs"][$i],$_POST["productIDs"][$i]))
				{
					if(updateMaintainProductSaleAssignment($con,$_POST["saleIDs"][$i],$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
					{
						if($i==$assignCount)
						{
							echo $removeCount;
						}
					}
					else
					{
						echo "F,Update Sale Assignment Failed".$i;
					}
				}
				else
				{
					echo "F, Delete Fail".$i;
				}
			}
			else
			{
				if(updateMaintainProductAssignment($con,$_POST["deltruckIDs"][$i],$_POST["saleIDs"][$i],$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
				{
					if(updateMaintainProductSaleAssignment($con,$_POST["saleIDs"][$i],$_POST["productIDs"][$i],$_POST["productQtys"][$i]))
					{
						if($i==$assignCount)
						{
							echo $removeCount;
						}
					}
					else
					{
						echo "False,Update Sale Assignment Failed".$i;
					}
				}
				else
				{
					echo "F, Update Fail".$i;
				}
			}
		}
	}
	elseif($_POST["choice"]==4)
	{
		if($_POST["remove"]=="true")
		{
			if(deleteDeliveryAssignment($con,$_POST["SALE_ID"],$_POST["TRUCK_ID"]))
			{
				if(checkAssigned($con,$_POST["SALE_ID"])==0)
				{
					if(updateSaleAssignment($con,1,$_POST["SALE_ID"]))
					{
						addAuditForMaintainDelAss($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"],"REMOVED");
						echo "T,Assignment Maintained Successfully";
					}
					else
					{
						echo "F,Sale Assignment Not Updated";
					}
				}
				else
				{
					if(updateSaleAssignment($con,6,$_POST["SALE_ID"]))
					{
						addAuditForMaintainDelAss($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"],"REMOVED");
						echo "T,Assignment Maintained Successfully";
					}
					else
					{
						echo "F,Sale Assignment Not Updated";
					}
				}
				
			}
			else
			{
				echo "F,Assignment not deleted";
			}
		}
		else
		{
			if(checkAssigned($con,$_POST["SALE_ID"])==0)
			{
				if(updateSaleAssignment($con,1,$_POST["SALE_ID"]))
				{
					addAuditForMaintainDelAss($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"],"UPDATED");
					echo "T,Assignment Maintained Successfully";
				}
				else
				{
					echo "F,Sale Assignment Not Updated";
				}
			}
			else
			{
				if(updateSaleAssignment($con,6,$_POST["SALE_ID"]))
				{
					addAuditForMaintainDelAss($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"],"UPDATED");
					echo "T,Assignment Maintained Successfully";
				}
				else
				{
					echo "F,Sale Assignment Not Updated";
				}
			}
		}
	}
	elseif($_POST["choice"]==5)
	{
		$assignSales=getAssignedSales($con,$_POST["TRUCK_ID"]);
		echo json_encode($assignSales);
	}
	elseif($_POST["choice"]==6)
	{
		$updateCount=$_POST["num"]-1;
		for ($i=0; $i<$_POST["num"]; $i++) 
		{ 
			if(updateDeliveryTruckStatus($con,$_POST["SALE_ID"][$i],$_POST["TRUCK_ID"],3))
			{
				if(checkAssignedFinal($con,$_POST["SALE_ID"][$i],2)==0)
				{
					if(updateSaleAssignment($con,3,$_POST["SALE_ID"][$i]))
					{
						if($i==$updateCount)
						{
							addAuditForFinaliseDelAss($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"][$i]);
							echo "T,Finalised Deliveries";
						}
					}
				}
				else
				{
					if($i==$updateCount)
					{
						addAuditForFinaliseDelAss($con,$_POST["TRUCK_ID"],$_POST["SALE_ID"][$i]);
						echo "T,Finalised Deliveries";
					}
				}
			}
			else
			{
				echo "F,Deliveries not finalised";
			}
		}
		
	}
	mysqli_close($con);
?>