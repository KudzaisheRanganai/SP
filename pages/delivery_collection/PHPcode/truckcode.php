<?php
	include_once("connection.php");
	///////////////////////////////////
	function checkTruck($con,$reg)
	{
		$check_query="SELECT * FROM TRUCK WHERE REGISTRATION_NUMBER='$reg'";
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
	function getTruckID($con,$reg)
	{
		$get_query="SELECT * FROM TRUCK WHERE REGISTRATION_NUMBER='$reg'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$truckID=$row["TRUCK_ID"];
		}
		else
		{
			$truckID="Truck ID does not exist";
		}
		return $truckID;
	}
	/////////////////////////////////////////////
	function addTruck($con,$reg,$tname,$tcap,$active)
	{
		$add_query="INSERT INTO TRUCK (REGISTRATION_NUMBER,TRUCK_NAME,CAPACITY,ACTIVE) VALUES('$reg','$tname','$tcap','$active')";
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
	//////////////////////////////////////////
	function maintainTruck($con,$id,$reg,$tname,$tcap,$active)
	{
		$update_query="UPDATE TRUCK SET REGISTRATION_NUMBER='$reg',TRUCK_NAME='$tname',CAPACITY='$tcap',ACTIVE='$active' WHERE TRUCK_ID='$id'";
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
	///////////////////////////////////////////
	function deleteTruck($con,$reg)
	{
		$delete_query="DELETE FROM TRUCK WHERE REGISTRATION_NUMBER='$reg'";
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
	/////////////////////////////////////////////
	if($_POST["choice"]==1)
	{
		if(checkTruck($con,$_POST["registration"]))
		{
			echo "F,Truck Exists.";
		}
		else
		{
			if(addTruck($con,$_POST["registration"],$_POST["name"],$_POST["capacity"],1))
			{
				echo "T,Truck Added Successfully";
			}
			else
			{
				echo "F,Truck Not Added Successfully";
			}
		}
	}
	elseif($_POST["choice"]==2)
	{
		if(maintainTruck($con,$_POST["ID"],$_POST["registration"],$_POST["name"],$_POST["capacity"],$_POST["active"]))
		{
			echo "T,Truck Updated Successfully";
		}
		else
		{
			echo "F,Truck Not Updated";
		}
	}
	elseif($_POST["choice"]==3)
	{
		$sql_query ="SELECT * FROM TRUCK";
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
		if(deleteTruck($con,$_POST["REGISTRATION_NUMBER"]))
		{
			echo "T,Truck Deleted Successfully";
		}
		else
		{
			echo "F,SYSTEM RESTRICT: Truck cannot be deleted";
		}
	}
	mysqli_close($con);
?>