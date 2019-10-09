<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	//////////////////////////////////////////////////////////
	$Ename;  // = $_POST["name"]; //mysqli_real_escape_string($DBConnect,$_POST["employeeName"]);
	$Esurname;// = $_POST["surname"];//5
	$Econtact; //= $_POST["contact"];//8
	$fileTo = "Empty";//= $_FILES["file"];

	if(isset($_POST["name"]))
	{
		$Ename = $_POST["name"];
	}
	if(isset($_POST["surname"]))
	{
		$Esurname = $_POST["surname"];//5
	}
	if(isset($_POST["contact"]))
	{
	
	$Econtact = $_POST["contact"];//8
	}
	if(isset($_FILES["file"]))
	{
		$fileTo = $_FILES["file"];
	}


	////////////////////////////////////////////////////////
	if($_POST["choice"]==0)
	{
		getAllEmployeeType($con);
	}
	elseif($_POST["choice"]==1)
	{
		if(addressCheck($con,$_POST["address"]))
		{
			if(maintainEmployee($con,$_POST["employeeID"],$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["email"],$_POST["IDPASS"],getAddressID($con,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"],$fileTo))
			{
				echo "T,Employee Maintained";
			}
			else
			{
				echo "F,Address found but Employee not Maintained";
			}
		}
		else
		{
			if(checkSuburb($con,$_POST["suburb"]))
			{
				if(addAddress($con,$_POST["address"],getSuburbID($con,$_POST["suburb"])))
				{
					if(maintainEmployee($con,$_POST["employeeID"],$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["email"],$_POST["IDPASS"],getAddressID($con,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"],$fileTo))
					{
						echo "T,Employee Maintained";
					}
					else
					{
						echo "F,Suburb Found Address Added but Employee not Maintained";
					}
				}
				else
				{
					echo "F,Suburb Found Address Not Added";
				}
			}
			else
			{
				if(checkCity($con,$_POST["city"]))
				{
					if(addSuburb($con,$_POST["suburb"],getCityID($con,$_POST["city"]),$_POST["zip"]))
					{
						if(addAddress($con,$_POST["address"],getSuburbID($con,$_POST["suburb"])))
						{
							if(maintainEmployee($con,$_POST["employeeID"],$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["email"],$_POST["IDPASS"],getAddressID($con,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"],$fileTo))
							{
								echo "T, Employee Maintained";
							}
							else
							{
								echo "F,City found Suburb Addedd Address Added but Employee not Maintained";
							}
						}
						else
						{
							echo "F,City found suburb added but address not added.";
						}
					}
					else
					{
						echo "F,City Found but Suburb not added";
					}
				}
				else
				{
					if(addCity($con,$_POST["city"]))
					{

						if(addSuburb($con,$_POST["suburb"],getCityID($con,$_POST["city"]),$_POST["zip"]))
						{
							if(addAddress($con,$_POST["address"],getSuburbID($con,$_POST["suburb"])))
							{
								if(maintainEmployee($con,$_POST["employeeID"],$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["email"],$_POST["IDPASS"],getAddressID($con,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"],$fileTo))
								{
									echo "T,Employee Maintained";
								}
								else
								{
									echo "F,City Added Suburb Added Address Added but Employee not Maintained";
								}
							}
							else
							{
								echo "F,City Added Suburb Added but Address not added";
							}
						}
						else
						{
							echo "F,City Addedbut Suburb not added.";
						}
					}
				}
			}
		}

			/*if(isset($fileTo))
			{
				$query = "SELECT `EMPLOYEE_ID` FROM `EMPLOYEE` WHERE (NAME='$Ename' and SURNAME ='$Esurname' and CONTACT_NUMBER ='$Econtact')";
				$submitQuery = mysqli_query($con,$query);
				
				//$object = array();
				if($submitQuery)
				{
					$savedID = mysqli_fetch_assoc($submitQuery);
				
					$employeeID = $savedID["EMPLOYEE_ID"];
					
						//Upload picture.
					if(empty($employeeID))
					{
						echo "Employee ID not created, something is wrong with the code";
					}
					else
					{
								$dir= "../images/ProfilePic/";		
								//$counter = count($fileTo["name"]);
							if(($fileTo["type"] == "image/jpeg")&& ($fileTo["size"] < 125000))
							{
								
										if($fileTo["error"] > 0)
										{
												echo "Error: " . $fileTo["error"]  . "<br/>";
										}
								else
								{
									
										$faker = true;
												//if(file_exists($dir . $fileTo["name"] ))
												//{
												//	echo $fileTo["name"] . " already exists.";
												//} 
												//else
												//{
														
														
													
													
														$temp = explode(".", $fileTo["name"]);
													
														$newfilename = $employeeID . '.' . end($temp);
														move_uploaded_file($fileTo["tmp_name"] , $dir . $newfilename);
													
					
															//Upload pic on database.
														
														$query = "UPDATE EMPLOYEE_PICTURE
														SET `FILENAME`= '$newfilename'
														WHERE (`EMPLOYEE_ID` = '$employeeID')"; // insert the user_id for specific pictures
														$res = mysqli_query($con, $query);
														//var_dump($res);



														
														//var_dump($employeeID);
														/*$hash = sha1($employeeID);
													
														$qrImgName = "StockPath".rand();
														
														
														$final = $employeeID ; //.$dev;
														$qrs = QRcode::png($final,"userQr/$qrImgName.png","H","3","3");
														$qrimage = $qrImgName.".png";
														$workDir = $_SERVER['HTTP_HOST'];
														$qrlink = $workDir."/qrcode".$qrImgName.".png";
														$date = date("Y-m-d H:i:s");
														
														$sql = "INSERT INTO EMPLOYEE_QR(HASH,DATE_GENERATED,EMPLOYEE_ID) VALUES('$hash','$date','$employeeID')";
														//var_dump($sql);
														$query_QR = mysqli_query($DBConnect , $sql);
														
														//var_dump($query_QR);
																//return $query;
													
													
														//$insQr = $meravi->insertQrCode($qrUname,$final,$qrimage,$qrlink);
															
														if(($res== true))
														{
															echo "T,Employee Maintained";
															
														}
														else
														{
															echo "F,Error in saving employee pic or generated employee tag";
														}
																		
												//}
												
								}
					
							}
							else
							{
									echo  'F,There was an error within the picture upload';
									
							}

					}
					
				}
				else
				{
					echo "F,Couldnt get ID of employee details";
				}

			}*/

	}
	elseif($_POST["choice"]==2)
	{
		$sql_query ="SELECT * FROM EMPLOYEE
		WHERE `EMPLOYEE_STATUS_ID` = '1'";
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


	mysqli_close($con);
?>