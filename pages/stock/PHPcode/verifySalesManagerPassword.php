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
