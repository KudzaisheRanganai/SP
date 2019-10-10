<?php

    include_once("DBConnection.php");

    if($DBConnect === false)
    {
        $response = "Database error";
        echo $response;
    }
    else
    {
        $maxTimeQ = "SELECT MAX_TIME FROM LOGOUT_INACTIVITY WHERE TIME_ID = 1";
        $maxTimeQResult = mysqli_query($DBConnect, $maxTimeQ);
        $timeResult = mysqli_fetch_assoc($maxTimeQResult);

        $maxTime = $timeResult['MAX_TIME'];

        if (mysqli_num_rows($maxTimeQResult) == 1) 
        {
            $response = $maxTime;
            echo $response;
        }
        else
        {
            $response = "failed";
            echo $response;
        }

        //Close database connection
        mysqli_close($DBConnect);
    }
?>
