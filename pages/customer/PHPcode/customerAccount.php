<?php
	//var_dump($_FILES);



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
		$customerID = $_POST["customerID"];
		//echo $customerID;
		$get_query="SELECT * FROM CUSTOMER_ACCOUNT WHERE CUSTOMER_ID='$customerID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			echo json_encode( $row);
			
		}
		else
		{
			echo "False";
		}

		mysqli_close($con);

?>