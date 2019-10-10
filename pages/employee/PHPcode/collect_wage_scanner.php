<?php 


include_once("DBConnection.php");

if($DBConnect === false)
{
die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{

            $employeeID = $_POST["qrCode"];
           
   


   
            $sql = "SELECT HASH FROM EMPLOYEE_QR WHERE (EMPLOYEE_ID='$employeeID')";
            $query_QR = mysqli_query($DBConnect , $sql);
            $success = "success";
            if($query_QR)
            {
                $sql = "SELECT EMPLOYEE_TYPE.WAGE_EARNING FROM EMPLOYEE
                INNER JOIN EMPLOYEE_TYPE
                ON EMPLOYEE.EMPLOYEE_TYPE_ID = EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID
                 WHERE (EMPLOYEE_ID='$employeeID')";
                $query_QR = mysqli_query($DBConnect , $sql);

                if($query_QR)
                {
                    if($row = mysqli_fetch_assoc($query_QR))
                    {
                        if($row["WAGE_EARNING"] == 1)
                        {
                            echo $success;
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
                        echo "Inner join is faulty";
                }


               
            }
            else
            {
                echo "Employee not found on system";
            }
               
        
            mysqli_close($DBConnect);
}

   


?>


