<?php
		
	 //db connection
    include_once("DBConnection.php");

    //Check connection
    if (!$DBConnect) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else
    {

    	$username=$_POST["username"];
    	$sub_name=$_POST["sub_name"];
    	$changes=$_POST["changed"];
    	$date=$_POST["date_"];

    	$day=date_format(new DateTime($date), 'Y-m-d');

		$sql_query ="SELECT AUDIT_LOG.AUDIT_DATE, EMPLOYEE.NAME AS EMPLOYEE_NAME,EMPLOYEE.SURNAME ,SUB_FUNCTIONALITY.NAME AS SUB_FUNCTIONALITY_NAME, AUDIT_LOG.CHANGES 
		FROM AUDIT_LOG 
		INNER JOIN USER ON AUDIT_LOG.USER_ID = USER.USER_ID 
		INNER JOIN EMPLOYEE ON USER.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
		INNER JOIN SUB_FUNCTIONALITY ON AUDIT_LOG.SUB_FUNCTIONALITY_ID = SUB_FUNCTIONALITY.SUB_FUNCTIONALITY_ID
		WHERE ";

		$added=FALSE;
    	$checkdatequery="";
    	if($date!=""){
    		$checkdatequery="CAST(AUDIT_DATE AS DATE) = '$date' ";
    		$sql_query=$sql_query.$checkdatequery;
    		$added=TRUE;
    	}



    	if($sub_name!="none"){
    		$checkSub=" SUB_FUNCTIONALITY.NAME='$sub_name'";
    		if($added){
    			$sql_query=$sql_query." AND".$checkSub;
    		}
    		else{
    			$sql_query=$sql_query.$checkSub;
    			$added=TRUE;
    		}

    	}

    	 if($username!=""){
    		$checkName=" EMPLOYEE.NAME LIKE '%$username%'";
    		if($added){
    			$sql_query=$sql_query." AND".$checkName;
    		}
    		else{
    			$sql_query=$sql_query.$checkName;
    			$added=TRUE;
    		}

    	}

    	if($changes!=""){
    		$checkchanges=" AUDIT_LOG.CHANGES LIKE '%$changes%'";
    		if($added){
    			$sql_query=$sql_query." AND".$checkchanges;
    		}
    		else{
    			$sql_query=$sql_query.$checkchanges;
    			$added=TRUE;
    		}

    	}
    	
    	//EMPLOYEE.NAME LIKE '%$username%' AND SUB_FUNCTIONALITY.NAME='$sub_name' AND AUDIT_LOG.CHANGES LIKE '%$changes%' AND


		
	    $result = mysqli_query($DBConnect,$sql_query);
	    //$row = mysqli_fetch_array($result);
	    //var_dump( $result);
	    if($result){
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
	        
	    }


	    }
	    else{
	         echo "Error";
	    }

	 
        mysqli_close($DBConnect);
	}
?>