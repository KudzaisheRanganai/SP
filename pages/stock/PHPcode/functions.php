<?php
	function getWarehouseDetails($con)
	{
		$get_query="SELECT * FROM WAREHOUSE";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	////////////////////////////////////
	function getProductDetails($con)
	{
		$get_query="SELECT * FROM PRODUCT";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	////////////////////////////////////////////
	function getWarehouseProductDetails($con)
	{
		$get_query="SELECT * FROM WAREHOUSE_PRODUCT";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	////////////////////////////////////////////////////
	function updateWarehouseProductQty($con,$wID,$pID,$qty)
	{
		$update_query="UPDATE WAREHOUSE_PRODUCT SET QUANTITY=QUANTITY+'$qty' WHERE WAREHOUSE_ID='$wID' AND PRODUCT_ID='$pID'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////
	function reduceWarehouseProductQty($con,$wID,$pID,$qty)
	{
		$update_query="UPDATE WAREHOUSE_PRODUCT SET QUANTITY=QUANTITY-'$qty' WHERE WAREHOUSE_ID='$wID' AND PRODUCT_ID='$pID'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////////////////
	function checkWarehouseProduct($con,$wID,$pID)
	{
		$check_query="SELECT * FROM WAREHOUSE_PRODUCT WHERE WAREHOUSE_ID='$wID' AND PRODUCT_ID='$pID'";
		$check_result=mysqli_query($con,$check_query);
		if(mysqli_num_rows($check_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////
	function addWarehouseProduct($con,$wID,$pID,$qty)
	{
		$add_query="INSERT INTO WAREHOUSE_PRODUCT (WAREHOUSE_ID,PRODUCT_ID,QUANTITY) VALUES('$wID','$pID','$qty')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////////
	function updateQtyReceived($con,$orderid,$id,$qty)
	{
		$update_query="UPDATE ORDER_PRODUCT SET QUANTITY_RECEIVED=QUANTITY_RECEIVED+'$qty' WHERE ORDER_ID='$orderid' AND PRODUCT_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	function updateQtyToReceive($con,$orderid,$id,$qty)
	{
		$update_query="UPDATE ORDER_PRODUCT SET QUANTITY_TO_RECEIVE='$qty' WHERE ORDER_ID='$orderid' AND PRODUCT_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateProductQty($con,$id,$qty)
	{
		$update_query="UPDATE PRODUCT SET QTY_ON_HAND=QTY_ON_HAND +'$qty',QUANTITY_AVAILABLE=QUANTITY_AVAILABLE+'$qty' WHERE PRODUCT_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function countReceivedQuantity($con,$orderid)
	{
		$get_query="SELECT SUM(QUANTITY_TO_RECEIVE) AS FINAL
			FROM ORDER_PRODUCT
			WHERE ORDER_ID='$orderid'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}

	function updateOrderReceived($con,$orderid,$dte)
	{
		$update_query="UPDATE ORDER_ SET DATE_RECEIVED='$dte',ORDER_STATUS_ID=2 WHERE ORDER_ID='$orderid'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function getWarehouseStockDetails($con)
	{
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME,
			E.TYPE_NAME
			FROM WAREHOUSE_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID
			JOIN PRODUCT_TYPE E ON D.PRODUCT_TYPE_ID=E.PRODUCT_TYPE_ID";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}

	function addStockTake($con,$dte,$userID,$empID)
	{
		$add_query="INSERT INTO STOCKTAKE (STOCKTAKE_DATE,USER_ID,EMPLOYEE_ID) VALUES('$dte','$userID','$empID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function getStockTakeID($con)
	{
		$get_query="SELECT * FROM STOCKTAKE ORDER BY STOCKTAKE_ID DESC LIMIT 1";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$sID=$row["STOCKTAKE_ID"];
		}
		else
		{
			$sID="City ID does not exist";
		}
		return $sID;
	}

	function addStocktakeProduct($con,$sID,$wID,$pID,$qty,$qtydiff)
	{
		$add_query="INSERT INTO STOCKTAKE_PRODUCT (STOCKTAKE_ID,WAREHOUSE_ID,PRODUCT_ID,NUMBER_COUNTED,QTY_DIFFERENCE) VALUES('$sID','$wID','$pID','$qty','$qtydiff')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function getWriteOffProductDetails($con,$id)
	{
		$get_query="SELECT A.*,B.NAME FROM WAREHOUSE_PRODUCT A JOIN WAREHOUSE B ON A.WAREHOUSE_ID=B.WAREHOUSE_ID WHERE A.PRODUCT_ID='$id' AND A.QUANTITY<>0";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}

	function addWriteoff($con,$wID,$pID,$qty,$reason,$dte)
	{
		$add_query="INSERT INTO WRITEOFF (WAREHOUSE_ID,PRODUCT_ID,QUANTITY,WRITEOFF_REASON,WRITEOFF_DATE) VALUES('$wID','$pID','$qty','$reason','$dte')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateProductQtyWriteoff($con,$id,$qty)
	{
		$update_query="UPDATE PRODUCT SET QTY_ON_HAND=QTY_ON_HAND -'$qty',QUANTITY_AVAILABLE=QUANTITY_AVAILABLE-'$qty' WHERE PRODUCT_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function addAuditForReceiveStock($con,$orderid,$status)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='9.1';
		$userID = $_SESSION['userID'];
		$changes="Order ID : ".$orderid."| Order Status : ".$status;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForReturnStock($con,$orderid,$reason)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='9.3';
		$userID = $_SESSION['userID'];
		$changes="Order ID : ".$orderid."| Reason : ".$reason;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForWriteoffStock($con,$last_id,$warehouseid,$productid,$reason)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='9.2';
		$userID = $_SESSION['userID'];
		$changes="Writeoff ID : ".$last_id."| Warehouse ID : ".$warehouseid."| Product ID : ".$productid."| Reason : ".$reason;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForConvertStock($con,$productid,$productid2,$groupid)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='9.4';
		$userID = $_SESSION['userID'];
		$changes="Product : ".$productid."| Converted Product : ".$productid2."| Product Group ID : ".$groupid;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForPlaceStock($con,$productid,$productid2)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='9.5';
		$userID = $_SESSION['userID'];
		$changes="Source Warehouse : ".$productid."| Destination Warehouse : ".$productid2;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForStocktake($con,$productid)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='9.6';
		$userID = $_SESSION['userID'];
		$changes="Warehouse of Stocktake : ".$productid;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function getProductName($con,$id)
	{
		$get_query="SELECT CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME,D.PRODUCT_GROUP_ID
			FROM PRODUCT D
			WHERE D.PRODUCT_ID='$id'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}

?>