<?php

	include_once("DBConnection.php");

	if($DBConnect === false)
	{
		//Send error response
	  	$response = "databaseError";
      	echo $response;
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		$accessLevelID = $_POST['accessLevelID'];

		$userSubFunctionalityQ = "SELECT * FROM ACCESS_LEVEL_SUB_FUNCTIONALITY WHERE ACCESS_LEVEL_ID ='$accessLevelID'";
        $userSubFunctionalityQResult = mysqli_query($DBConnect, $userSubFunctionalityQ);

        $subFunctionality = array();
        while( $functionality = mysqli_fetch_array($userSubFunctionalityQResult))
        { 
            array_push($subFunctionality, $functionality['SUB_FUNCTIONALITY_ID']);
        }

        echo json_encode($subFunctionality);

	    mysqli_close($DBConnect);
	}
?>