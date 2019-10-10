<?php
include_once("../../sessionCheckPages.php");
include "meRaviQr/qrlib.php";
  include_once("DBConnection.php");
 
   if($DBConnect === false)
   {
     die("ERROR: Could not connect. " . mysqli_connect_error());
   }
   else
   {

        $employeeID = $_POST["employee_ID"];
        if($employeeID)
        {
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


                                    $changes="";
                                    $changes="ID :".$employeeID;
                                    $changes=$changes." | Employee Tag Regenerated";
                             


                                    $hash = sha1($employeeID);
                                    $qrImgName = $employeeID;
                                
                                
                                    $final = $employeeID ; //.$dev;
                                    $qrs = QRcode::png($final,"userQr/$qrImgName.png","H","3","3");
                                    $qrimage = $qrImgName.".png";
                                    $workDir = $_SERVER['HTTP_HOST'];
                                    $qrlink = $workDir."/qrcode".$qrImgName.".png";
                                    $date = date("Y-m-d H:i:s");
                                    
                                    $sql = "UPDATE EMPLOYEE_QR
                                    SET `HASH` = '$hash', `DATE_GENERATED`= '$date' 
                                    WHERE `EMPLOYEE_ID`='$employeeID'";
                                    //var_dump($sql);
                                    $query_QR = mysqli_query($DBConnect , $sql);
                                    if($query_QR)
                                    {



                                       
                                            $DateAudit = date('Y-m-d H:i:s');
                                            $Functionality_ID='2.7';
                                            $userID = $_SESSION['userID'];
                                            $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                                            $audit_result=mysqli_query($DBConnect,$audit_query);
                                        
                                        echo $employeeID . ",success";
                                    }
                                    else
                                    {
                                        echo "Couldnt regenerate employee tag!";
                                    }
                            }
                            else
                            {
                                echo "Employee does not earn wage";
                            }

                        }
                        else
                        {
                            echo "Fetch array has errors";
                        }
                    }
                    else
                    {
                        echo "Employee type does not exist thus cannot have an employee tag.";
                    }


                           
            }
            else
            {
                echo "Could not find name and surname of worker";
            }
            //Close database connection
            mysqli_close($DBConnect);
        }


    

   



												 
												 