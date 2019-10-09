<?php
	//var_dump($_FILES);

	include_once("../../sessionCheckPages.php");

	include_once("DBConnection.php");

	//Check connection
	
		if (!$DBConnect) {
		  die("Connection failed: " . mysqli_connect_error());
		}
		$customerID = $_POST["customerID"];		
		$limit = $_POST["credit-limit"];
		$update_query="UPDATE CUSTOMER_ACCOUNT SET CREDIT_LIMIT='$limit' WHERE CUSTOMER_ID='$customerID'";
		if(mysqli_query($DBConnect,$update_query)){
			//audit step
			$last_id=$customerID;
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.7';
		    $userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($DBConnect,$audit_query);
		        if($audit_result)
		        {
		          
		        }
		        else
		        {
		          
		        }
			echo "success";
		}
		else
		{
			echo "failed";
		}	

		mysqli_close($DBConnect);

?>