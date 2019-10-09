<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");

	function recordPayment($con,$amount,$orderid,$dte)
	{
		$add_query="INSERT INTO SUPPLIER_ACCOUNT_PAYMENT (AMOUNT_PAID,ORDER_ID,PAYMENT_DATE) VALUES ('$amount','$orderid','$dte')";
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

	function updateSupplierAccount($con,$amount,$id)
	{
		$update_query="UPDATE SUPPLIER_ACCOUNT SET AMOUNT_OWED=AMOUNT_OWED-'$amount' WHERE SUPPLIER_ID='$id'";
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

	function updateOrderPaid($con,$orderid)
	{
		$update_query="UPDATE ORDER_ SET ORDER_PAID=1 WHERE ORDER_ID='$orderid'";
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

	

	$dte=Date('Y-m-d');
	if(recordPayment($con,$_POST["amount"],$_POST["orderID"],$dte))
	{
		if(updateOrderPaid($con,$_POST["orderID"]))
		{
			if(updateSupplierAccount($con,$_POST["amount"],$_POST["supplierID"]))
			{
				$DateAudit = date('Y-m-d H:i:s');
			    $Functionality_ID='5.8';
			    $userID = $_SESSION['userID'];
			    $changes="Order ID : ".$_POST["orderID"];
		        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
		        $audit_result=mysqli_query($con,$audit_query);
				echo "T,Supplier Order Payment Recorded Successfully";
			}
			else
			{
				echo "F,Supplier Account Not Updated";
			}	
		}
		else
		{
			echo "F,Order Not Updated";
		}
		
	}
	else
	{
		echo "F,Payment not recorded";
	}
?>