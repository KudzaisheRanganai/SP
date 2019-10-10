<?php 


include_once("DBConnection.php");

if($DBConnect === false)
{
die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
            $day = date("Y-m-d");
            $counter = 0;
            $temp = array();
            $employee_ID = "";
            $testerVariable = $_POST["exampleVariable"];
            $emptyCheckInTime;
            $total_employees = 0;
   if($testerVariable)
   {

                $query = "SELECT count(EMPLOYEE.EMPLOYEE_ID) as total_employees  FROM EMPLOYEE_TYPE
                INNER JOIN EMPLOYEE ON EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID = EMPLOYEE.EMPLOYEE_TYPE_ID
                WHERE EMPLOYEE_TYPE.NAME LIKE '%Admin%'";
                $execute = mysqli_query($DBConnect , $query);
                if($execute)
                {
                    if($allValues = mysqli_fetch_assoc($execute))
                    {
                         $total_employees = $allValues["total_employees"];
                         echo "Total n.o of employees is " . $total_employees . "\n";
                    }
                }
                else
                {
                    echo "Error with finding the number of employees that are active";
                }
               


                $query = "SELECT EMPLOYEE.EMPLOYEE_ID
                FROM EMPLOYEE_TYPE
                INNER JOIN EMPLOYEE ON EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID = EMPLOYEE.EMPLOYEE_TYPE_ID
                WHERE EMPLOYEE_TYPE.NAME LIKE '%Admin%'
                GROUP BY EMPLOYEE.EMPLOYEE_ID";
                $execute = mysqli_query($DBConnect , $query);

                if($execute)
                {
                    while($allValues = mysqli_fetch_assoc($execute))
                    {

                        $employee_ID = $allValues["EMPLOYEE_ID"];
                        $sql = "SELECT *
                        FROM USER
                        INNER JOIN EMPLOYEE ON EMPLOYEE.EMPLOYEE_ID = USER.EMPLOYEE_ID
                        INNER JOIN AUDIT_LOG ON AUDIT_LOG.USER_ID = USER.USER_ID
                        WHERE (EMPLOYEE.EMPLOYEE_ID='$employee_ID' && AUDIT_LOG.AUDIT_DATE LIKE '%$day%')
                        GROUP BY AUDIT_LOG.USER_ID";
                        $query_QR = mysqli_query($DBConnect , $sql);
                        
                        
                        if($query_QR)
                        {
                         
                            $rower = mysqli_fetch_assoc($query_QR);
                            $counter = $counter+1;
                        
                        }
                       
                
                    }
                }
                else
                {
                    echo "Error with finding the number of employees that earn wage";
                }
               

                if($counter > 0)
                {
                    
                    echo "Total number of active employees is: " . $counter . ":" . $total_employees. "\n";
                }
                else
                {
                    echo "No one is active";
                }


                


               
       
   }
   else
   {
        echo "Ajax sent empty variable";
   }

    

            mysqli_close($DBConnect);


}


?>