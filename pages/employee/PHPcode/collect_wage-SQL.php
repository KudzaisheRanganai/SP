<?php 
include_once("../../sessionCheckPages.php");

include_once("DBConnection.php");

if($DBConnect === false)
{
die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{

            $wage_rate = $_POST["wageRate"];
           
            $wage_total = $_POST["totalDue"];
            $employee_ID = $_POST["employee_ID"];
   
            $day = date("Y-m-d");

   

            $changes="";
            $changes="ID :".$employee_ID;
            $changes=$changes." | Wage Collected"." | Wage Amount :".$wage_total. " | Wage Rate :".$wage_rate;

            $sql = "SELECT EMPLOYEE_ID FROM WAGE WHERE (EMPLOYEE_ID='$employee_ID')";
            $query_QR = mysqli_query($DBConnect , $sql);
            $success = "success";
            if($query_QR)
            {
                $wageQuery = "UPDATE WAGE
                SET `TOTAL_DUE`='$wage_total' , `DATE_ISSUED`= '$day' , `WAGE_RATE`='$wage_rate' 
                WHERE (EMPLOYEE_ID='$employee_ID')";
                //var_dump($wageQuery);
                $submitWageQuery = mysqli_query($DBConnect , $wageQuery);

                if($submitWageQuery)
                {

                    $DateAudit = date('Y-m-d H:i:s');
                    $Functionality_ID='2.6';
                    $userID = $_SESSION['userID'];
                    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                    $audit_result=mysqli_query($DBConnect,$audit_query);  



                    echo $success;
                }
                else
                {
                    echo "Could not update the wage table";
                }


            }
            else
            {
                echo "Employee does not qualify for wage";
            }
               
        
            mysqli_close($DBConnect);
}

   


?>


