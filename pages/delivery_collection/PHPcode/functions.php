<?php
	function getCustomerAddressIDs($con,$id)
	{
		$get_query="SELECT ADDRESS_ID FROM CUSTOMER_ADDRESS WHERE CUSTOMER_ID='$id'";
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

	function getAllAddresses($con)
	{
		$get_query="SELECT * FROM ADDRESS";
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

	function getAllSuburbs($con)
	{
		$get_query="SELECT * FROM SUBURB";
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

	function getAllCity($con)
	{
		$get_query="SELECT * FROM CITY";
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

	function addDelivery($con,$saleID,$date,$addressID,$dct,$lat,$long)
	{
		$add_query="INSERT INTO DELIVERY (SALE_ID,EXPECTED_DATE,ADDRESS_ID,LATITUDE,LONGITUDE,DCT_STATUS_ID) VALUES ('$saleID','$date','$addressID','$lat','$long','$dct')";
		$add_result=mysqli_query($con,$add_query);
		$last_id=mysqli_insert_id($con);
		if($add_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='10.1';
		   	$userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id."| Sale ID : ".$saleID;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
			return true;
		}
		else
		{
			return false;
		}
	}

	function getAllDelivery($con)
	{
		$get_query="SELECT * FROM DELIVERY";
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

	function getAllCustomer($con)
	{
		$get_query="SELECT * FROM CUSTOMER";
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

	function getAllSales($con)
	{
		$get_query="SELECT * FROM SALE";
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


	function getAllSaleProducts($con)
	{
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME, D.PRODUCT_SIZE_TYPE,D.CASES_PER_PALLET,D.UNITS_PER_CASE
			FROM SALE_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID";
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

	function getSaleProductDetails($con,$id)
	{
		$get_query="SELECT * FROM SALE_PRODUCT WHERE SALE_ID='$id'";
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
	/////////////////////////////////////////////////////
	function getProductDetails($con)
	{
		$get_query="SELECT * FROM PRODUCT";
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

	function getAllEmployees($con)
	{
		$get_query="SELECT * FROM EMPLOYEE";
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

	function deleteDelivery($con,$id)
	{
		$delete_query="DELETE FROM DELIVERY WHERE DELIVERY_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='10.2';
		   	$userID = $_SESSION['userID'];
		    $changes="Delivery ID : ".$id;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
			return true;
		}
		else
		{
			return false;
		}
	}

	function getAllTrucks($con)
	{
		$get_query="SELECT * FROM TRUCK";
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

	function getUnassignedDeliveries($con,$dct)
	{
		$get_query="SELECT A.*,B.SALE_STATUS_ID
		FROM DELIVERY A
		JOIN SALE B ON A.SALE_ID=B.SALE_ID
		WHERE B.SALE_STATUS_ID=2 AND (A.DCT_STATUS_ID='$dct' OR A.DCT_STATUS_ID=6)";
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
	////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////
	function updateSaleProductAssignedQty($con,$saleid,$pID,$qty)
	{
		$update_query="UPDATE SALE_PRODUCT SET QUANTITY_ASSIGNED=QUANTITY_ASSIGNED-'$qty' WHERE SALE_ID='$saleid' AND PRODUCT_ID='$pID'";
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
	function countAssignment($con,$sID)
	{
		$count_query="SELECT SUM(`QUANTITY_ASSIGNED`) AS ASSIGNMENT FROM `SALE_PRODUCT` WHERE SALE_ID='$sID'";
		$count_result=mysqli_query($con,$count_query);
		// if(mysqli_num_rows($count_result)>0)
		// {
		// 	$row=$count_result->fetch_assoc();
		// 	$assignCount=$row["ASSIGNMENT"];
		// }
		// else
		// {
		// 	$assignCount=-1;
		// }
		// return $assignCount;
		$row=mysqli_fetch_object($count_result);
		return $row->ASSIGNMENT;
	}

	function updateDeliveryStatus($con,$sID,$dct)
	{
		$update_query="UPDATE DELIVERY SET DCT_STATUS_ID='$dct' WHERE SALE_ID='$sID'";
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

	function checkAssignment($con,$truckid,$saleid)
	{
		$address_query="SELECT * FROM DELIVERY_TRUCK WHERE TRUCK_ID='$truckid' AND SALE_ID='$saleid'";
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

	function getDeliveryTruckID($con,$truckid,$saleid)
	{
		$get_query="SELECT * FROM DELIVERY_TRUCK WHERE TRUCK_ID='$truckid' AND SALE_ID='$saleid'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["DELIVERY_TRUCK_ID"];
		}
		else
		{
			$cityID="City ID does not exist";
		}
		return $cityID;
	}

	function checkProductAssignment($con,$deliverytruckid,$saleid,$productid)
	{
		$address_query="SELECT * FROM TRUCK_PRODUCT WHERE DELIVERY_TRUCK_ID='$deliverytruckid' AND SALE_ID='$saleid' AND PRODUCT_ID='$productid'";
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

	function insertAssignment($con,$deliveryid,$saleid,$truckid,$dct)
	{
		$add_query="INSERT INTO DELIVERY_TRUCK (DELIVERY_ID,SALE_ID,TRUCK_ID,DCT_STATUS_ID) VALUES ('$deliveryid','$saleid','$truckid','$dct')";
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

	function insertProductAssignment($con,$deliverytruckid,$saleid,$productid,$qty)
	{
		$add_query="INSERT INTO TRUCK_PRODUCT (DELIVERY_TRUCK_ID,SALE_ID,PRODUCT_ID,QUANTITY) VALUES ('$deliverytruckid','$saleid','$productid','$qty')";
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

	function updateProductAssignment($con,$deliverytruckid,$saleid,$productid,$qty)
	{
		$update_query="UPDATE TRUCK_PRODUCT SET QUANTITY=QUANTITY+'$qty' WHERE SALE_ID='$saleid' AND PRODUCT_ID='$productid' AND DELIVERY_TRUCK_ID='$deliverytruckid'";
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

	function getTruckProductData($con)
	{
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME,D.PRODUCT_SIZE_TYPE,D.CASES_PER_PALLET,D.UNITS_PER_CASE
			FROM TRUCK_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID";
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

	function getDeliveryTruckData($con)
	{
		$get_query="SELECT * FROM DELIVERY_TRUCK";
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

	function getCompleteAddress($con)
	{
		$get_query="SELECT A.ADDRESS_ID,B.ADDRESS_LINE_1,C.NAME,C.ZIPCODE,D.CITY_NAME
			FROM DELIVERY A
			JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
			JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
			JOIN CITY D ON C.CITY_ID=D.CITY_ID
			WHERE DCT_STATUS_ID=1 OR DCT_STATUS_ID=6";
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

	function getSalesCustomer($con)
	{
		$get_query="SELECT A.SALE_ID,B.CUSTOMER_ID,C.NAME,C.SURNAME
			FROM DELIVERY A
			JOIN SALE B ON A.SALE_ID=B.SALE_ID
			JOIN CUSTOMER C ON B.CUSTOMER_ID=C.CUSTOMER_ID
			WHERE DCT_STATUS_ID=1 OR DCT_STATUS_ID=6";
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

	function getCompleteCustomerAddresses($con,$id)
	{
		$get_query="SELECT A.ADDRESS_ID,B.ADDRESS_LINE_1,C.NAME,C.ZIPCODE,D.CITY_NAME
			FROM CUSTOMER_ADDRESS A
			JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
			JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
			JOIN CITY D ON C.CITY_ID=D.CITY_ID
			WHERE CUSTOMER_ID='$id'";
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
	function getCompleteSupplierAddresses($con,$id)
	{
		$get_query="SELECT A.ADDRESS_ID,CONCAT(B.ADDRESS_LINE_1,', ',C.NAME,', ',C.ZIPCODE,', ',D.CITY_NAME,', South Africa') AS ADDRESS_NAME
			FROM SUPPLIER_ADDRESS A
			JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
			JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
			JOIN CITY D ON C.CITY_ID=D.CITY_ID
			WHERE SUPPLIER_ID='$id'";
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
	////////////////////////////////////////////////////////
	//code for maintain
	function getAssignedDeliveries($con)
	{
		$get_query="SELECT A.DELIVERY_ID,A.EXPECTED_DATE,A.SALE_ID,B.DELIVERY_TRUCK_ID,B.DCT_STATUS_ID,B.TRUCK_ID,C.REGISTRATION_NUMBER,C.TRUCK_NAME,C.CAPACITY,F.CITY_NAME,CONCAT(D.ADDRESS_LINE_1,', ',E.NAME,', ',E.ZIPCODE,', ',F.CITY_NAME,', South Africa') AS ADDRESS_NAME,G.SALE_AMOUNT,H.NAME AS EMPLOYEE_NAME,I.NAME AS CUSTOMER_NAME,I.CUSTOMER_ID,I.SURNAME,I.EMAIL,I.CONTACT_NUMBER
			FROM DELIVERY A
			JOIN DELIVERY_TRUCK B ON A.DELIVERY_ID=B.DELIVERY_ID
			JOIN TRUCK C ON B.TRUCK_ID=C.TRUCK_ID
			JOIN ADDRESS D ON A.ADDRESS_ID=D.ADDRESS_ID
			JOIN SUBURB E ON D.SUBURB_ID=E.SUBURB_ID
			JOIN CITY F on E.CITY_ID=F.CITY_ID
			JOIN SALE G on A.SALE_ID=G.SALE_ID
			JOIN EMPLOYEE H on G.EMPLOYEE_ID=H.EMPLOYEE_ID
			JOIN CUSTOMER I on G.CUSTOMER_ID=I.CUSTOMER_ID
			WHERE B.DCT_STATUS_ID=2";
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

	function getAssignedDeliveryProducts($con)
	{
		$get_query="SELECT A.DELIVERY_TRUCK_ID,A.DELIVERY_ID,A.SALE_ID,B.PRODUCT_ID,B.QUANTITY,C.TRUCK_ID,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME,E.SELLING_PRICE
			FROM DELIVERY_TRUCK A
			JOIN TRUCK_PRODUCT B ON A.DELIVERY_TRUCK_ID=B.DELIVERY_TRUCK_ID
			JOIN TRUCK C ON A.TRUCK_ID=C.TRUCK_ID
			JOIN PRODUCT D ON B.PRODUCT_ID=D.PRODUCT_ID
			JOIN SALE_PRODUCT E ON A.SALE_ID=E.SALE_ID AND B.PRODUCT_ID=E.PRODUCT_ID
			WHERE A.DCT_STATUS_ID=2";
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

	function deleteMaintainProductAssignment($con,$deliverytruckid,$saleid,$productid)
	{
		$delete_query="DELETE FROM TRUCK_PRODUCT WHERE DELIVERY_TRUCK_ID='$deliverytruckid' AND SALE_ID='$saleid' AND PRODUCT_ID='$productid'";
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

	function updateMaintainProductAssignment($con,$deliverytruckid,$saleid,$productid,$qty)
	{
		$update_query="UPDATE TRUCK_PRODUCT SET QUANTITY=QUANTITY-'$qty' WHERE SALE_ID='$saleid' AND PRODUCT_ID='$productid' AND DELIVERY_TRUCK_ID='$deliverytruckid'";
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

	function updateMaintainProductSaleAssignment($con,$saleid,$productid,$qty)
	{
		$update_query="UPDATE SALE_PRODUCT SET QUANTITY_ASSIGNED=QUANTITY_ASSIGNED+'$qty' WHERE SALE_ID='$saleid' AND PRODUCT_ID='$productid'";
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

	function getAssignedSales($con,$truckid)
	{
		$get_query="SELECT SALE_ID FROM DELIVERY_TRUCK
		WHERE TRUCK_ID='$truckid' AND DCT_STATUS_ID=2";
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

	function deleteDeliveryAssignment($con,$saleid,$truckid)
	{
		$delete_query="DELETE FROM DELIVERY_TRUCK WHERE SALE_ID='$saleid' AND TRUCK_ID='$truckid'";
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

	function updateSaleAssignment($con,$dct,$saleid)
	{
		$update_query="UPDATE DELIVERY SET DCT_STATUS_ID='$dct' WHERE SALE_ID='$saleid'";
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

	function updateDeliveryTruckStatus($con,$sID,$truckid,$dct)
	{
		$update_query="UPDATE DELIVERY_TRUCK SET DCT_STATUS_ID='$dct' WHERE SALE_ID='$sID' AND TRUCK_ID='$truckid'";
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

	function checkAssigned($con,$sID)
	{
		$get_query="SELECT * FROM DELIVERY_TRUCK WHERE SALE_ID='$sID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return count($get_vals);
		}
		else
		{
			return 0;
		}
	}

	function checkAssignedFinal($con,$sID,$dct)
	{
		$get_query="SELECT * FROM DELIVERY_TRUCK WHERE SALE_ID='$sID' AND DCT_STATUS_ID='$dct'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return count($get_vals);
		}
		else
		{
			return 0;
		}
	}

	function checkDelivery($con,$saleid)
	{
		$check_query="SELECT * FROM DELIVERY WHERE SALE_ID='$saleid'";
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

	function addCollection($con,$orderID,$date,$addressID,$dct,$lat,$long)
	{
		$add_query="INSERT INTO COLLECTION (ORDER_ID,EXPECTED_DATE,ADDRESS_ID,LATITUDE,LONGITUDE,COLLECTION_STATUS_ID) VALUES ('$orderID','$date','$addressID','$lat','$long','$dct')";
		$add_result=mysqli_query($con,$add_query);
		$last_id=mysqli_insert_id($con);
		if($add_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='10.4';
		   	$userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id."| Order ID : ".$orderID;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
			return true;
		}
		else
		{
			return false;
		}
	}

	function getSearchCollectionData($con)
	{
		$get_query="SELECT A.*,B.ADDRESS_LINE_1,C.NAME AS SUBURB_NAME,C.ZIPCODE,D.CITY_NAME,E.ORDER_DATE,F.SUPPLIER_ID,F.CONTACT_NUMBER,F.EMAIL,F.NAME AS SUPPLIER_NAME,CONCAT(B.ADDRESS_LINE_1,', ',C.NAME,', ',C.ZIPCODE,', ',D.CITY_NAME,', South Africa') AS ADDRESS_NAME,G.NAME AS EMPLOYEE_NAME
			FROM COLLECTION A
			JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
			JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
			JOIN CITY D ON C.CITY_ID=D.CITY_ID
			JOIN ORDER_ E ON A.ORDER_ID=E.ORDER_ID
			JOIN SUPPLIER F ON E.SUPPLIER_ID=F.SUPPLIER_ID
			JOIN EMPLOYEE G ON E.EMPLOYEE_ID=G.EMPLOYEE_ID";
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

	function deleteCollection($con,$id)
	{
		$delete_query="DELETE FROM COLLECTION WHERE COLLECTION_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='10.5';
		   	$userID = $_SESSION['userID'];
		    $changes="COLLECTION ID : ".$id;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
			return true;
		}
		else
		{
			return false;
		}
	}

	function getOrderProducts($con,$orderID)
	{
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME
			FROM ORDER_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID
			WHERE ORDER_ID='$orderID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$vals[]=$get_row;
			}
			return json_encode($vals);
		}
		else
		{
			return false;
		}
	}

	function getDeliveryCities($con)
	{
		$get_query="SELECT A.SALE_ID,D.CITY_NAME
		FROM DELIVERY A
		JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
		JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
		JOIN CITY D ON C.CITY_ID=D.CITY_ID";
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

	////////////////////////////////////////
	//functionns for Assign Collection
	/////////////////////////////////////////
	function getUnassignedCollections($con,$dct)
	{
		$get_query="SELECT * FROM COLLECTION WHERE COLLECTION_STATUS_ID='$dct' OR COLLECTION_STATUS_ID=6";
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

	function getCompleteAddressCollection($con)
	{
		$get_query="SELECT A.ADDRESS_ID,B.ADDRESS_LINE_1,C.NAME,C.ZIPCODE,D.CITY_NAME
			FROM COLLECTION A
			JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
			JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
			JOIN CITY D ON C.CITY_ID=D.CITY_ID
			WHERE COLLECTION_STATUS_ID=1 OR COLLECTION_STATUS_ID=6";
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

	function getCollectionCities($con)
	{
		$get_query="SELECT A.ORDER_ID,D.CITY_NAME
		FROM COLLECTION A
		JOIN ADDRESS B ON A.ADDRESS_ID=B.ADDRESS_ID
		JOIN SUBURB C ON B.SUBURB_ID=C.SUBURB_ID
		JOIN CITY D ON C.CITY_ID=D.CITY_ID";
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

	function getOrderSupplier($con)
	{
		$get_query="SELECT A.ORDER_ID,B.SUPPLIER_ID,C.NAME
			FROM COLLECTION A
			JOIN ORDER_ B ON A.ORDER_ID=B.ORDER_ID
			JOIN SUPPLIER C ON B.SUPPLIER_ID=C.SUPPLIER_ID
			WHERE COLLECTION_STATUS_ID=1 OR COLLECTION_STATUS_ID=6";
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

	function getAllOrderProducts($con)
	{
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME, D.PRODUCT_SIZE_TYPE,D.CASES_PER_PALLET,D.UNITS_PER_CASE
			FROM ORDER_PRODUCT A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID";
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

	function getTruckProductDataCollection($con)
	{
		$get_query="SELECT A.*,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME,D.PRODUCT_SIZE_TYPE,D.CASES_PER_PALLET,D.UNITS_PER_CASE
			FROM TRUCK_PRODUCT_COLLECTION A
			JOIN PRODUCT D ON A.PRODUCT_ID=D.PRODUCT_ID";
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

	function getCollectionTruckData($con)
	{
		$get_query="SELECT * FROM COLLECTION_TRUCK";
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
	/////////////Assign Collection Functions
	function updateOrderProductAssignedQty($con,$orderid,$pID,$qty)
	{
		$update_query="UPDATE ORDER_PRODUCT SET QUANTITY_ASSIGNED=QUANTITY_ASSIGNED-'$qty' WHERE ORDER_ID='$orderid' AND PRODUCT_ID='$pID'";
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

	function countOrderAssignment($con,$sID)
	{
		$count_query="SELECT SUM(`QUANTITY_ASSIGNED`) AS ASSIGNMENT FROM `ORDER_PRODUCT` WHERE ORDER_ID='$sID'";
		$count_result=mysqli_query($con,$count_query);
		// if(mysqli_num_rows($count_result)>0)
		// {
		// 	$row=$count_result->fetch_assoc();
		// 	$assignCount=$row["ASSIGNMENT"];
		// }
		// else
		// {
		// 	$assignCount=-1;
		// }
		// return $assignCount;
		$row=mysqli_fetch_object($count_result);
		return $row->ASSIGNMENT;
	}

	function updateCollectionStatus($con,$sID,$dct)
	{
		$update_query="UPDATE COLLECTION SET COLLECTION_STATUS_ID='$dct' WHERE ORDER_ID='$sID'";
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

	function checkAssignmentCollection($con,$truckid,$saleid)
	{
		$address_query="SELECT * FROM COLLECTION_TRUCK WHERE TRUCK_ID='$truckid' AND ORDER_ID='$saleid'";
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

	function getCollectionTruckID($con,$truckid,$saleid)
	{
		$get_query="SELECT * FROM COLLECTION_TRUCK WHERE TRUCK_ID='$truckid' AND ORDER_ID='$saleid'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["COLLECTION_TRUCK_ID"];
		}
		else
		{
			$cityID="Collection Truck ID does not exist";
		}
		return $cityID;
	}

	function checkProductAssignmentCollection($con,$deliverytruckid,$saleid,$productid)
	{
		$address_query="SELECT * FROM TRUCK_PRODUCT_COLLECTION WHERE COLLECTION_TRUCK_ID='$deliverytruckid' AND ORDER_ID='$saleid' AND PRODUCT_ID='$productid'";
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

	function updateProductAssignmentCollection($con,$deliverytruckid,$saleid,$productid,$qty)
	{
		$update_query="UPDATE TRUCK_PRODUCT_COLLECTION SET QUANTITY=QUANTITY+'$qty' WHERE ORDER_ID='$saleid' AND PRODUCT_ID='$productid' AND COLLECTION_TRUCK_ID='$deliverytruckid'";
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

	function insertProductAssignmentCollection($con,$deliverytruckid,$saleid,$productid,$qty)
	{
		$add_query="INSERT INTO TRUCK_PRODUCT_COLLECTION (COLLECTION_TRUCK_ID,ORDER_ID,PRODUCT_ID,QUANTITY) VALUES ('$deliverytruckid','$saleid','$productid','$qty')";
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

	function insertAssignmentCollection($con,$deliveryid,$saleid,$truckid,$dct)
	{
		$add_query="INSERT INTO COLLECTION_TRUCK (COLLECTION_ID,ORDER_ID,TRUCK_ID,COLLECTION_STATUS_ID) VALUES ('$deliveryid','$saleid','$truckid','$dct')";
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

	//Maintain Assigned Collection Functions

	function getAssignedCollections($con)
	{
		$get_query="SELECT A.COLLECTION_ID,A.EXPECTED_DATE,A.ORDER_ID,B.COLLECTION_TRUCK_ID,B.COLLECTION_STATUS_ID,B.TRUCK_ID,C.REGISTRATION_NUMBER,C.TRUCK_NAME,C.CAPACITY,F.CITY_NAME,CONCAT(D.ADDRESS_LINE_1,', ',E.NAME,', ',E.ZIPCODE,', ',F.CITY_NAME,', South Africa') AS ADDRESS_NAME,H.NAME AS EMPLOYEE_NAME,I.NAME AS CUSTOMER_NAME,I.SUPPLIER_ID,I.EMAIL,I.CONTACT_NUMBER
			FROM COLLECTION A
			JOIN COLLECTION_TRUCK B ON A.COLLECTION_ID=B.COLLECTION_ID
			JOIN TRUCK C ON B.TRUCK_ID=C.TRUCK_ID
			JOIN ADDRESS D ON A.ADDRESS_ID=D.ADDRESS_ID
			JOIN SUBURB E ON D.SUBURB_ID=E.SUBURB_ID
			JOIN CITY F on E.CITY_ID=F.CITY_ID
			JOIN ORDER_ G on A.ORDER_ID=G.ORDER_ID
			JOIN EMPLOYEE H on G.EMPLOYEE_ID=H.EMPLOYEE_ID
			JOIN SUPPLIER I on G.SUPPLIER_ID=I.SUPPLIER_ID
			WHERE B.COLLECTION_STATUS_ID=2";
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

	function getAssignedCollectionProducts($con)
	{
		$get_query="SELECT A.COLLECTION_TRUCK_ID,A.COLLECTION_ID,A.ORDER_ID,B.PRODUCT_ID,B.QUANTITY,C.TRUCK_ID,CONCAT(D.NAME,' (',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN '1'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN D.UNITS_PER_CASE
			ELSE D.CASES_PER_PALLET
			END,' x ',D.PRODUCT_MEASUREMENT,D.PRODUCT_MEASUREMENT_UNIT,') ',CASE
			WHEN D.PRODUCT_SIZE_TYPE=1 THEN 'Individual'
			WHEN D.PRODUCT_SIZE_TYPE=2 THEN 'Case'
			ELSE 'Pallet'
			END) AS PRODUCT_NAME,E.PRICE
			FROM COLLECTION_TRUCK A
			JOIN TRUCK_PRODUCT_COLLECTION B ON A.COLLECTION_TRUCK_ID=B.COLLECTION_TRUCK_ID
			JOIN TRUCK C ON A.TRUCK_ID=C.TRUCK_ID
			JOIN PRODUCT D ON B.PRODUCT_ID=D.PRODUCT_ID
			JOIN ORDER_PRODUCT E ON A.ORDER_ID=E.ORDER_ID AND B.PRODUCT_ID=E.PRODUCT_ID
			WHERE A.COLLECTION_STATUS_ID=2";
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

	function getAssignedOrders($con,$truckid)
	{
		$get_query="SELECT ORDER_ID FROM COLLECTION_TRUCK
		WHERE TRUCK_ID='$truckid' AND COLLECTION_STATUS_ID=2";
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

	function deleteMaintainProductAssignmentCollection($con,$deliverytruckid,$saleid,$productid)
	{
		$delete_query="DELETE FROM TRUCK_PRODUCT_COLLECTION WHERE COLLECTION_TRUCK_ID='$deliverytruckid' AND ORDER_ID='$saleid' AND PRODUCT_ID='$productid'";
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

	function updateMaintainProductSaleAssignmentCollection($con,$saleid,$productid,$qty)
	{
		$update_query="UPDATE ORDER_PRODUCT SET QUANTITY_ASSIGNED=QUANTITY_ASSIGNED+'$qty' WHERE ORDER_ID='$saleid' AND PRODUCT_ID='$productid'";
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

	function updateMaintainProductAssignmentCollection($con,$deliverytruckid,$saleid,$productid,$qty)
	{
		$update_query="UPDATE TRUCK_PRODUCT_COLLECTION SET QUANTITY=QUANTITY-'$qty' WHERE ORDER_ID='$saleid' AND PRODUCT_ID='$productid' AND COLLECTION_TRUCK_ID='$deliverytruckid'";
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

	function deleteCollectionAssignment($con,$saleid,$truckid)
	{
		$delete_query="DELETE FROM COLLECTION_TRUCK WHERE ORDER_ID='$saleid' AND TRUCK_ID='$truckid'";
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

	function checkAssignedCollection($con,$sID)
	{
		$get_query="SELECT * FROM COLLECTION_TRUCK WHERE ORDER_ID='$sID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return count($get_vals);
		}
		else
		{
			return 0;
		}
	}

	function updateOrderAssignment($con,$dct,$saleid)
	{
		$update_query="UPDATE COLLECTION SET COLLECTION_STATUS_ID='$dct' WHERE ORDER_ID='$saleid'";
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

	//Finalise Assigned Collection functions
	function updateCollectionTruckStatus($con,$sID,$truckid,$dct)
	{
		$update_query="UPDATE COLLECTION_TRUCK SET COLLECTION_STATUS_ID='$dct' WHERE ORDER_ID='$sID' AND TRUCK_ID='$truckid'";
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

	function checkAssignedFinalCollection($con,$sID,$dct)
	{
		$get_query="SELECT * FROM COLLECTION_TRUCK WHERE ORDER_ID='$sID' AND COLLECTION_STATUS_ID='$dct'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return count($get_vals);
		}
		else
		{
			return 0;
		}
	}

	function addAuditForAssignDelivery($con,$truckid,$saleid)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='10.101';
		$userID = $_SESSION['userID'];
		$changes="Truck ID : ".$truckid."| Sale ID : ".$saleid;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForAssignCollection($con,$truckid,$saleid)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='10.13';
		$userID = $_SESSION['userID'];
		$changes="Truck ID : ".$truckid."| Order ID : ".$saleid;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForMaintainDelAss($con,$truckid,$saleid,$remove)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='10.11';
		$userID = $_SESSION['userID'];
		$changes="Truck ID : ".$truckid."| Sale ID : ".$saleid."| Assignment: ".$remove;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForMaintainColAss($con,$truckid,$saleid,$remove)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='10.14';
		$userID = $_SESSION['userID'];
		$changes="Truck ID : ".$truckid."| Order ID : ".$saleid."| Assignment: ".$remove;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForFinaliseDelAss($con,$truckid,$saleid)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='10.12';
		$userID = $_SESSION['userID'];
		$changes="Truck ID : ".$truckid."| Sale ID : ".$saleid;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

	function addAuditForFinaliseColAss($con,$truckid,$saleid)
	{
		$DateAudit = date('Y-m-d H:i:s');
		$Functionality_ID='10.15';
		$userID = $_SESSION['userID'];
		$changes="Truck ID : ".$truckid."| Order ID : ".$saleid;
	    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	    $audit_result=mysqli_query($con,$audit_query);
	}

?>