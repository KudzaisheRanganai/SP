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
                echo $success;
            }
            else
            {
                echo "not found";
            }
               
        
            mysqli_close($DBConnect);
}

   


?>