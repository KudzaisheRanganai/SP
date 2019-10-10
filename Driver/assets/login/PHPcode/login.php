<?php

    include_once("DBConnection.php");


    if($DBConnect === false)
    {
        $response = array("error"=> "Database connection error", "sqliErrorCode"=>mysqli_connect_error());
        $responseJSON = json_encode($response);
        echo $responseJSON;
    }
    else
    {
        // receive all input values from the form
        $email = mysqli_real_escape_string($DBConnect, $_POST['email']);
        $password = mysqli_real_escape_string($DBConnect, $_POST['password']);


        if ($email != "" && $password != "")
        { 
            //fetch salt 
            $saltQ = "SELECT * FROM USER WHERE USERNAME='$email'";
            $saltQResult = mysqli_query($DBConnect, $saltQ);
            $saltResult = mysqli_fetch_assoc($saltQResult);

            if ($saltResult != null) 
            {
                $userID = $saltResult['USER_ID'];
                $employeeID = $saltResult['EMPLOYEE_ID'];
                $salt = $saltResult['PASSWORD_SALT'];
                $accessLevelID = $saltResult['ACCESS_LEVEL_ID'];

                $passSalt = $password.$salt;
                $HSPassword = hash('sha256', $passSalt);

                $query = "SELECT * FROM USER WHERE USERNAME='$email' AND USER_PASSWORD='$HSPassword'";
                $results = mysqli_query($DBConnect, $query);

                if (mysqli_num_rows($results) == 1) 
                {
                    //fetch employee name and surname
                    $employeeQ = "SELECT A.*, B.NAME AS EMPLOYEE_TYPE_NAME FROM EMPLOYEE A JOIN EMPLOYEE_TYPE B
                    ON A.EMPLOYEE_TYPE_ID = B.EMPLOYEE_TYPE_ID
                    WHERE EMPLOYEE_ID='$employeeID'";

                    $employeeQResult = mysqli_query($DBConnect, $employeeQ);
                    $employeeResult = mysqli_fetch_assoc($employeeQResult);

                    $name = $employeeResult['NAME'];
                    $surname = $employeeResult['SURNAME'];
                    $employeeType = $employeeResult['EMPLOYEE_TYPE_NAME'];

                    if (strpos($employeeType, 'Driver') !== false) {         
                        //Fetch access level functionalities
                        $userFunctionalityQ = "SELECT * FROM ACCESS_LEVEL_FUNCTIONALITY WHERE ACCESS_LEVEL_ID='$accessLevelID'";
                        $userFunctionalityQResult = mysqli_query($DBConnect, $userFunctionalityQ);

                        $access = array();
                        while( $level = mysqli_fetch_array($userFunctionalityQResult))
                        { 
                            array_push($access, $level['FUNCTIONALITY_ID']);
                        }

                        //Fetch sub functionality level functionalities
                        $userSubFunctionalityQ = "SELECT * FROM ACCESS_LEVEL_SUB_FUNCTIONALITY WHERE ACCESS_LEVEL_ID ='$accessLevelID'";
                        $userSubFunctionalityQResult = mysqli_query($DBConnect, $userSubFunctionalityQ);

                        $subFunctionality = array();
                        while( $functionality = mysqli_fetch_array($userSubFunctionalityQResult))
                        { 
                            array_push($subFunctionality, $functionality['SUB_FUNCTIONALITY_ID']);
                        }
                        
                        //Populate session variable
                        session_start();
                        $_SESSION['name'] = $name;
                        $_SESSION['surname'] = $surname;
                        $_SESSION['userID'] = $userID;
                        $_SESSION['employeeID'] = $employeeID;
                        $_SESSION['accessLevel'] = $access;
                        $_SESSION['subFunctionality'] = $subFunctionality;
                        $_SESSION['access'] = true;

                        echo "success";
                    }
                    else
                    {
                        echo "user is not a driver";
                    }
                }
                else
                {
                    $_SESSION['access'] = false;
                    $response = "password incorrect";
                    echo $response;
                }
            }
            else
            {
                $_SESSION['access'] = false;
                $response = "user does not exist";
                echo $response;
            }
        }
        //Close database connection
        mysqli_close($DBConnect);
    }
?>
