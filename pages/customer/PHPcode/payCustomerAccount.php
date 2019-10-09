<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	function getAccountNo($con,$id)
	{
		$get_query="SELECT * FROM CUSTOMER_ACCOUNT WHERE CUSTOMER_ID='$id'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["ACCOUNT_NO"];
		}
		else
		{
			$cityID="City ID does not exist";
		}
		return $cityID;
	}

	function captureAccountPayment($con,$accid,$custid,$amount,$dte)
	{
		$add_query="INSERT INTO ACCOUNT_PAYMENT (ACCOUNT_NO,CUSTOMER_ID,AMOUNT_PAID,PAYMENT_DATE,PAYMENT_TYPE_ID) VALUES('$accid','$custid','$amount','$dte',3)";
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

	function updateCustomerAccount($con,$amount,$id)
	{
		$update_query="UPDATE CUSTOMER_ACCOUNT SET BALANCE=BALANCE-'$amount' WHERE CUSTOMER_ID='$id'";
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

	function addAuditForPayAccount($con,$customerid,$amount)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='1.8';
		$userID = $_SESSION['userID'];
		$changes="Customer ID : ".$customerid."| Amount : ".$amount;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	$accountNo=getAccountNo($con,$_POST["customerID"]);
	$dte=Date('Y-m-d');
	if(captureAccountPayment($con,$accountNo,$_POST["customerID"],$_POST["amount"],$dte))
	{
		updateCustomerAccount($con,$_POST["amount"],$_POST["customerID"]);
		addAuditForPayAccount($con,$_POST["customerID"],$_POST["amount"]);
		echo "T";
	}
	else
	{
		echo "F";
	}
?>