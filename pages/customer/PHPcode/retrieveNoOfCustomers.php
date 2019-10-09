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