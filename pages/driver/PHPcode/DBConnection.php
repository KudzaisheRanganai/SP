<?php
	
	date_default_timezone_set('Africa/Johannesburg');

	define('DB_SERVER','localhost');
	define('DB_USERNAME','stockofc_sp');
	define('DB_PASSWORD','@System111');
	define('DB_NAME','stockofc_stockpath');

	/* Attempt to connect to MySQL database */
	$DBConnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
   
?>