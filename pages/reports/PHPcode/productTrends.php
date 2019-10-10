<?php		
        include_once("../../sessionCheckPages.php");
        
		include_once("DBConnection.php");

		//Check connection
		if (!$DBConnect) {
          die("Connection failed: " . mysqli_connect_error());
          
          
		}

		/*$day=$_POST['DATE'];
		// $day='2019-08-21';
		$date=date_create($day);
        $date=date_format($date,"Y-m-d");*/
        
        $dateFrom = $_POST['DATEFROM'];
        //var_dump($dateFrom);
        $dateTo = $_POST['DATETO'];
        //var_dump($dateTo);

        $startDate = new DateTime($dateFrom);
        $startDate = $startDate->format("Y-m-d");

        $endDate = new DateTime($dateTo);
        $endDate = $endDate->format("Y-m-d");

        $sql="SELECT  *
        FROM SALE
        ORDER BY SALE_DATE DESC 
        LIMIT 1 ";
        $query = mysqli_query($DBConnect, $sql);

        $dateModified;

        if (mysqli_num_rows($query)>0) 
        {
            while ($row= $query->fetch_assoc())
	        {
                if($row["SALE_DATE"] < $endDate)
                {
                    $endDate = $row["SALE_DATE"] ;
                }
                else
                {

                }
	        }
        }

		$alles_query ="SELECT SALE.SALE_DATE ,SALE_PRODUCT.PRODUCT_ID , SALE_PRODUCT.SELLING_PRICE, SUM(SALE_PRODUCT.QUANTITY) as TOTAL_PRODUCT_QUANTITY ,PRODUCT.PRODUCT_MEASUREMENT,PRODUCT.PRODUCT_MEASUREMENT_UNIT, PRODUCT.NAME ,PRODUCT.CASES_PER_PALLET,PRODUCT.UNITS_PER_CASE , PRODUCT.PRODUCT_SIZE_TYPE ,PRODUCT_TYPE.TYPE_NAME,PRODUCT_TYPE.PRODUCT_TYPE_ID
                    FROM SALE_PRODUCT 
                    INNER JOIN SALE ON SALE_PRODUCT.SALE_ID = SALE.SALE_ID
                    INNER JOIN PRODUCT ON PRODUCT.PRODUCT_ID=SALE_PRODUCT.PRODUCT_ID
                    INNER JOIN PRODUCT_TYPE ON PRODUCT_TYPE.PRODUCT_TYPE_ID = PRODUCT.PRODUCT_TYPE_ID
                    WHERE SALE.SALE_DATE BETWEEN '$startDate' AND '$endDate' 
                    GROUP BY PRODUCT.PRODUCT_ID
                    ORDER BY COUNT(PRODUCT.PRODUCT_ID) DESC";
            
        $submit = mysqli_query($DBConnect,$alles_query);
     
        $employee_ID=" ";

        $getIDQuery = "SELECT * FROM USER WHERE USER_ID='$userID'";
        $subIDQuery = mysqli_query($DBConnect , $getIDQuery);

        if(mysqli_num_rows($subIDQuery)>0)
        {
            if($rowID= mysqli_fetch_assoc($subIDQuery))
            {
              $employee_ID = $rowID["EMPLOYEE_ID"];
            }
        }

        if (mysqli_num_rows($submit)>0) 
        {


          

	        $count=0;
	        while ($row= $submit->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
            }
            
            $changes="";
			$changes="ID :".$employee_ID;
			$changes=$changes." | Product Trends Report Generated"." | Product Trend Start Period :".$startDate. " | Product Trend End Period :".$endDate;
			
			$DateAudit = date('Y-m-d H:i:s');
			$Functionality_ID='12.4';
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