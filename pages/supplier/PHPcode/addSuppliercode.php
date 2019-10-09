<?php
	include_once("../../sessionCheckPages.php");
	include_once("connection.php");
	include_once("functions.php");
	//////////////////////////////////////////////////////////////
	if($_POST["choice"]==1)
	{
		if(checkSupplier($con,$_POST["contact"]))
		{
			echo "F,Supplier Exists";
		}
		else
		{
			if(addSupplier($con,$_POST["name"],$_POST["vat"],$_POST["contact"],$_POST["email"]))
			{
				$stopCount=$_POST["num"]-1;
				for ($i=0; $i<$_POST["num"];$i++) 
				{ 
					if(addressCheck($con,$_POST["address"][$i]))
					{
						if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
						{
							if($i==$stopCount)
							{
								echo "T,Supplier Added";
							}
							
						}
						else
						{
							echo "F,Supplier Added but Supplier Address Not Added ".$i;
						}
					}
					else
					{
						if(checkSuburb($con,$_POST["suburb"][$i]))
						{
							if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
							{
								if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
								{
									if($i==$stopCount)
									{
										echo "T,Supplier Added";
									}
								}
								else
								{
									echo "F,Suburb Found Address added but Supplier Address Not Added ".$i;
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
										if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
										{
											if($i==$stopCount)
											{
												echo "T,Supplier Added";
											}
										}
										else
										{
											echo "F,City found Suburb Added Address Added but Supplier Address Not Added ".$i; //A Test triggered this
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
											if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
											{
												if($i==$stopCount)
												{
													echo "T,Supplier Added";
												}
											}
											else
											{
												echo "F,City Added Suburb Added Address Added but Supplier Address Not Added ".$i;
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
				echo "F,Supplier Not added";
			}
		}
	}
	elseif ($_POST["choice"]==2) 
	{
		if(updateSupplier($con,$_POST["ID"],$_POST["name"],$_POST["vat"],$_POST["contact"],$_POST["email"]))
			{
				if(removeAllSupplierAddress($con,$_POST["ID"]))
				{
					$stopCount=$_POST["num"]-1;
					for ($i=0; $i<$_POST["num"];$i++) 
					{ 
						if(addressCheck($con,$_POST["address"][$i]))
						{
							if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
							{
								if($i==$stopCount)
								{
									echo "T,Supplier Updated";
								}
								
							}
							else
							{
								echo "F,Supplier Added but Supplier Address Not Added ".$i;
							}
						}
						else
						{
							if(checkSuburb($con,$_POST["suburb"][$i]))
							{
								if(addAddress($con,$_POST["address"][$i],getSuburbID($con,$_POST["suburb"][$i])))
								{
									if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
									{
										if($i==$stopCount)
										{
											echo "T,Supplier Updated";
										}
									}
									else
									{
										echo "F,Suburb Found Address added but Supplier Address Not Added ".$i;
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
											if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
											{
												if($i==$stopCount)
												{
													echo "T,Supplier Updated";
												}
											}
											else
											{
												echo "F,City found Suburb Added Address Added but Supplier Address Not Added ".$i; //A Test triggered this
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
												if(addSupplierAddress($con,getAddressID($con,$_POST["address"][$i]),getSupplierID($con,$_POST["contact"])))
												{
													if($i==$stopCount)
													{
														echo "T,Supplier Updated";
													}
												}
												else
												{
													echo "F,City Added Suburb Added Address Added but Supplier Address Not Added ".$i;
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
					echo "F,Supplier Updated but Supplier addresses not removed";
				}
			}
			else
			{
				echo "F,Supplier Not added";
			}
	}
	elseif ($_POST["choice"]==3)
	{
		$sql_query ="SELECT * FROM SUPPLIER";
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
		if(removeSupplierAddress($con,$_POST["addressID"],$_POST["supplierID"]))
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