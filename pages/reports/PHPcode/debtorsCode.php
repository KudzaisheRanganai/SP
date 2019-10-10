<?php		
		include_once("../../sessionCheckPages.php");

		include_once("DBConnection.php");

		//Check connection
		if (!$DBConnect) {
		  die("Connection failed: " . mysqli_connect_error());
		}

		$employee_ID=" ";

		$sql_query ="SELECT CUSTOMER_ACCOUNT.ACCOUNT_NO, CUSTOMER_ACCOUNT.CUSTOMER_ID ,CUSTOMER_ACCOUNT.BALANCE,CUSTOMER.NAME ,CUSTOMER.SURNAME FROM CUSTOMER_ACCOUNT INNER JOIN CUSTOMER ON CUSTOMER_ACCOUNT.CUSTOMER_ID=CUSTOMER.CUSTOMER_ID ";
	    $result = mysqli_query($DBConnect,$sql_query);
		//$row = mysqli_fetch_array($result);
		
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
			$changes=$changes." | Debtors Report Generated";

			$DateAudit = date('Y-m-d H:i:s');
            $Functionality_ID='12.5';
            $userID = $_SESSION['userID'];
            $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
			$audit_result=mysqli_query($DBConnect,$audit_query);  

	        //$vals['time_in']="d";
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else{
	         echo "Empty";
	    }

	    mysqli_close($DBConnect);

	?>