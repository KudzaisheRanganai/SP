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
    /*$receiver = $_POST["receiver"];//8
    $sender = $_POST["sender"];//5
    $date = mysqli_real_escape_string($conn, date('Y/m/d H:i:s'));*/

    /*if(isset($info))
    {
        $subm = "INSERT INTO `chats`(`receiver_id`, `sender_id`, `chat`, `date_order`) VALUES ('$receiver','$sender','$info','$date')";
        $check= mysqli_query($conn,$subm);
    }*/

    $sql = "SELECT HASH FROM EMPLOYEE_QR WHERE (EMPLOYEE_ID='$employeeID')";
    $query_QR = mysqli_query($DBConnect , $sql);

    //$request ="SELECT * FROM `chats` WHERE ((receiver_id='$receiver' and sender_id='$sender') or (receiver_id='$sender' and sender_id='$receiver'))
    //ORDER BY date_order Asc" ;
    //echo $request;
    //$submit = mysqli_query($conn,$request);

    $time = new DateTime();
    $currentTime = $time->format("Y-m-d H:i:s");//checkin/checkout time.
   var_dump($currentTime); 
   
    $addedTime = "";//flag

     //date("H:i:s");
    $day = date("Y-m-d");
    $setCheckinTime = new DateTime("08:00:00");
    $setCheckinTime = $setCheckinTime->format("Y-m-d H:i:s");
    //var_dump($setCheckinTime);
    $checkoutTime = new DateTime("23:00:00");
    $checkoutTime = $checkoutTime->format("Y-m-d H:i:s");
    var_dump($checkoutTime);

   
    if($query_QR)
    {
        if($currentTime <= $setCheckinTime)
        {
             $currentTime = $setCheckinTime;
            
            $query = "INSERT INTO `EMPLOYEE_HOUR`(`DATE`, `CHECK_IN_TIME`, `CHECK_OUT_TIME`, `EMPLOYEE_ID`) VALUES ('$day','$currentTime','NULL','$employeeID')";
            var_dump($query);
            $submitQuery = mysqli_query($DBConnect,$query);
            if($submitQuery)
            {
                $addedTime = "Time SQL works";
            }
            

        }
        else if($currentTime >= $setCheckinTime && $currentTime <= $checkoutTime)
        {
             
            $query = "INSERT INTO `EMPLOYEE_HOUR`(`DATE`, `CHECK_IN_TIME`, `CHECK_OUT_TIME`, `EMPLOYEE_ID`) VALUES ('$day','$currentTime','NULL','$employeeID')";
            var_dump($query);
            $submitQuery = mysqli_query($DBConnect,$query);
            var_dump($submitQuery);
            if($submitQuery)
            {
                $addedTime = "Time SQL works";
            }
            
        }
        else
        {
            echo "Cannot checkin because its over the checkout time ";
        }


    }
    else
    {
        echo "Employee does not exist on system";
    }
    $verifyID = sha1($employeeID);
    //var_dump($verifyID);
    while($correctHash = mysqli_fetch_assoc($query_QR))
    {
        if($correctHash["HASH"]== $verifyID && $addedTime == "Time SQL works" )
        {
           $success = "success";
            echo $success;
            break;
        }
    }


    //Used for search
    /*$obj = array();
    while($looper = mysqli_fetch_assoc($query_QR))
    {
        $obj[] = $looper;
    }*/

    mysqli_close($DBConnect);


}
//$conn->close();


/*$request = "UPDATE FriendRequest SET sender_id ='$sender' WHERE confirmedFriend = 'yes' and user_id ='$sender' and otherUser ='$receiver'";
$yeah=mysqli_query($conn,$request);



$query = "UPDATE FriendRequest SET receiver_id='$receiver' WHERE confirmedFriend = 'yes' and user_id ='$sender' and otherUser ='$receiver'";
$submit=mysqli_query($conn,$query);*/

?>