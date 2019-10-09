<?php
	include_once("connection.php");
	function getAccountTransactions($con,$id)
	{
		$get_query="SELECT A.AMOUNT_PAID,A.PAYMENT_TYPE_ID,A.PAYMENT_DATE,A.SALE_ID AS TRANSACTION_ID 
			FROM PAYMENT A
			JOIN SALE B ON A.SALE_ID=B.SALE_ID
			WHERE A.PAYMENT_TYPE_ID=2 AND B.CUSTOMER_ID='$id'
			UNION
			SELECT AMOUNT_PAID,PAYMENT_TYPE_ID,PAYMENT_DATE,ACCOUNT_PAYMENT_ID AS TRANSACTION_ID
			FROM ACCOUNT_PAYMENT
			WHERE CUSTOMER_ID='$id'
			ORDER BY PAYMENT_DATE";
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

	$transactions=getAccountTransactions($con,$_POST["customerID"]);
	echo json_encode($transactions);
	mysqli_close($con);

?>