<?php 


include_once("DBConnection.php");

if($DBConnect === false)
{
die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{

            $testerVariable = $_POST["exampleVariable"];
            $emptyCheckInTime;
   if($testerVariable)
   {
                $date = date("Y-m-d");
                $query = "SELECT count(*) as total_customers  FROM CUSTOMER";
                $execute = mysqli_query($DBConnect , $query);
                if($execute)
                {
                    if($allValues = mysqli_fetch_assoc($execute))
                    {
                         $total_customers = $allValues["total_customers"];
                         echo "All credit customers number is " . $total_customers . "\n";
                    }
                }
                else
                {
                    echo "Error with finding the number of credit customers.";
                }

                $query = "SELECT count(*) as total_customers  FROM CUSTOMER_ACCOUNT WHERE (`DATE_OPENED` = '$date' )";
                $execute = mysqli_query($DBConnect , $query);
                if($execute)
                {
                    if($allValues = mysqli_fetch_assoc($execute))
                    {
                         $customers = $allValues["total_customers"];
                         echo "Total n.o of credit customers is:" . $customers . ":" . $total_customers . "\n";
                    }
                }
                else
                {
                    echo "Error with finding the number of credit customers that earn wage";
                }
               



               
       
   }
   else
   {
        echo "Ajax sent empty variable";
   }

    

            mysqli_close($DBConnect);


}


?>