<?php
	include_once("../../sessionCheckPages.php");
	include_once("DBConnection.php");

	//Check connection
		
		if (!$DBConnect) {
		  die("Connection failed: " . mysqli_connect_error());
		}
		$customerID = $_POST["ID"];




		$update_query="DELETE FROM CUSTOMER WHERE CUSTOMER_ID='$customerID'";
		if(mysqli_query($DBConnect,$update_query)){

			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.4';
		    $changes="ID : ".$customerID;
		    $userID = $_SESSION['userID'];
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($DBConnect,$audit_query);
			echo "success";
		}
		else
		{
			echo "failed";
		}	

		mysqli_close($DBConnect);

?>