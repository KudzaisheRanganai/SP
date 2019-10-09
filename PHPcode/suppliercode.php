<?php
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
	if($_POST["choice"]==3)
	{
		$name=$_POST["name"];
		$vat=$_POST["vat"];
		$contact=$_POST["contact"];
		$email=$_POST["email"];
		$sql_query ="INSERT INTO SUPPLIER (NAME,VAT_NUMBER,CONTACT_NUMBER,EMAIL)
		VALUES('$name','$vat','$contact','$email')";
		$result = mysqli_query($con,$sql_query);
		if($result)
		{
			echo "True";
		}
		else
		{
			echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
		}
	}
	mysqli_close($con);
?>