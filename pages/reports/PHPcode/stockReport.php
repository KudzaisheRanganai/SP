<?php
include_once("../../sessionCheckPages.php");
	include_once("DBConnection.php");

	if($DBConnect === false)
	{
		//Send error response
	  	$response = "databaseError";
      	echo $response;
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		$employee_ID=" ";

		$sql_query = "
		SELECT PRODUCT_GROUP_ID,PRODUCT_ID, NAME, PRODUCT_DESCR, CASES_PER_PALLET, UNITS_PER_CASE, COST_PRICE, GUIDE_DISCOUNT, SELLING_PRICE, PRODUCT_TYPE.TYPE_NAME, PRODUCT.PRODUCT_TYPE_ID, PRODUCT_MEASUREMENT, PRODUCT_MEASUREMENT_UNIT,
		MAX(CASE WHEN PRODUCT_SIZE_TYPE = '1' THEN QUANTITY_AVAILABLE END) INDIVIDUAL_QUANTITY,
		MAX(CASE WHEN PRODUCT_SIZE_TYPE = '2' THEN QUANTITY_AVAILABLE END) CASES_QUANTITY,
		MAX(CASE WHEN PRODUCT_SIZE_TYPE = '3' THEN QUANTITY_AVAILABLE END) PALLETS_QUANTITY
		FROM PRODUCT LEFT JOIN PRODUCT_TYPE ON PRODUCT_TYPE.PRODUCT_TYPE_ID = PRODUCT.PRODUCT_TYPE_ID
		GROUP BY PRODUCT_GROUP_ID
		ORDER BY NAME";
		$result = mysqli_query($DBConnect,$sql_query);
		

		$getIDQuery = "SELECT * FROM USER WHERE USER_ID='$userID'";
		$subIDQuery = mysqli_query($DBConnect , $getIDQuery);

		if(mysqli_num_rows($subIDQuery)>0)
		{
			if($rowID= mysqli_fetch_assoc($subIDQuery))
			{
			  $employee_ID = $rowID["EMPLOYEE_ID"];
			}
		}

	    if (mysqli_num_rows($result)>0) {

			  

	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
			}
			
			$changes="";
			$changes="ID :".$employee_ID;
			$changes=$changes." | Stock Report Generated";
			
			$DateAudit = date('Y-m-d H:i:s');
			$Functionality_ID='12.2';
			$userID = $_SESSION['userID'];
			$audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
			$audit_result=mysqli_query($DBConnect,$audit_query);

	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else
	    {
	        echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	    }
	    mysqli_close($DBConnect);
	}
?>