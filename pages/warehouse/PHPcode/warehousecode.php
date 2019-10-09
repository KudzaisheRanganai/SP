<?php
	include_once("connection.php");
	include_once("../../sessionCheckPages.php");
	////////////////////////////////////////////
	function checkWarehouse($con,$name)
	{
		$check_query="SELECT * FROM WAREHOUSE WHERE NAME='$name'";
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
	/////////////////////////////////////////
	function getWarehouseID($con,$name)
	{
		$get_query="SELECT * FROM WAREHOUSE WHERE NAME='$name'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$ID=$row["WAREHOUSE_ID"];
		}
		else
		{
			$ID="Warehouse ID does not exist";
		}
		return $ID;
	}
	/////////////////////////////////////////////
	function addWarehouse($con,$name,$des,$max)
	{
		$add_query="INSERT INTO WAREHOUSE (NAME,DESCRIPTION,MAX_PALLETS) VALUES('$name','$des','$max')";
		$add_result=mysqli_query($con,$add_query);
		$last_id = mysqli_insert_id($con);
		if($add_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='6.1';
		    $userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id;
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
	//////////////////////////////////////////
	function maintainWarehouse($con,$id,$name,$des,$max)
	{
		$changes="";
		$customer_query="SELECT * FROM WAREHOUSE WHERE WAREHOUSE_ID='$id'";
		$customer_result=mysqli_query($con,$customer_query);
		if(mysqli_num_rows($customer_result)>0)
		{
			$row=$customer_result->fetch_assoc();
			$changes="ID :".$row['WAREHOUSE_ID'];
			if($name != $row['NAME']){
				$changes=$changes." | Name :".$row['NAME'];
			}
			if($des != $row['DESCRIPTION']){
				$changes=$changes." | Description :".$row['DESCRIPTION'];
			}
			if($max != $row['MAX_PALLETS']){
				$changes=$changes." | Max pallets :".$row['MAX_PALLETS'];
			}
		}
		else
		{
			return false;
		}


		$update_query="UPDATE WAREHOUSE SET NAME='$name',DESCRIPTION='$des',MAX_PALLETS='$max' WHERE WAREHOUSE_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='6.2';
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
	///////////////////////////////////////////////////
	function deleteWarehouse($con,$id)
	{
		$customer_query="SELECT * FROM WAREHOUSE WHERE WAREHOUSE_ID='$id'";
		$customer_result=mysqli_query($con,$customer_query);
		if(mysqli_num_rows($customer_result)>0)
		{
			$row=$customer_result->fetch_assoc();
		}
		$changes="ID :".$row['WAREHOUSE_ID']." | Name : ".$row["NAME"];

		$delete_query="DELETE FROM WAREHOUSE WHERE WAREHOUSE_ID='$id'";
		$delete_result=mysqli_query($con,$delete_query);
		if($delete_result)
		{	
			$DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='6.4';
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
	////////////////////////////////////////////////////
	///////////////////////////////////////////////////
	if($_POST["choice"]==1)
	{
		if(checkWarehouse($con,$_POST["name"]))
		{
			echo "F,Warehouse Exists.";
		}
		else
		{
			if(addWarehouse($con,$_POST["name"],$_POST["description"],$_POST["max"]))
			{
				echo "T,Warehouse Added Successfully";
			}
			else
			{
				echo "F,Warehouse Not Added Successfully";
			}
		}
	}
	elseif($_POST["choice"]==2)
	{
		if(maintainWarehouse($con,$_POST["ID"],$_POST["name"],$_POST["description"],$_POST["max"]))
		{
			echo "T,Warehouse Updated Successfully";
		}
		else
		{
			echo "F,Warehouse Not Updated";
		}
	}
	elseif($_POST["choice"]==3)
	{
		$sql_query ="SELECT * FROM WAREHOUSE";
	    $result = mysqli_query($con,$sql_query);
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
	         echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	    }
	}
	elseif($_POST["choice"]==4)
	{
		if(deleteWarehouse($con,$_POST["WAREHOUSE_ID"]))
		{
			echo "T,Warehouse Deleted Successfully!";
		}
		else
		{
			echo "F,SYSTEM RESTRICT: Warehouse cannot be deleted.";
		}
	}
	mysqli_close($con);

?>