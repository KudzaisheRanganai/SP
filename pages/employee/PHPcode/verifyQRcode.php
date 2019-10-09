<?php 
include_once("../../sessionCheckPages.php");

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
    echo ("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{

    
    $employeeID = $_POST["qrCode"];

    $nameQuery = "SELECT A.NAME, A.SURNAME, B.WAGE_EARNING FROM EMPLOYEE A JOIN EMPLOYEE_TYPE B ON A.EMPLOYEE_TYPE_ID = B.EMPLOYEE_TYPE_ID WHERE EMPLOYEE_ID = '$employeeID'";

    $employeNameQueryResult = mysqli_query($DBConnect,$nameQuery);
    $employee= mysqli_fetch_assoc($employeNameQueryResult);
    $nameSurname = $employee["NAME"]." ".$employee["SURNAME"];

    if($employee["WAGE_EARNING"] == 1)
    {
        $day = date("Y-m-d");

        $firstQuery = "SELECT * FROM EMPLOYEE_HOUR
        WHERE  `DATE` = '$day' and `EMPLOYEE_ID`= '$employeeID'";

        $submitCheckQuery = mysqli_query($DBConnect,$firstQuery);

        if($submitCheckQuery)
        {

            $row= mysqli_fetch_assoc($submitCheckQuery);
            if(mysqli_num_rows($submitCheckQuery))
            {
                echo "Already Checked-in!,".$employeeID.",".$nameSurname;
            }
            else
            {
                $nameQuery = "SELECT NAME, SURNAME FROM EMPLOYEE
                WHERE EMPLOYEE_ID = '$employeeID'";

                $employeNameQueryResult = mysqli_query($DBConnect,$nameQuery);
                $employee= mysqli_fetch_assoc($employeNameQueryResult);

                $nameSurname = $employee["NAME"]." ".$employee["SURNAME"];

                $timeCheckedIn;

                $realCheckin;
                $realCheckout;
                $get_query="SELECT * FROM CHECKIN_CHECKOUT_TIME
                WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";
                $get_result=mysqli_query($DBConnect,$get_query);
            
                if(mysqli_num_rows($get_result)>0)
                {
                    if($row= mysqli_fetch_assoc($get_result))
                    {
                        $realCheckin = $row["ARRIVAL_TIME"];
                        $realCheckout = $row["DEPATURE_TIME"];

           
                        $sql = "SELECT HASH FROM EMPLOYEE_QR WHERE (EMPLOYEE_ID='$employeeID')";
                        $query_QR = mysqli_query($DBConnect , $sql);
                    
                        $time = new DateTime();
                        $currentTime = $time->format("H:i:s");//checkin/checkout time.
                         
                        $addedTime = "";//flag
                    
                        //date("H:i:s");
                        $time = new DateTime();
                        $currentTime = $time->format("Y-m-d H:i:s");//checkin/checkout time.
                        
                        
                        $addedTime = "";//flag
                    
                        //date("H:i:s");
                        
                        $setCheckinTime = new DateTime($realCheckin);
                        $setCheckinTime = $setCheckinTime->format("Y-m-d H:i:s");
                        
                        $checkoutTime = new DateTime($realCheckout);
                        $checkoutTime = $checkoutTime->format("Y-m-d H:i:s");
                    
                        if($query_QR)
                        {
                            if($currentTime <= $setCheckinTime)
                            {
                                $currentTime = $setCheckinTime;
                                $timeCheckedIn = $setCheckinTime;
                                
                                
                                $query = "INSERT INTO `EMPLOYEE_HOUR`(`DATE`, `CHECK_IN_TIME`, `CHECK_OUT_TIME`, `EMPLOYEE_ID`) VALUES ('$day','$currentTime','NULL','$employeeID')";
                            
                                $submitQuery = mysqli_query($DBConnect,$query);
                                
                                if($submitQuery)
                                {
                                    $addedTime = "Time SQL works";
                                }
                    
                            }
                            else if($currentTime >= $setCheckinTime && $currentTime <= $checkoutTime)
                            {
                                $timeCheckedIn = $currentTime;
                                $query = "INSERT INTO `EMPLOYEE_HOUR`(`DATE`, `CHECK_IN_TIME`, `CHECK_OUT_TIME`, `EMPLOYEE_ID`) VALUES ('$day','$currentTime','NULL','$employeeID')";
                                $submitQuery = mysqli_query($DBConnect,$query);
                                if($submitQuery)
                                {
                                    $addedTime = "Time SQL works";
                                }
                            }
                            else
                            {
                                echo "Over checkin time,".$employeeID.",".$nameSurname;;
                            }
                        }
                        else
                        {
                            echo "Employee does not exist on system,".$employeeID.",".$nameSurname;
                        }

                        $verifyID = sha1($employeeID);
                        //var_dump($verifyID);

                        //Audit Log Check-In Changes
                        $changes="ID : ".$employeeID."| Employee Checked-In | Employee Check-In Date and Time :".$currentTime;


                        while($correctHash = mysqli_fetch_assoc($query_QR))
                        {
                            if($correctHash["HASH"] == $verifyID && $addedTime == "Time SQL works" )
                            {

                                $DateAudit = date('Y-m-d H:i:s');
                                $Functionality_ID='2.4';
                                $userID = $_SESSION['userID'];
                                $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                                $audit_result=mysqli_query($DBConnect,$audit_query);


                                $response = "success".",".$employeeID.",".$nameSurname.",".$timeCheckedIn;
                                echo $response;
                                break;
                            }
                        }
                    }
                    else
                    {
                        echo "No checkin/checkout times,".$employeeID.",".$nameSurname;;
                    }
                }
                else
                {
                    echo "No checkin/checkout times,".$employeeID.",".$nameSurname;;
                }
            }
        }
        else
        {
            echo "Error";
        }
    }
    else
    {
        echo "not wage earning,".$employeeID.",".$nameSurname;;
    }

    mysqli_close($DBConnect);
}

?>