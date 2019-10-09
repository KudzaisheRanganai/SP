<?php

  include_once("DBConnection.php");

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