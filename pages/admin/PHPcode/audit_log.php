

<?php
    
 include_once("../../sessionCheckPages.php");
    


    //check if all values are set
    if (!isset($_POST["Sub_Functionality_ID"]) && !isset($_POST["changes"]) ) {
    echo "You are missing a Functionality_ID or changes in your post method";  
  
    exit;  
    }

    $Functionality_ID= $_POST["Sub_Functionality_ID"];
    $changes=$_POST["changes"];
    
    

    //db connection
    $url = 'mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';
    
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $con = mysqli_connect($hostname, $username, $password, $database);

    //Check connection
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        // receive all input values from the form
        $DateAudit = date('Y-m-d H:i:s');
        $add_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
        $add_result=mysqli_query($con,$add_query);
        if($add_result)
        {
            echo "success";
        }
        else
        {
            echo "failure";
        }


        //Close database connection
        mysqli_close($con);
    }


?>
