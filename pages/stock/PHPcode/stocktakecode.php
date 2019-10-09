<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	$date=Date("Y-m-d");
	$stopCount=$_POST["num"]-1;
	if(addStockTake($con,$date,$_POST["userID"],$_POST["employeeID"]))
	{
		$sID=getStockTakeID($con);
		for ($i=0; $i<$_POST["num"]; $i++) { 
			if(addStocktakeProduct($con,$sID,$_POST["warehouseID"],$_POST["productIDs"][$i],$_POST["productQtys"][$i],$_POST["differenceQty"][$i]))
			{
				if($stopCount==$i)
				{
					addAuditForStocktake($con,$_POST["warehouseID"]);
					echo "T,Stock Take Saved Successfully!";
				}
			}
			else
			{
				echo "F,Product Not Added".$i;
			}
		}
	}
	else
	{
		echo "F,Stocktake not added";
	}
	mysqli_close($con);
?>