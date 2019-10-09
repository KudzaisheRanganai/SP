<?php
	function checkExistance($con,$id)
	{
		$get_query="SELECT ORDER_ID AS EXIST_ID
		FROM ORDER_PRODUCT
		WHERE PRODUCT_ID='$id'
		UNION
		SELECT SALE_ID AS EXIST_ID
		FROM SALE_PRODUCT
		WHERE PRODUCT_ID='$id'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			// while($get_row=$get_result->fetch_assoc())
			// {
			// 	$get_vals[]=$get_row;
			// }
			return true;
		}
		else
		{
			return false;
		}
	}

	function addAudit($con,$name)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID="8.7";
		$userID = $_SESSION['userID'];
		$changes="Product Name : ".$name;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function deleteProduct($con,$id)
	{
		$delete_query="DELETE FROM PRODUCT WHERE PRODUCT_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

  	$productName = "";
	$productDescription = "";
	$productType = "";
	$unitsInCase = "";
	$casesInPallet = "";
	$costPrice = "";
	$discountPrice = "";
	$sellingPrice = "";
	$measurement = "";
	$measurementUnit = "";

	$url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

	$dbparts = parse_url($url);

	$hostname = $dbparts['host'];
	$username = $dbparts['user'];
	$password = $dbparts['pass'];
	$database = ltrim($dbparts['path'],'/');

	$DBConnect = mysqli_connect($hostname, $username, $password, $database);

	if($DBConnect === false)
	{
		//Send error response
	  	$response = "databaseError";
      	echo $response;
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
			$pDelete=(int)$_POST["PRODUCT_GROUP_ID_"];
			$pDelBro=$pDelete+1;
			$pDelSis=$pDelete+2;
			if(checkExistance($DBConnect,$pDelete))
			{
				echo "F,SYSTEM RESTRICT: This Product cannot be deleted from the system";
			}
			else
			{
				if(checkExistance($DBConnect,$pDelBro))
				{
					echo "F,SYSTEM RESTRICT: This Product cannot be deleted from the system";
				}
				else
				{
					if(checkExistance($DBConnect,$pDelSis))
					{
						echo "F,SYSTEM RESTRICT: This Product cannot be deleted from the system";
					}
					else
					{
						deleteProduct($DBConnect,$pDelete);
						deleteProduct($DBConnect,$pDelBro);
						deleteProduct($DBConnect,$pDelSis);
						addAudit($DBConnect,$_POST["PRODUCT_NAME_"]);
						echo "T,Product Deleted Successfully";
					}
				}
			}

	      	//Close database connection
			mysqli_close($DBConnect);

			
	}
?>