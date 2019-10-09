<?php
	include_once("connection.php");

	function getDeliveryInfo($con,$id)
	{
		$get_query="SELECT A.DCT_STATUS_ID,A.SALE_ID,B.SALE_AMOUNT,C.CUSTOMER_ID,C.NAME AS CUSTOMER_NAME,C.SURNAME AS CUSTOMER_SURNAME,C.EMAIL,C.CONTACT_NUMBER,D.NAME AS EMPLOYEE_NAME,B.SALE_DATE,
			CONCAT(E.ADDRESS_LINE_1,', ',F.NAME,', ',F.ZIPCODE,', ',G.CITY_NAME,', South Africa') AS ADDRESS_NAME
			FROM DELIVERY A
			JOIN SALE B ON A.SALE_ID=B.SALE_ID
			JOIN CUSTOMER C ON B.CUSTOMER_ID=C.CUSTOMER_ID
			JOIN EMPLOYEE D ON B.EMPLOYEE_ID=D.EMPLOYEE_ID
			JOIN ADDRESS E ON A.ADDRESS_ID=E.ADDRESS_ID
			JOIN SUBURB F ON E.SUBURB_ID=F.SUBURB_ID
			JOIN CITY G ON F.CITY_ID=G.CITY_ID
			WHERE A.SALE_ID='$id'";
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

	$delInfo=getDeliveryInfo($con,$_POST["SALE_ID"]);
	echo json_encode($delInfo);
	mysqli_close($con);
?>