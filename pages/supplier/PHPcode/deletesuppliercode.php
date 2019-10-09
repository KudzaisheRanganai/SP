<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	if(deleteSupplier($con,$_POST["SUPPLIER_ID"]))
	{
		echo "T,Supplier Deleted Successfully";
	}
	else
	{
		echo "F,SYSTEM RESTRICT: Supplier Cannot Be Deleted";
	}
?>