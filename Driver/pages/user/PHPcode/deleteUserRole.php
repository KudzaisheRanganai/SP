<?php

  $userRoleName = "";
  $userRoleSubFunctionalities = Array();

  include_once("DBConnection.php");

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