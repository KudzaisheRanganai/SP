<?php

  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
      $choice = $_POST["choice"];
      if($choice == 0 )
      {
            $vals = array();

            $get_query = "SELECT * FROM `ACCESS_LEVEL`";
            $get_result = mysqli_query($DBConnect,$get_query);
            if(mysqli_num_rows($get_result)>0)
            {
              while($row=mysqli_fetch_assoc($get_result))
              {
                $vals[]=$row;
              }
              echo json_encode($vals);
            }
            else
            {
              echo "False";
            }
      }
      else if($choice > 0 )
      {

        $postionName; 
        $wageEarningID;
        $accessLevelID;// = $_POST["accessLevel"];
        $employeeTypeID = $_POST["employee_type_id"];

        $maintainedChecker = "Empty";
          if(isset($_POST["position"]))
          {
            $postionName = $_POST["position"];
          }
          if(isset($_POST["wage_earner"]))
          {
            $wageEarningID = $_POST["wage_earner"];
          }
          if(isset($_POST["accessLevel"]))
          {
            $accessLevelID = $_POST["accessLevel"];
          }

           
           
           
            //$userStatusID = $_POST["userStatusID"];
           

            $checkIfTypeExists = "SELECT * FROM EMPLOYEE_TYPE WHERE (`EMPLOYEE_TYPE_ID`='$employeeTypeID')";
            
                $checkResult=mysqli_query($DBConnect,$checkIfTypeExists);
                if($checkResult)
                {
                    $row=mysqli_fetch_assoc($checkResult);
                    if(isset($row["NAME"]) || isset($row["ACCESS_LEVEL_ID"]))
                    {
                        if(!empty($postionName))
                        {
                            $add_query="UPDATE EMPLOYEE_TYPE
                            SET `NAME`='$postionName'
                            WHERE (`EMPLOYEE_TYPE_ID`='$employeeTypeID')";
                            $add_result=mysqli_query($DBConnect,$add_query);
                            if($add_result)
                            {
                                $maintainedChecker="success";
                            }
                            else
                            {
                              echo  "failure to update Position Name";
                            } 
                        }
                        if(!empty($wageEarningID) || $wageEarningID==0)
                        {
                            $add_query="UPDATE EMPLOYEE_TYPE
                            SET `WAGE_EARNING`='$wageEarningID'
                            WHERE (`EMPLOYEE_TYPE_ID`='$employeeTypeID')";
                            $add_result=mysqli_query($DBConnect,$add_query);
                            if($add_result)
                            {
                                $maintainedChecker="success";
                            }
                            else
                            {
                              echo  "failure to update Wage Earning Flag";
                            } 
                        }
                        if(!empty($accessLevelID)&& isset($accessLevelID))
                        {
                            $add_query="UPDATE EMPLOYEE_TYPE 
                            SET `ACCESS_LEVEL_ID`='$accessLevelID'
                            WHERE (`EMPLOYEE_TYPE_ID`='$employeeTypeID')";
                            //var_dump($add_query);
                            $add_result=mysqli_query($DBConnect,$add_query);
                            if($add_result)
                            {
                                $maintainedChecker ="success";
                            }
                            else
                            {
                              echo  "failure to update accessLevel";
                            } 
                        }
                    
    
                        if($maintainedChecker=="success")
                        {
                            echo $maintainedChecker;
                        }
                        else
                        {
                            echo "Nothing is maintained";
                        }
                    }
                    else
                    {
                        echo "Employee Type to be updated does not exist!";
                    }
                
                  
                    //echo "Arrived to insert"; 
           
       
                    
            }
            else
            {
            
              echo "Database Error!";
             
            }
         





      }


      
    
    //Close database connection
    //.
    mysqli_close($DBConnect);
  }
?>