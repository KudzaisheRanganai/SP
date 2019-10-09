<?php
	
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
		$changes="";
		$customer_query="SELECT * FROM SUPPLIER WHERE SUPPLIER_ID='$id'";
		$customer_result=mysqli_query($con,$customer_query);
		if(mysqli_num_rows($customer_result)>0)
		{
			$row=$customer_result->fetch_assoc();
			$changes="ID :".$row['SUPPLIER_ID'];
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



		$update_query="UPDATE SUPPLIER SET NAME='$name',VAT_NUMBER='$vat',CONTACT_NUMBER='$contact',EMAIL='$email' WHERE SUPPLIER_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='5.2';
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
	/////////////////////////////////////////////////////////
	function checkCollection($con,$id)
	{
		$check_query="SELECT * FROM COLLECTION WHERE ORDER_ID='$id'";
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

	function deleteSupplier($con,$id)
	{
		$delete_query="DELETE FROM SUPPLIER WHERE SUPPLIER_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='5.7';
		    $userID = $_SESSION['userID'];
		    $changes="ID :".$id;
	        $audit_query="INSERT INT AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
			return true;
		}
		else
		{
			return false;
		}
	}

	function getSupplierAccountID($con,$supid)
	{
		$get_query="SELECT * FROM SUPPLIER_ACCOUNT WHERE SUPPLIER_ID='$supid'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["SUPPLIER_ACCOUNT_ID"];
		}
		else
		{
			$cityID=false;
		}
		return $cityID;
	}

	function getSupplierAccountDetails($con,$supid)
	{
		$get_query="SELECT * FROM SUPPLIER_ACCOUNT WHERE SUPPLIER_ID='$supid'";
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

	function countSupplierOrders($con,$supid)
	{
		$get_query="SELECT COUNT(A.ORDER_ID) AS NUM_ORDERS,
		SUM(case when A.ORDER_PAID=1 then 1 ELSE 0 END) AS ORDERS_PAID,
		SUM(case when A.ORDER_STATUS_ID=2 then 1 ELSE 0 END) AS ORDERS_RECEIVED
		FROM ORDER_ A
		WHERE A.SUPPLIER_ID='$supid'";
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

	function getOrderAmountTransactions($con,$supid)
	{
		$get_query="SELECT SUM(A.PRICE) AS ORDER_AMOUNT,A.ORDER_ID, CAST(B.ORDER_DATE AS DATE) AS ORDER_DATE
			FROM ORDER_PRODUCT A
			JOIN ORDER_ B ON A.ORDER_ID=B.ORDER_ID
			WHERE B.SUPPLIER_ID='$supid'
			GROUP BY(ORDER_ID)";
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

	function getOrderPayments($con,$supid)
	{
		$get_query="SELECT A.* 
		FROM SUPPLIER_ACCOUNT_PAYMENT A
		JOIN ORDER_ B ON A.ORDER_ID=B.ORDER_ID
		WHERE B.SUPPLIER_ID='$supid'";
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
?>