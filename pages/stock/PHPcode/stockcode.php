<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	if($_POST["choice"]==1)
	{
		echo json_encode(getWarehouseDetails($con));
	}
	elseif($_POST["choice"]==2)
	{
		echo json_encode(getProductDetails($con));
	}
	elseif($_POST["choice"]==3)
	{
		echo json_encode(getWarehouseProductDetails($con));
	}
	elseif($_POST["choice"]==4)
	{
		$stopCount=$_POST["length"]-1;
		for ($i=0; $i<$_POST["length"]; $i++) { 
			if(reduceWarehouseProductQty($con,$_POST["source"],$_POST["product"][$i],$_POST["qty"][$i]))
			{
				if(checkWarehouseProduct($con,$_POST["destination"],$_POST["product"][$i]))
				{
					if(updateWarehouseProductQty($con,$_POST["destination"],$_POST["product"][$i],$_POST["qty"][$i]))
					{
						
						if($i==$stopCount)
						{
							addAuditForPlaceStock($con,$_POST["source"],$_POST["destination"]);
							echo "T,Stock Items Placed Successfully";
						}
						
					}
					else
					{
						echo "F,Stock Items Not Updated Successfully ".$i;
					}
				}
				else
				{
					if(addWarehouseProduct($con,$_POST["destination"],$_POST["product"][$i],$_POST["qty"][$i]))
					{
						if($i==$stopCount)
						{
							addAuditForPlaceStock($con,$_POST["source"],$_POST["destination"]);
							echo "T, Stock Items Placed Successfully";
						}
						
					}
					else
					{
						echo "F,Stock Items Not Added Successfully ".$i;
					}
				}
			}
			else
			{
				echo "F,Products Not Reduced";
			}
		}
	}
	mysqli_close($con);
	
?>