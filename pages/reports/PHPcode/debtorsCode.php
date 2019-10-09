<?php		
		include_once("../../sessionCheckPages.php");

		$url = 'mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';
	
		$dbparts = parse_url($url);

		$hostname = $dbparts['host'];
		$username = $dbparts['user'];
		$password = $dbparts['pass'];
		$database = ltrim($dbparts['path'],'/');

		$con = mysqli_connect($hostname, $username, $password, $database);

		//Check connection
		if (!$con) {
		  die("Connection failed: " . mysqli_connect_error());
		}

		$employee_ID=" ";

		$sql_query ="SELECT CUSTOMER_ACCOUNT.ACCOUNT_NO, CUSTOMER_ACCOUNT.CUSTOMER_ID ,CUSTOMER_ACCOUNT.BALANCE,CUSTOMER.NAME ,CUSTOMER.SURNAME FROM CUSTOMER_ACCOUNT INNER JOIN CUSTOMER ON CUSTOMER_ACCOUNT.CUSTOMER_ID=CUSTOMER.CUSTOMER_ID ";
	    $result = mysqli_query($con,$sql_query);
		//$row = mysqli_fetch_array($result);
		
		$getIDQuery = "SELECT * FROM USER WHERE USER_ID='$userID'";
		$subIDQuery = mysqli_query($con , $getIDQuery);

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
			$audit_result=mysqli_query($con,$audit_query);  

	        //$vals['time_in']="d";
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else{
	         echo "Empty";
	    }

	?>