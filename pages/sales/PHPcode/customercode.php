<?php
	include_once("connection.php");
	include_once("functions.php");
	if($_POST["choice"]==1)
	{
		if(checkCustomer($con,$_POST["name"],$_POST["contact"]))
		{
			echo "F,Customer Exists";
		}
		else
		{
			if(addOrgCustomer($con,$_POST["name"],$_POST["vat"],$_POST["contact"],$_POST["email"],$_POST["customer_type"],$_POST["status"]))
			{
				$stopCount=$_POST["num"]-1;
				for ($i=0; $i<$_POST["num"];$i++) 
				{ 
					if(addressCheck($con,$_POST["address"][$i]))
					{
						if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
						{
							if($i==$stopCount)
							{
								echo "T,Customer Added Successfully";
							}
							
						}
						else
						{
							echo "F,Customer Added but Customer Address Not Added ".$i;
						}
					}
					else
					{
						if(checkSuburb($con,$_POST["suburb"][$i]))
						{
							if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
							{
								if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
								{
									if($i==$stopCount)
									{
										echo "T,Customer Added Successfully";
									}
								}
								else
								{
									echo "F,Suburb Found Address added but Customer Address Not Added ".$i;
								}

							}
							else
							{
								echo "F,Suburb found but Address not added. ".$i;
							}
						}
						else
						{
							if(checkCity($con,$_POST["city"][$i]))
							{
								if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
								{

									if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
									{
										if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
										{
											if($i==$stopCount)
											{
												echo "T,Customer Added Successfully";
											}
										}
										else
										{
											echo "F,City found Suburb Added Address Added but Customer Address Not Added ".$i; //A Test triggered this
										}

									}

								}
								else
								{
									echo "F,City Found but Suburb Not Added ".$i;
								}
							}
							else
							{
								if(addCity($con,$_POST["city"][$i]))
								{
									if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
									{

										if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
										{
											if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
											{
												if($i==$stopCount)
												{
													echo "T,Customer Added Successfully";
												}
											}
											else
											{
												echo "F,City Added Suburb Added Address Added but Customer Address Not Added ".$i;
											}

										}

									}
									else
									{
										echo "F,City Added but Suburb Not Added ".$i;
									}

								}
								else
								{
									echo "F,City Not Added ".$i;
								}
							}
						}
					}	
				}
			}//
			else
			{
				echo "F,Customer Not added";
			}
		}
	}
	elseif($_POST["choice"]==2)
	{
		if($_POST["customer_type"]==1)
		{
			if(updateIndCustomer($con,$_POST["ID"],$_POST["name"],$_POST["vat"],$_POST["contact"],$_POST["email"],$_POST["title"],$_POST["customer_type"],$_POST["status"]))
			{
				if(removeAllCustomerAddress($con,$_POST["ID"]))
				{
					$stopCount=$_POST["num"]-1;
					for ($i=0; $i<$_POST["num"];$i++) 
					{ 
						if(addressCheck($con,$_POST["address"][$i]))
						{
							if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
							{
								if($i==$stopCount)
								{
									echo "T,Customer Updated";
								}
								
							}
							else
							{
								echo "F,Customer Added but Customer Address Not Added ".$i;
							}
						}
						else
						{
							if(checkSuburb($con,$_POST["suburb"][$i]))
							{
								if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
								{
									if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
									{
										if($i==$stopCount)
										{
											echo "T,Customer Updated";
										}
									}
									else
									{
										echo "F,Suburb Found Address added but Customer Address Not Added ".$i;
									}

								}
								else
								{
									echo "F,Suburb found but Address not added. ".$i;
								}
							}
							else
							{
								if(checkCity($con,$_POST["city"][$i]))
								{
									if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
									{

										if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
										{
											if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
											{
												if($i==$stopCount)
												{
													echo "T,Customer Updated";
												}
											}
											else
											{
												echo "F,City found Suburb Added Address Added but Customer Address Not Added ".$i; //A Test triggered this
											}

										}

									}
									else
									{
										echo "F,City Found but Suburb Not Added ".$i;
									}
								}
								else
								{
									if(addCity($con,$_POST["city"][$i]))
									{
										if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
										{

											if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
											{
												if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
												{
													if($i==$stopCount)
													{
														echo "T,Customer Updated";
													}
												}
												else
												{
													echo "F,City Added Suburb Added Address Added but Customer Address Not Added ".$i;
												}

											}

										}
										else
										{
											echo "F,City Added but Suburb Not Added ".$i;
										}

									}
									else
									{
										echo "F,City Not Added ".$i;
									}
								}
							}
						}	
					}
				}
				else
				{
					echo "F,Customer Updated but Customer addresses not removed";
				}
			}
			else
			{
				echo "F,Customer Not added";
			}
		}
		else
		{
			if(updateOrgCustomer($con,$_POST["ID"],$_POST["name"],$_POST["vat"],$_POST["contact"],$_POST["email"],$_POST["customer_type"],$_POST["status"]))
			{
				if(removeAllCustomerAddress($con,$_POST["ID"]))
				{
					$stopCount=$_POST["num"]-1;
					for ($i=0; $i<$_POST["num"];$i++) 
					{ 
						if(addressCheck($con,$_POST["address"][$i]))
						{
							if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
							{
								if($i==$stopCount)
								{
									echo "T,Customer Updated";
								}
								
							}
							else
							{
								echo "F,Customer Added but Customer Address Not Added ".$i;
							}
						}
						else
						{
							if(checkSuburb($con,$_POST["suburb"][$i]))
							{
								if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
								{
									if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
									{
										if($i==$stopCount)
										{
											echo "T,Customer Updated";
										}
									}
									else
									{
										echo "F,Suburb Found Address added but Customer Address Not Added ".$i;
									}

								}
								else
								{
									echo "F,Suburb found but Address not added. ".$i;
								}
							}
							else
							{
								if(checkCity($con,$_POST["city"][$i]))
								{
									if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
									{

										if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
										{
											if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
											{
												if($i==$stopCount)
												{
													echo "T,Customer Updated";
												}
											}
											else
											{
												echo "F,City found Suburb Added Address Added but Customer Address Not Added ".$i; //A Test triggered this
											}

										}

									}
									else
									{
										echo "F,City Found but Suburb Not Added ".$i;
									}
								}
								else
								{
									if(addCity($con,$_POST["city"][$i]))
									{
										if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
										{

											if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
											{
												if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
												{
													if($i==$stopCount)
													{
														echo "T,Customer Updated";
													}
												}
												else
												{
													echo "F,City Added Suburb Added Address Added but Customer Address Not Added ".$i;
												}

											}

										}
										else
										{
											echo "F,City Added but Suburb Not Added ".$i;
										}

									}
									else
									{
										echo "F,City Not Added ".$i;
									}
								}
							}
						}	
					}
				}
				else
				{
					echo "F,Customer Updated but Customer addresses not removed";
				}
			}
			else
			{
				echo "F,Customer Not added";
			}
		}
	}
	elseif($_POST["choice"]==3)
	{
		$sql_query ="SELECT * FROM CUSTOMER WHERE STATUS_ID='1'";
	    $result = mysqli_query($con,$sql_query);
	    //$row = mysqli_fetch_array($result);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["Customer_ID"];
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
		
		if(checkCustomer($con,$_POST["name"],$_POST["contact"]))
		{
			echo "F,Customer Exists";
		}
		else
		{
			if(addIndCustomer($con,$_POST["name"],$_POST["surname"],$_POST["contact"],$_POST["email"],$_POST["title"],$_POST["customer_type"],$_POST["status"]))
			{
				$stopCount=$_POST["num"]-1;
				for ($i=0; $i<$_POST["num"];$i++) 
				{ 
					if(addressCheck($con,$_POST["address"][$i]))
					{
						if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
						{
							if($i==$stopCount)
							{
								echo "T,Customer Added";
							}
							
						}
						else
						{
							echo "F,Customer Added but Customer Address Not Added ".$i;
						}
					}
					else
					{
						if(checkSuburb($con,$_POST["suburb"][$i]))
						{
							if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
							{
								if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
								{
									if($i==$stopCount)
									{
										echo "T,Customer Added";
									}
								}
								else
								{
									echo "F,Suburb Found Address added but Customer Address Not Added ".$i;
								}

							}
							else
							{
								echo "F,Suburb found but Address not added. ".$i;
							}
						}
						else
						{
							if(checkCity($con,$_POST["city"][$i]))
							{
								if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
								{

									if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
									{
										if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
										{
											if($i==$stopCount)
											{
												echo "T,Customer Added";
											}
										}
										else
										{
											echo "F,City found Suburb Added Address Added but Customer Address Not Added ".$i; //A Test triggered this
										}

									}

								}
								else
								{
									echo "F,City Found but Suburb Not Added ".$i;
								}
							}
							else
							{
								if(addCity($con,$_POST["city"][$i]))
								{
									if(addSuburb($con,$_POST["suburb"][$i],getCityID($con,$_POST["city"][$i]),$_POST["zip"][$i]))
									{

										if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
										{
											if(addCustomerAddress($con,getAddressID($con,$_POST["address"][$i]),getCustomerID($con,$_POST["name"],$_POST["contact"])))
											{
												if($i==$stopCount)
												{
													echo "T,Customer Added";
												}
											}
											else
											{
												echo "F,City Added Suburb Added Address Added but Customer Address Not Added ".$i;
											}

										}

									}
									else
									{
										echo "F,City Added but Suburb Not Added ".$i;
									}

								}
								else
								{
									echo "F,City Not Added ".$i;
								}
							}
						}
					}	
				}
			}//
			else
			{
				echo "F,Customer Not added";
			}
		}
	}
	elseif($_POST["choice"]==5)
	{
		if(removeCustomerAddress($con,$_POST["addressID"],$_POST["customerID"]))
		{
			echo "True";
		}
		else
		{
			echo "False";
		}
	}
	mysqli_close($con);
?>