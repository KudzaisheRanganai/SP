<?php
		
	 //db connection
    include_once("DBConnection.php");

    //Check connection
    if (!$DBConnect) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else
    {


		$sql_query ="SELECT * FROM SUB_FUNCTIONALITY";
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
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else{
	         echo "Error: " . $sql_query. "<br>" . mysqli_error($DBConnect);
	    }
	    
	    mysqli_close($DBConnect);
	 }
?>