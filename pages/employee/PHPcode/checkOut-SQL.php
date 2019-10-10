<?php 
  include_once("../../sessionCheckPages.php");

  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    echo ("DATABASE ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
      $realCheckin;
      $realCheckout;

      $employeeID = $_POST["qrCode"];

      $nameQuery = "SELECT A.NAME, A.SURNAME, B.WAGE_EARNING FROM EMPLOYEE A JOIN EMPLOYEE_TYPE B ON A.EMPLOYEE_TYPE_ID = B.EMPLOYEE_TYPE_ID WHERE EMPLOYEE_ID = '$employeeID'";

      $employeNameQueryResult = mysqli_query($DBConnect,$nameQuery);
      $employee= mysqli_fetch_assoc($employeNameQueryResult);
      $nameSurname = $employee["NAME"]." ".$employee["SURNAME"];

      if($employee["WAGE_EARNING"] == 1)
      {
        $get_query="SELECT * FROM CHECKIN_CHECKOUT_TIME WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";

        $get_result=mysqli_query($DBConnect,$get_query);

        if(mysqli_num_rows($get_result)>0)
        {
            if($row= mysqli_fetch_assoc($get_result))
            {
            $realCheckin = $row["ARRIVAL_TIME"];
            $realCheckout = $row["DEPATURE_TIME"];

            $sql = "SELECT HASH FROM EMPLOYEE_QR WHERE (EMPLOYEE_ID='$employeeID')";
            $query_QR = mysqli_query($DBConnect , $sql);
        
            $time = new DateTime();
            $currentTime = $time->format("H:i:s");//checkin/checkout time.

            $addedTime = "";//flag
        
            //date("H:i:s");
            $time = new DateTime();
            $currentTime = $time->format("Y-m-d H:i:s");//checkin/checkout time.

            $addedTime = "";//flag

            //date("H:i:s");
            $day = date("Y-m-d");
            $setCheckinTime = new DateTime($realCheckin);
            $setCheckinTime = $setCheckinTime->format("Y-m-d H:i:s");

            $checkoutTime = new DateTime($realCheckout);
            $checkoutTime = $checkoutTime->format("Y-m-d H:i:s");

            $checkIfTime = "SELECT * FROM EMPLOYEE_HOUR  WHERE `EMPLOYEE_ID` ='$employeeID' and `DATE`= '$day' AND `CHECK_OUT_TIME` = '0000-00-00 00:00:00'";
            $subCheckTime = mysqli_query($DBConnect,$checkIfTime);
                
            if($query_QR && mysqli_num_rows($subCheckTime) >0)
            {
                if(($currentTime < $checkoutTime) && ($currentTime > $setCheckinTime))
                {
                     //$currentTime = $setCheckinTime;
                    
                    
                    $query = "UPDATE `EMPLOYEE_HOUR` 
                    SET `CHECK_OUT_TIME`= '$currentTime'
                    WHERE `EMPLOYEE_ID` ='$employeeID' and `DATE`= '$day'";
                  
                    $submitQuery = mysqli_query($DBConnect,$query);
                    
                    if($submitQuery)
                    {
                        $addedTime = "Time SQL works";
                    }
        
                }
                else if($currentTime >= $checkoutTime)
                {
                     
                    $currentTime = $checkoutTime;
                    $query = "UPDATE `EMPLOYEE_HOUR` 
                    SET `CHECK_OUT_TIME`= '$currentTime'
                    WHERE `EMPLOYEE_ID` ='$employeeID' and `DATE`= '$day'";
        
                    $submitQuery = mysqli_query($DBConnect,$query);
        
                    if($submitQuery)
                    {
                        $addedTime = "Time SQL works";
                    }
                }
                else
                {
                    echo "Too early to checkout,".$employeeID.",".$nameSurname;;
                }
              }
              else
              {
                  echo "already checked out,".$employeeID.",".$nameSurname;
              }

              $verifyID = sha1($employeeID);

              //Audit Log Check-In Changes
              $changes="ID : ".$employeeID."| Employee Checked-Out | Employee CheckOut Date and Time :".$currentTime;



              //var_dump($verifyID);
              while($correctHash = mysqli_fetch_assoc($query_QR))
              {
                  if($correctHash["HASH"]== $verifyID && $addedTime == "Time SQL works" )
                  {
                    $DateAudit = date('Y-m-d H:i:s');
                    $Functionality_ID='2.5';
                    $userID = $_SESSION['userID'];
                    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                    $audit_result=mysqli_query($DBConnect,$audit_query);    

                    $response = "success".",".$employeeID.",".$nameSurname.",".$currentTime;
                    echo $response;
                    break;
                  }
              }
            }
            else
            {
              echo "No checkin/checkout times set,".$employeeID.",".$nameSurname;;   
            }
        }
        else
        { 
          echo "No checkin/checkout times set,".$employeeID.",".$nameSurname;;  
        }
      }
      else
      {
        echo "not wage earning,".$employeeID.",".$nameSurname;;
      }

      mysqli_close($DBConnect);


  }

?>