<?php

    include_once("DBConnection.php");

    if($DBConnect === false)
    {
        $response = "Database error";
        echo $response;
    }
    else
    {
        // receive all input values from the form
        $password = mysqli_real_escape_string($DBConnect, $_POST['password']);


        if ($password != "")
        { 
            //fetch salt 
            $saltQ = "SELECT * FROM USER WHERE USERNAME='SALESMANAGERPASSWORD'";
            $saltQResult = mysqli_query($DBConnect, $saltQ);
            $saltResult = mysqli_fetch_assoc($saltQResult);

            $salt = $saltResult['PASSWORD_SALT'];

            $passSalt = $password.$salt;
            $HSPassword = hash('sha256', $passSalt);

            $query = "SELECT * FROM USER WHERE USERNAME='SALESMANAGERPASSWORD' AND USER_PASSWORD='$HSPassword'";
            $results = mysqli_query($DBConnect, $query);

            if (mysqli_num_rows($results) == 1) 
            {
                $response = "success";
                echo $response;
            }
            else
            {
                $response = "failed";
                echo $response;
            }
        }
        else
        {
        	$response = "Password empty";
            echo $response;
        }
        //Close database connection
        mysqli_close($DBConnect);
    }
?>
