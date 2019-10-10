<?php
	//echo var_dump($_POST);
	if(!empty($_POST['data'])){ 
		$data = base64_decode($_POST['data']);
		//$data = $_POST['data'];
		//echo(var_dump($data));
		$name = $_POST['name'];
		$fname = $name.".pdf"; // name the file
		$file = fopen("../../../documents/Order_Invoices/" .$fname, 'w'); // open the file path
		fwrite($file, $data); //save data
		fclose($file);
		echo "PDF Saved successfully";   
	}
	else {
		echo "No Data Sent";
	}
?>