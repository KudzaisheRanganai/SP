<?php
		
	 //db connection
    include_once("DBConnection.php");

    //Check connection
    if (!$DBConnect) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else
    {


		$sql_query ="SELECT AUDIT_LOG.AUDIT_DATE, EMPLOYEE.NAME AS EMPLOYEE_NAME,EMPLOYEE.SURNAME ,SUB_FUNCTIONALITY.NAME AS SUB_FUNCTIONALITY_NAME, AUDIT_LOG.CHANGES 
			FROM AUDIT_LOG 
			INNER JOIN USER ON AUDIT_LOG.USER_ID = USER.USER_ID 
			INNER JOIN EMPLOYEE ON USER.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
			INNER JOIN SUB_FUNCTIONALITY ON AUDIT_LOG.SUB_FUNCTIONALITY_ID = SUB_FUNCTIONALITY.SUB_FUNCTIONALITY_ID ORDER BY AUDIT_LOG.AUDIT_LOG_ID DESC";
	    $result = mysqli_query($DBConnect,$sql_query);
	    //$row = mysqli_fetch_array($result);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
	        }
	        $json_data=json_encode($vals);
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        file_put_contents('export_audit.json', $json_data);
	        
	    }
	    else{
	         echo "Error";
	    }

	    mysqli_close($DBConnect);

	  }
?>