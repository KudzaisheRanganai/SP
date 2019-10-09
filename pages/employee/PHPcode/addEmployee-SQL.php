<?php
include_once("../../sessionCheckPages.php");
include "meRaviQr/qrlib.php";
  $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';
 include_once("functions.php");
 ///////////////////////////////////

  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');

  $DBConnect = mysqli_connect($hostname, $username, $password, $database);

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
	$Ename = $_POST["name"]; //mysqli_real_escape_string($DBConnect,$_POST["employeeName"]);
	$Esurname = $_POST["surname"];//5
	$Econtact = $_POST["contact"];//8
	$fileTo= $_FILES["file"];

	$check=false;

	if(checkEmployee($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"] ,$_POST["email"]))
	{
		echo "Employee Exists";
	}
	else
	{
		if(addressCheck($DBConnect,$_POST["address"]))
		{
			if(addEmployee($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["IDPASS"],$_POST["email"],getAddressID($DBConnect,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"]))
			{
				if(addWage($DBConnect,getEmployeeID($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"])))
				{
					$check=true;	
				}
				else
				{
					$check=false;
				}
				
			}
			else
			{
				// echo "Employee Not Added";
				$check=false;
			}
		}
		else
		{
			if(checkSuburb($DBConnect,$_POST["suburb"]))
			{
				if(addAddress($DBConnect,$_POST["address"],getSuburbID($DBConnect,$_POST["suburb"])))
				{
					if(addEmployee($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["IDPASS"],$_POST["email"],getAddressID($DBConnect,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"]))
					{
						if(addWage($DBConnect,getEmployeeID($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"])))
						{
							$check=true;	
						}
						else
						{
							$check=false;
						}
					}
					else
					{
						// echo "Address Added but employee not added";//
						$check=false;
					}
				}
				else
				{
					// echo "Suburb found but address not added";//
					$check=false;
				}
			}
			else
			{
				if(checkCity($DBConnect,$_POST["city"]))
				{
					if(addSuburb($DBConnect,$_POST["suburb"],getCityID($DBConnect,$_POST["city"]),$_POST["zip"]))
					{
						if(addAddress($DBConnect,$_POST["address"],getSuburbID($DBConnect,$_POST["suburb"])))
						{
							if(addEmployee($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["IDPASS"],$_POST["email"],getAddressID($DBConnect,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"]))
							{
								if(addWage($DBConnect,getEmployeeID($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"])))
								{
									$check=true;	
								}
								else
								{
									$check=false;
								}
							}
							else
							{
								// echo "City found suburb added address added but employee not added";//
								$check=false;
							}
						}
						else
						{
							echo "City found suburb added but address not added.";//
							// $check=false;
						}
					}
					else
					{
						// echo "City Found Suburb not added";
						$check=false;
					}
				}
				else
				{
					if(addCity($DBConnect,$_POST["city"]))
					{

						if(addSuburb($DBConnect,$_POST["suburb"],getCityID($DBConnect,$_POST["city"]),$_POST["zip"]))
						{
							if(addAddress($DBConnect,$_POST["address"],getSuburbID($DBConnect,$_POST["suburb"])))
							{
								if(addEmployee($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["IDPASS"],$_POST["email"],getAddressID($DBConnect,$_POST["address"]),$_POST["title"],$_POST["employeeType"],$_POST["status"]))
								{
									if(addWage($DBConnect,getEmployeeID($DBConnect,$_POST["name"],$_POST["surname"],$_POST["contact"])))
									{
										$check=true;	
									}
									else
									{
										$check=false;
									}
								}
								else
								{
									// echo "City added suburb added address added but employee not addded";//
									$check=false;
								}
							}
							else
							{
								// echo "City added suburb added but address not added";//
								$check=false;
							}
						}
						else
						{
							// echo "City Added Suburb not added";
							$check=false;
						}
					}
				}
			}
		}//
	}
	if($check)
	{
		

	
		$query = "SELECT `EMPLOYEE_ID` FROM `EMPLOYEE` WHERE (NAME='$Ename' and SURNAME ='$Esurname' and CONTACT_NUMBER ='$Econtact')";
		$submitQuery = mysqli_query($DBConnect,$query);
		
		//$object = array();
		if($submitQuery)
		{
			$savedID = mysqli_fetch_assoc($submitQuery);
		
			$employeeID = $savedID["EMPLOYEE_ID"];





			
				//Upload picture.
			if(empty($employeeID))
			{
				echo "Employee ID not created.";
			}
			else
			{

				$verifyQrCode;

				$sql = "SELECT EMPLOYEE_TYPE.WAGE_EARNING FROM EMPLOYEE
                INNER JOIN EMPLOYEE_TYPE
                ON EMPLOYEE.EMPLOYEE_TYPE_ID = EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID
                 WHERE (EMPLOYEE_ID='$employeeID')";
                $query_QR = mysqli_query($DBConnect , $sql);


				
				

				if(mysqli_num_rows($query_QR)>0)
                {
                    if($row = mysqli_fetch_assoc($query_QR))
                    {
                        if($row["WAGE_EARNING"] == 1)
                        {
							$hash = sha1($employeeID);
							
								$qrImgName = $employeeID;
							   
							   
								$final = $employeeID ; //.$dev;
								$qrs = QRcode::png($final,"userQr/$qrImgName.png","H","3","3");
								$qrimage = $qrImgName.".png";
								$workDir = $_SERVER['HTTP_HOST'];
								$qrlink = $workDir."/qrcode".$qrImgName.".png";
								$date = date("Y-m-d H:i:s");
								
								$sql = "INSERT INTO EMPLOYEE_QR(HASH,DATE_GENERATED,EMPLOYEE_ID) VALUES('$hash','$date','$employeeID')";
								//var_dump($sql);
								$query_QR = mysqli_query($DBConnect , $sql);
								if($query_QR)
								{
									$verifyQrCode = "verified employee QR.";
									//echo $verifyQrCode;
								}
								else
								{
									$verifyQrCode = "Employee QR code could not be generated";
									//echo $verifyQrCode;
								}
                        }
                        else
                        {
                            echo "Employee does not earn wage,";
                        }
                    }
                    else
                    {
                        echo "Fetch array has errors,";
                    }
                }
                else
                {
                        echo "This employee does not earn wage,";
                }




						$dir= "../images/ProfilePic/";		
						//$counter = count($fileTo["name"]);
					
						
								if($fileTo["error"] > 0)
								{
										echo "Error: " . $fileTo["error"]  . "<br/>";
								}
								else
								{
							
												$faker = true;
												
												$temp = explode(".", $fileTo["name"]);
											
												$newfilename = $employeeID . '.' . end($temp);
												move_uploaded_file($fileTo["tmp_name"] , $dir . $newfilename);
											
			
													//Upload pic on database.
												
												$query = "INSERT INTO EMPLOYEE_PICTURE (FILENAME, EMPLOYEE_ID) VALUES ('$newfilename', '$employeeID')"; // insert the user_id for specific pictures
												$res = mysqli_query($DBConnect, $query);
											
													
												if(($res== true) && ($query_QR==true))
												{
													echo $employeeID . ",success";
													
												}
												else
												{
													echo "Error in saving employee picture.";
												}
																
										
										
								}	
			
				

			}
			
		}
		else
		{
			echo "Couldnt get ID of employee details";
		}
	}
	else
	{
		echo "Couldnt insert details";
	}
    //Close database connection
    mysqli_close($DBConnect);
  }
?>


