<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	if($_POST["choice"]==1)
	{
		// $saleID=$_POST["SALE_ID"];
		// $date=$_POST["dDate"];
		// $dct=1;
		// $addressID=$_POST["ADDRESS_ID"];
		// $add_query="INSERT INTO DELIVERY (SALE_ID,EXPECTED_DATE,ADDRESS_ID,DCT_STATUS_ID) VALUES ('$saleID','$date','$addressID','$dct')";
		// $add_result=mysqli_query($con,$add_query);
		// if($add_result)
		// {
		// 	echo "T,Delivery Added Sucessfully";
		// }
		// else
		// {
		// 	echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
		// }
		if(checkDelivery($con,$_POST["SALE_ID"]))
		{
			echo "F, Delivery Exists";
		}
		else
		{
			if(addDelivery($con,$_POST["SALE_ID"],$_POST["dDate"],$_POST["ADDRESS_ID"],1,$_POST["latitude"],$_POST["longitude"]))
			{
				echo "T,Delivery Added Sucessfully";
			}
			else
			{
				echo "F,Delivery Not Added";
			}
		}
		
	}
	elseif($_POST["choice"]==2)
	{
		if(deleteDelivery($con,$_POST["deliveryID"]))
		{
			echo "T,Delivery Cancelled Successfully";
		}
		else
		{
			echo "F,Delivery not cancelled";
		}
	}
	mysqli_close($con);
?>