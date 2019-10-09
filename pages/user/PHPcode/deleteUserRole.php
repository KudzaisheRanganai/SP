<?php

  $userRoleName = "";
  $userRoleSubFunctionalities = Array();

  $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');

  $DBConnect = mysqli_connect($hostname, $username, $password, $database);

  if($DBConnect === false)
  {
    //Send error response
      $response = "database Error";
      echo $response;
  }
  else
  {
        $exists = false;

        // Retrieve product details from $_POST
        $AccessLevelID = $_POST['userRoleID'];
    
        //DELETE USER ACCCESS LEVEL SUBFUNCTIONALITIES and ACCESS LEVEL

        $deleteAccessLevel = "DELETE FROM ACCESS_LEVEL WHERE ACCESS_LEVEL_ID = '$AccessLevelID'";
        //var_dump($deleteAccessLevel);
        $submit=mysqli_query( $DBConnect, $deleteAccessLevel);

        $subFlag = false;
        $finFlag = false;
        $resFlag = false;


        if($submit)
        {
            $subFlag = true; 

            $deleteSubFunctionality = "DELETE FROM ACCESS_LEVEL_FUNCTIONALITY WHERE ACCESS_LEVEL_ID = '$AccessLevelID'";
            $final=mysqli_query( $DBConnect, $deleteSubFunctionality);
    
    
            if($final)
            {
                    $finFlag = true; 

                    $deleteFunctionality = "DELETE FROM ACCESS_LEVEL_SUB_FUNCTIONALITY WHERE ACCESS_LEVEL_ID = '$AccessLevelID'";
                    $result = mysqli_query( $DBConnect, $deleteFunctionality);
                
                    if($result)
                    {
                        $resFlag = true; 
                    }
                    else
                    {
                        echo "Could not delete Access Level ID from ACCESS_LEVEL_SUB_FUNCTIONALITY";
                    }

            }
            else
            {
                echo "Could not delete Access Level ID from ACCESS_LEVEL_FUNCTIONALITY";
            }
        }
        else
        {
            echo "Could not delete User Role in Use";
        }

    

    

        
        if (($resFlag==true) && ($finFlag==true) && ($subFlag==true)) 
        {
            $response = "success";
            echo $response;
        }


    
        //Close database connection
      mysqli_close($DBConnect);

      //Send success response
}
   
?>