

<?php
    
 include_once("../../sessionCheckPages.php");
    


    //check if all values are set
    if (!isset($_POST["Sub_Functionality_ID"]) && !isset($_POST["changes"]) ) {
    echo "You are missing a Functionality_ID or changes in your post method";  
  
    exit;  
    }

    $Functionality_ID= $_POST["Sub_Functionality_ID"];
    $changes=$_POST["changes"];
    
    

    include_once("DBConnection.php");

    //Check connection
    if (!$DBConnect) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        // receive all input values from the form
        $DateAudit = date('Y-m-d H:i:s');
        $add_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
        $add_result=mysqli_query($DBConnect,$add_query);
        if($add_result)
        {
            echo "success";
        }
        else
        {
            echo "failure";
        }


        //Close database connection
        mysqli_close($DBConnect);
    }


?>
