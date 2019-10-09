<?php
include_once("../../sessionCheckPages.php");
    
include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    $choice = $_POST["choice"];



        if($choice == 2)
        {
            $sql = "SELECT USER.USER_ID, USER.USERNAME, USER.USER_PASSWORD , USER.EMPLOYEE_ID, EMPLOYEE.NAME , EMPLOYEE.SURNAME , USER_STATUS.USER_STATUS_NAME
            FROM USER
            INNER JOIN EMPLOYEE ON USER.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
            INNER JOIN USER_STATUS on USER_STATUS.USER_STATUS_ID = USER.USER_STATUS_ID
            WHERE USER.USER_STATUS_ID = '1'";
            //var_dump($sql);
            $submit = mysqli_query($DBConnect,$sql);
            if($submit)
            {
            if (mysqli_num_rows($submit)>0)
            {
                $count=0;
                while ($row = mysqli_fetch_assoc($submit))
                {
                $vals[]=$row;
                //$vals[$count]["ID"]=$row["SUPPLIER_ID"];
                $count=$count+1;
                }
                echo json_encode($vals);
            }
            }
            else
            {
            echo "False";
            }
        }


        if($choice == 4)
        {


                        
                    $user_ID =  $_POST["user_ID"];
                
                    if(isset($user_ID))
                    {
                        
                        $sql ="DELETE FROM USER WHERE USER_ID = '$user_ID'";
                        $submitQuery = mysqli_query($DBConnect,$sql);
                            if($submitQuery)
                            {
                                $changes="Deleted user ID : ".$user_ID;
                                $DateAudit = date('Y-m-d H:i:s');
                                $Functionality_ID='4.7';
                                $userID = $_SESSION['userID'];
                                $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$user_ID','$Functionality_ID','$changes')";
                                $audit_result=mysqli_query($DBConnect,$audit_query);
                                echo "success";
                            }
                            else
                            {
                                echo "error";
                            }
                    
                    }




    }
    
    //Close the connection
    mysqli_close($DBConnect);
  }
  
?>




