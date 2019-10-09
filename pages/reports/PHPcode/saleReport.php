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
        
        $salePeriod = $_POST['SALEPERIOD'];
        //var_dump($salePeriod);
        //var_dump($dateFrom);
        $date = date("Y-m-d");
        //var_dump($dateTo);

        $currentDate = new DateTime($date);
        $currentDate = $currentDate->format("Y-m-d");
        $endDate;
        $previousDate;
        $alles_query;
        $submit;
        if($salePeriod=="Daily")
        {

            $alles_query ="SELECT CAST(SALE_DATE AS DATE) AS SALE_DATE ,SUM(SALE_AMOUNT) as SALE_AMOUNT,COUNT(SALE_ID) as TOTAL_SALES
                                FROM SALE
                                WHERE SALE_DATE LIKE '%$currentDate%'
                                GROUP BY CAST(SALE_DATE AS DATE)";
    
            $submit = mysqli_query($DBConnect,$alles_query);
            //var_dump($alles_query);
        }
        else if($salePeriod=="Weekly")
        {
            $today = mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                );
                $TodaysDate = date("Y-m-d H:i:s",$today);
                $newDate = new DateTime($TodaysDate);
                $newDate =  $newDate->format("Y-m-d");



            $endDate=mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")-8, date("Y")
                );
                $previousDate = date("Y-m-d H:i:s",$endDate);
                $usedDate = new DateTime($previousDate);
                $usedDate =  $usedDate->format("Y-m-d");

                $alles_query ="SELECT CAST(SALE_DATE AS DATE) AS SALE_DATE ,SUM(SALE_AMOUNT) as SALE_AMOUNT,COUNT(SALE_ID) as TOTAL_SALES
                                FROM SALE
                                WHERE SALE_DATE BETWEEN '$usedDate' AND  '$newDate'
                                GROUP BY CAST(SALE_DATE AS DATE)";

               // var_dump($alles_query);
        
                $submit = mysqli_query($DBConnect,$alles_query);
        }
        else
        {


            $today = mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                );
                $TodaysDate = date("Y-m-d H:i:s",$today);
                $newDate = new DateTime($TodaysDate);
                $newDate =  $newDate->format("Y-m-d");

            $endDate=mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")-31, date("Y")
                );
                $previousDate = date("Y-m-d",$endDate);

                $usedDate = new DateTime($previousDate);
                $usedDate =  $usedDate->format("Y-m-d");

                $alles_query ="SELECT CAST(SALE_DATE AS DATE) AS SALE_DATE ,SUM(SALE_AMOUNT) as SALE_AMOUNT,COUNT(SALE_ID) as TOTAL_SALES
                                FROM SALE
                                WHERE SALE_DATE BETWEEN '$usedDate' AND  '$newDate'
                                GROUP BY CAST(SALE_DATE AS DATE)";
        
                $submit = mysqli_query($DBConnect,$alles_query);
        }

        

        $employee_ID=" ";

		
        //var_dump($alles_query);
        
       /* $filterID = [];

        while($max = mysqli_fetch_assoc($submit))
        {
            $prodID = $max['PRODUCT_ID'];
            $findIDs = "SELECT COUNT($prodID) as maxProducTID
                        FROM SALE_PRODUCT
                        WHERE PRODUCT_ID = '$prodID'";
            $IDresult = mysqli_query($DBConnect,$findIDs);
            $idRow = mysqli_fetch_assoc($IDresult);


            array_push($filterID,$idRow["maxProducTID"]);
        }
        $maxProductID = max()
        //$row = mysqli_fetch_array($result);*/
        
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
			$changes=$changes." | Sale Report Generated"." | Sales Period :".$salePeriod;
			
			$DateAudit = date('Y-m-d H:i:s');
			$Functionality_ID='12.1';
			$userID = $_SESSION['userID'];
			$audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
			$audit_result=mysqli_query($DBConnect,$audit_query);  

	        //$vals['time_in']="d";
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else{
	         echo json_encode("Empty");
	    }

        mysqli_close($DBConnect);

	?>