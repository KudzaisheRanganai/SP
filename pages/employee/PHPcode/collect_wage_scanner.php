<?php 


$url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');
$DBConnect;

$DBConnect = mysqli_connect($hostname, $username, $password, $database);

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


