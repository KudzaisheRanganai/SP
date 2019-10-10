<?php
	//var_dump($_FILES);

	include_once("DBConnection.php");

	//Check connection
		if (!$DBConnect) {
		  die("Connection failed: " . mysqli_connect_error());
		}
		$customerID = $_POST["customerID"];
		//echo $customerID;
		$get_query="SELECT * FROM CUSTOMER_ACCOUNT WHERE CUSTOMER_ID='$customerID'";
		$get_result=mysqli_query($DBConnect,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			echo json_encode( $row);
			
		}
		else
		{
			echo "False";
		}

		mysqli_close($DBConnect);

?>