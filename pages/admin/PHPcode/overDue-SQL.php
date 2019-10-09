<?php

  $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');

  $DBConnect = mysqli_connect($hostname, $username, $password, $database);

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    

    $overDays = $_POST["overdueTime"];
    $user_ID =  $_POST["user_ID"];
    //$day = date("Y-m-d");

    
    if(isset($overDays) && isset($user_ID))
    {
        $sql ="UPDATE `OVERDUE_DELIVERY_DATE`
        SET `OVERDUE_DATE`= '$overDays', `USER_ID` = '$user_ID'
        WHERE OVERDUE_DELIVERY_DATE_ID = '0'";
        $submitQuery = mysqli_query($DBConnect,$sql);

        if($submitQuery)
        {
           
            echo "success";
           
        }
        else
        {
            echo "Could not change overdue delivery status";
        }
    }
    else
    {
        echo "User ID is not set OR Days the delivery is overdue by is not set";
    }
    //Close database connection
    mysqli_close($DBConnect);
  }
?>