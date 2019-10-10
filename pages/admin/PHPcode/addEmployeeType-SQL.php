<?php
  include_once("../../sessionCheckPages.php");
  $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

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
            $postionName = $_POST["position"];
            $wageEarningID = $_POST["wage_earner"];
            $accessLevelID = $_POST["accessLevel"];
           
            $checkIfUserExists = "SELECT NAME , WAGE_EARNING , ACCESS_LEVEL_ID FROM EMPLOYEE_TYPE WHERE (`ACCESS_LEVEL_ID`='$accessLevelID' and `NAME`='$postionName') ";
            $checkResult=mysqli_query($DBConnect,$checkIfUserExists);
            if($checkResult)
            {
              $row=mysqli_fetch_assoc($checkResult);
                if(isset($row["NAME"]) || isset($row["ACCESS_LEVEL_ID"]) )
                {
                  echo "Employee Type exists!";
                }
                else
                {
                   


                    $add_query="INSERT INTO EMPLOYEE_TYPE (`NAME`,`WAGE_EARNING`,`ACCESS_LEVEL_ID`) VALUES ('$postionName','$wageEarningID','$accessLevelID')";
                    //var_dump($add_query);
                    $add_result=mysqli_query($DBConnect,$add_query);

                    if($add_result)
                    {
                      $last_id = mysqli_insert_id($DBConnect);
                      $DateAudit = date('Y-m-d H:i:s');
                      $Functionality_ID='4.1';
                      $userID = $_SESSION['userID'];
                      $changes="ID : ".$last_id;
                        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                        $audit_result=mysqli_query($DBConnect,$audit_query);
                        if($audit_result)
                        {
                          
                        }
                        else
                        {
                          
                        }
                      echo "success";
                    }
                    else
                    {
                      echo  "failure to insert";
                    } 
                    //echo "Arrived to insert"; 
                }

              
              
            }
            else
            {
            
              echo "Database Error";
             
            }

       
      }


      
    
    //Close database connection
    mysqli_close($DBConnect);
  }
?>