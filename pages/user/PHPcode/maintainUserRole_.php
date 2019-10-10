<?php

include_once("../../sessionCheckPages.php");
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
    $userRoleName = mysqli_real_escape_string($DBConnect, $_POST['userRoleName_']);
    $oldUserRoleName = mysqli_real_escape_string($DBConnect, $_POST['oldRoleName']);
    $userRoleSubFunctionalities  = $_POST['subFunctionalities_'];
    $userRoleFunctionalities = Array();

    $arraySize = sizeof($userRoleSubFunctionalities);
    for ($i=0; $i < $arraySize; $i++) 
    { 
      $numberSplit = explode('.', $userRoleSubFunctionalities[$i]);
      $number = $numberSplit[0];
      if(!in_array($number, $userRoleFunctionalities, true))
      {
        array_push($userRoleFunctionalities, $number);
      }
    }
    //DELETE USER ACCCESS LEVEL SUBFUNCTIONALITIES
    $deleteSubFunctionality = "DELETE FROM ACCESS_LEVEL_FUNCTIONALITY WHERE ACCESS_LEVEL_ID = $AccessLevelID";
    mysqli_query( $DBConnect, $deleteSubFunctionality);

    $deleteFunctionality = "DELETE FROM ACCESS_LEVEL_SUB_FUNCTIONALITY WHERE ACCESS_LEVEL_ID = $AccessLevelID";
    mysqli_query( $DBConnect, $deleteFunctionality);

    $query = "SELECT * FROM ACCESS_LEVEL WHERE ROLE_NAME = '$userRoleName'";
    $result = mysqli_query( $DBConnect, $query);
    
    if (mysqli_num_rows($result) && ($userRoleName != $oldUserRoleName)) 
    {
        $exists = true;
    }

    if($exists == false)
    { 
      if ($userRoleName != $oldUserRoleName) 
      {
        $updateRoleName = "UPDATE ACCESS_LEVEL SET ROLE_NAME = $userRoleName WHERE ACCESS_LEVEL_ID = $AccessLevelID";
        mysqli_query( $DBConnect, $updateRoleName);
      }

      $arraySize = sizeof($userRoleFunctionalities);
      for ($i=0; $i < $arraySize; $i++) 
      { 
        $queryFunctionality = "INSERT INTO ACCESS_LEVEL_FUNCTIONALITY(ACCESS_LEVEL_ID, FUNCTIONALITY_ID) VALUES( '$AccessLevelID','$userRoleFunctionalities[$i];')";
        mysqli_query($DBConnect, $queryFunctionality);
      }

      $arraySize = sizeof($userRoleSubFunctionalities);
      for ($i=0; $i < $arraySize; $i++) 
      { 
        $querysubFunctionality = "INSERT INTO ACCESS_LEVEL_SUB_FUNCTIONALITY(ACCESS_LEVEL_ID, SUB_FUNCTIONALITY_ID) VALUES( '$AccessLevelID', '$userRoleSubFunctionalities[$i]')";
        mysqli_query($DBConnect, $querysubFunctionality);
      }

       

      //Send success response
      $changes="Changes Made To User Role ID: ". $AccessLevelID;
      $changes=$changes." | User Role(s) Maintained";
    
    
     $DateAudit = date('Y-m-d H:i:s');
     $Functionality_ID='3.9';
     $userID = $_SESSION['userID'];
     $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
     $audit_result=mysqli_query($DBConnect,$audit_query);

      $response = "success";
      echo $response;
       //Close database connection
       mysqli_close($DBConnect);
    }
    else
    {
      mysqli_close($DBConnect);
      $response = "User role exists";
      echo $response;
    }
  }
?>