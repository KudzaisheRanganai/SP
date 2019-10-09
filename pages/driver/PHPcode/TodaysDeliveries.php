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
            $total_deliveries = 0;
   if($testerVariable)
   {

                $query = "SELECT count(DELIVERY_ID) as total_deliveries  FROM DELIVERY";
                $execute = mysqli_query($DBConnect , $query);
                if($execute)
                {
                    if($allValues = mysqli_fetch_assoc($execute))
                    {
                         $total_deliveries = $allValues["total_deliveries"];
                         echo "Total n.o of deliveries is " . $total_deliveries . "\n";
                    }
                }
                else
                {
                    echo "Error with finding the number of deliveries.";
                }
               



                $day = date("Y-m-d");
                $counter = 0;
                $temp = 0;
                $sql = "SELECT count(DELIVERY_ID) as total_deliveries  FROM DELIVERY 
                WHERE (`EXPECTED_DATE`LIKE '%$day%')";
                
                $query_QR = mysqli_query($DBConnect , $sql);
                
                
                if($query_QR)
                {
                    if($row = mysqli_fetch_assoc($query_QR))
                    {
                        $temp = $row["total_deliveries"];
                        $counter++;
                    }
                    
                    if($counter > 0)
                    {
                        
                        echo "Total number of daily deliveries is: " . $temp . ":" .  $total_deliveries;
                    }
                    else
                    {
                        echo "No deliveries were made on this day.";
                    }
                    
                
                }
                else
                {
                    echo "Select SQL statement error! \n" ;
                    echo $sql;
                }
        
       
   }
   else
   {
        echo "Ajax sent empty variable";
   }

    

            mysqli_close($DBConnect);


}


?>