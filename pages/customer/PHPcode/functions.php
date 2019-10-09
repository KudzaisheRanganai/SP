<?php
	// include_once("connection.php");
	
	// echo $userID;
	function getSupplierAddressIDs($con,$supID)
	{
		$get_query="SELECT ADDRESS_ID FROM SUPPLIER_ADDRESS WHERE SUPPLIER_ID='$supID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	function getAddressInfo($con,$addID)
	{
		$get_query="SELECT * FROM ADDRESS WHERE ADDRESS_ID='$addID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$addressInfo=$row;
		}
		else
		{
			$addressInfo="Address does not exist";
		}
		return $addressInfo;
	}

	function getSuburbInfo($con,$subID)
	{
		$get_query="SELECT * FROM SUBURB WHERE SUBURB_ID='$subID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$suburbInfo=$row;
		}
		else
		{
			$suburbInfo="Address does not exist";
		}
		return $suburbInfo;
	}

	function getCityInfo($con,$cityID)
	{
		$get_query="SELECT * FROM CITY WHERE CITY_ID='$cityID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityInfo=$row;
		}
		else
		{
			$cityInfo="Address does not exist";
		}
		return $cityInfo;
	}
	///////////////////////////////////////////////////
	////////////////////////////////////////////////////
	function checkSuburb($con,$suburbName)
	{
		$suburb_query="SELECT * FROM SUBURB WHERE NAME='$suburbName'";
		$suburb_result=mysqli_query($con,$suburb_query);
		if(mysqli_num_rows($suburb_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
		

	}
	///////////////////////////////
	function checkCity($con,$cityName)
	{
		$city_query="SELECT * FROM CITY WHERE CITY_NAME='$cityName'";
		$city_result=mysqli_query($con,$city_query);
		if(mysqli_num_rows($city_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////
	function addSuburb($con,$suburbName,$cityID,$zip)
	{
		$add_query="INSERT INTO SUBURB (NAME,ZIPCODE,CITY_ID) VALUES ('$suburbName','$zip','$cityID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////
	function addCity($con,$cityName)
	{
		$add_query="INSERT INTO CITY (CITY_NAME) VALUES('$cityName')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////
	function getCityID($con,$cityName)
	{
		$get_query="SELECT * FROM CITY WHERE CITY_NAME='$cityName'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["CITY_ID"];
		}
		else
		{
			$cityID="City ID does not exist";
		}
		return $cityID;
	}
	/////////////////////////////////////////
	function getSuburbID($con,$suburbName)
	{
		$get_query="SELECT * FROM SUBURB WHERE NAME='$suburbName'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$suburbID=$row["SUBURB_ID"];
		}
		else
		{
			$suburbID="Suburb does now exist";
		}
		return $suburbID;
	}
	/////////////////////////////////////////
	function addressCheck($con,$addressName)
	{
		$address_query="SELECT * FROM ADDRESS WHERE ADDRESS_LINE_1='$addressName'";
		$address_result=mysqli_query($con,$address_query);
		if(mysqli_num_rows($address_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////
	function addAddress($con,$addressName,$suburbID)
	{
		$add_query="INSERT INTO ADDRESS (ADDRESS_LINE_1,SUBURB_ID) VALUES ('$addressName','$suburbID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	////////////////////////////////////
	function getAddressID($con,$addressName)
	{
		$get_query="SELECT * FROM ADDRESS WHERE ADDRESS_LINE_1='$addressName'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$addressID=$row["ADDRESS_ID"];
		}
		else
		{
			$addressID="Address does not exist";
		}
		return $addressID;
	}
	//////////////////////////////////////////
	function checkSupplier($con,$contactNo)
	{
		$supplier_query="SELECT * FROM SUPPLIER WHERE CONTACT_NUMBER ='$contactNo'";
		$supplier_result=mysqli_query($con,$supplier_query);
		if(mysqli_num_rows($supplier_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////
	function addSupplier($con,$name,$vat,$contact,$email)
	{
		$add_query="INSERT INTO SUPPLIER (NAME,VAT_NUMBER,CONTACT_NUMBER,EMAIL) VALUES ('$name','$vat','$contact','$email')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	//////////////////////////////////////////////
	function getSupplierID($con,$contact)
	{
		$get_query="SELECT * FROM SUPPLIER WHERE CONTACT_NUMBER='$contact'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$supplierID=$row["SUPPLIER_ID"];
		}
		else
		{
			$supplierID="Supplier does not exist";
		}
		return $supplierID;
	}
	///////////////////////////////////////////////////
	function addSupplierAddress($con,$addressID,$supplierID)
	{
		$add_query="INSERT INTO SUPPLIER_ADDRESS (ADDRESS_ID,SUPPLIER_ID) VALUES ('$addressID','$supplierID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	////////////////////////////////////////////////////
	function removeSupplierAddress($con,$addressID,$supplierID)
	{
		$delete_query="DELETE FROM SUPPLIER_ADDRESS WHERE ADDRESS_ID='$addressID' AND SUPPLIER_ID='$supplierID'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	/////////////////////////////////////////////////////////
	function updateSupplier($con,$id,$name,$vat,$contact,$email)
	{
		$update_query="UPDATE SUPPLIER SET NAME='$name',VAT_NUMBER='$vat',CONTACT_NUMBER='$contact',EMAIL='$email' WHERE SUPPLIER_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/////////////////////////////////////////////////////////
	function removeAllSupplierAddress($con,$id)
	{
		$delete_query="DELETE FROM SUPPLIER_ADDRESS WHERE SUPPLIER_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////
	function getCustomerAddressIDs($con,$cusID)
	{
		$get_query="SELECT ADDRESS_ID FROM CUSTOMER_ADDRESS WHERE CUSTOMER_ID='$cusID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	/////////////////////////////////////////////////////////
	function getCustomerTypeName($con,$id)
	{
		$get_query="SELECT * FROM CUSTOMER_TYPE WHERE CUSTOMER_TYPE_ID='$id'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////////////////////
	function checkCreditAccount($con,$id)
	{
		$check_query="SELECT * FROM CUSTOMER_ACCOUNT WHERE CUSTOMER_ID='$id'";
		$check_result=mysqli_query($con,$check_query);
		if(mysqli_num_rows($check_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////////
	function getCustomerStatus($con,$id)
	{
		$get_query="SELECT * FROM CUSTOMER_STATUS WHERE STATUS_ID='$id'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////////////////
	function checkCustomer($con,$name,$contact)
	{
		$customer_query="SELECT * FROM CUSTOMER WHERE NAME='$name' AND CONTACT_NUMBER='$contact'";
		$customer_result=mysqli_query($con,$customer_query);
		if(mysqli_num_rows($customer_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////
	function addIndCustomer($con,$name,$surname,$contact,$email,$title,$customerType,$customerStatus)
	{
		$add_query="INSERT INTO CUSTOMER (NAME,SURNAME,EMAIL,CONTACT_NUMBER,TITLE_ID,CUSTOMER_TYPE_ID,STATUS_ID) VALUES ('$name','$surname','$email','$contact','$title','$customerType','$customerStatus')";
		$add_result=mysqli_query($con,$add_query);
		$last_id = mysqli_insert_id($con);
	
		if($add_result)
		{
			
		    $DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.1';
		   $userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id."| Name : ".$name." ".$surname;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
	

			return true;
		}
		else
		{
			return false;
		}	
	}


// addIndCustomer($con,"John","Smither","0736673000","Jh@gmail.com","1","1","1");

	//////////////////////////////////////////////
	function addOrgCustomer($con,$name,$vat,$contact,$email,$customerType,$customerStatus)
	{
		$add_query="INSERT INTO CUSTOMER (NAME,EMAIL,VAT_NUMBER,CONTACT_NUMBER,CUSTOMER_TYPE_ID,STATUS_ID) VALUES ('$name','$email','$vat','$contact','$customerType','$customerStatus')";
		$add_result=mysqli_query($con,$add_query);
		$last_id = mysqli_insert_id($con);
		if($add_result)
		{

			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.1';
		   $userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id."| Name : ".$name;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
	        if($audit_result)
	        {
	          
	        }
	        else
	        {
	          
	        }
			return true;
		}
		else
		{
			return false;
		}	
	}
	//////////////////////////////////////////////
	function getCustomerID($con,$name,$contact)
	{
		$get_query="SELECT * FROM CUSTOMER WHERE NAME='$name' AND CONTACT_NUMBER='$contact'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$customerID=$row["CUSTOMER_ID"];
		}
		else
		{
			$customerID="Customer does not exist";
		}
		return $customerID;
		$get_query="SELECT * FROM SUPPLIER WHERE CONTACT_NUMBER='$contact'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$supplierID=$row["SUPPLIER_ID"];
		}
		else
		{
			$supplierID="Supplier does not exist";
		}
		return $supplierID;
	}
	///////////////////////////////////////////////////
	function addCustomerAddress($con,$addressID,$customerID)
	{
		$add_query="INSERT INTO CUSTOMER_ADDRESS (ADDRESS_ID,CUSTOMER_ID) VALUES ('$addressID','$customerID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	/////////////////////////////////////////////////////////
	function getTitleInfo($con,$titleID)
	{
		$get_query="SELECT * FROM TITLE WHERE TITLE_ID='$titleID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$Info=$row;
		}
		else
		{
			$Info=false;
		}
		return $Info;
	}
	//////////////////////////////////////////////////////////
	function removeCustomerAddress($con,$addressID,$customerID)
	{
		$delete_query="DELETE FROM CUSTOMER_ADDRESS WHERE ADDRESS_ID='$addressID' AND CUSTOMER_ID='$customerID'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	///////////////////////////////////////////////////////////
	function updateIndCustomer($con,$id,$name,$surname,$contact,$email,$title,$customerType,$customerStatus)
	{
		$changes="";
		$customer_query="SELECT * FROM CUSTOMER WHERE CUSTOMER_ID='$id'";
		$customer_result=mysqli_query($con,$customer_query);
		if(mysqli_num_rows($customer_result)>0)
		{
			$row=$customer_result->fetch_assoc();
			$changes="ID :".$row['CUSTOMER_ID'];
			if($name != $row['NAME']){
				$changes=$changes." | Name :".$row['NAME'];
			}
			if($surname != $row['SURNAME']){
				$changes=$changes." | Surname :".$row['SURNAME'];
			}
			if($contact != $row['CONTACT_NUMBER']){
				$changes=$changes." | Contact number :".$row['CONTACT_NUMBER'];
			}
			if($email != $row['EMAIL']){
				$changes=$changes." | Email :".$row['EMAIL'];
			}

			// $changes="ID :".$row['CUSTOMER_ID']."Name :".$row['NAME']." | ".$row['SURNAME']." | ".$row['EMAIL']." | ".$row['CONTACT_NUMBER'];
		}
		else
		{
			return false;
		}




		$update_query="UPDATE CUSTOMER SET NAME='$name',SURNAME='$surname',CONTACT_NUMBER='$contact',EMAIL='$email',TITLE_ID='$title',CUSTOMER_TYPE_ID='$customerType',STATUS_ID='$customerStatus' WHERE CUSTOMER_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.2';
		    $userID = $_SESSION['userID'];
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);

			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////////
	function updateOrgCustomer($con,$id,$name,$vat,$contact,$email,$customerType,$customerStatus)
	{

		$changes="";
		$customer_query="SELECT * FROM CUSTOMER WHERE CUSTOMER_ID='$id'";
		$customer_result=mysqli_query($con,$customer_query);
		if(mysqli_num_rows($customer_result)>0)
		{
			$row=$customer_result->fetch_assoc();
			$changes="ID :".$row['CUSTOMER_ID'];
			if($name != $row['NAME']){
				$changes=$changes." | Name :".$row['NAME'];
			}
			if($vat != $row['VAT_NUMBER']){
				$changes=$changes." | VAT no. :".$row['VAT_NUMBER'];
			}
			if($contact != $row['CONTACT_NUMBER']){
				$changes=$changes." | Contact number :".$row['CONTACT_NUMBER'];
			}
			if($email != $row['EMAIL']){
				$changes=$changes." | Email :".$row['EMAIL'];
			}

		}
		else
		{
			return false;
		}

		$update_query="UPDATE CUSTOMER SET NAME='$name',VAT_NUMBER='$vat',CONTACT_NUMBER='$contact',EMAIL='$email',CUSTOMER_TYPE_ID='$customerType',STATUS_ID='$customerStatus' WHERE CUSTOMER_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='1.2';
		    $userID = $_SESSION['userID'];
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);

			return true;
		}
		else
		{
			return false;
		}
	}
	/////////////////////////////////////////////////////////
	function removeAllCustomerAddress($con,$id)
	{
		$delete_query="DELETE FROM CUSTOMER_ADDRESS WHERE CUSTOMER_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>