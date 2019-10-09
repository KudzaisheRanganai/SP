<?php
    session_start();

    include_once("DBConnection.php");

    if($DBConnect === false)
    {
        $response = "Database error";
        echo $response;
    }
    else
    {
        $newLogoutTime = $_POST["minutes"];

        $maxTimeQ = "UPDATE LOGOUT_INACTIVITY SET MAX_TIME = '$newLogoutTime' WHERE TIME_ID = 1";
        $maxTimeQResult = mysqli_query($DBConnect, $maxTimeQ);

        if ($maxTimeQResult == true) 
        {
            $userID=$_SESSION['userID'];
            $DateAudit = date('Y-m-d H:i:s');
            $Functionality_ID='4.101';
            $changes="New Inactivity Logout Time : ".$newLogoutTime. "mins";
            $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
            $audit_result=mysqli_query($DBConnect,$audit_query);

            $response = "success";
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
