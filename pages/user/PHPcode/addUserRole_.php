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
    $userRoleName = mysqli_real_escape_string($DBConnect, $_POST['userRoleName_']);
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

    $query = "SELECT * FROM ACCESS_LEVEL WHERE ROLE_NAME = '$userRoleName'";
    $result = mysqli_query( $DBConnect, $query);
    if (mysqli_num_rows($result)) 
    {
        $exists = true;
    }

    if($exists == false)
    { 
      //Add product to database
      $queryRole = "INSERT INTO ACCESS_LEVEL(ROLE_NAME) VALUES( '$userRoleName')";
      mysqli_query($DBConnect, $queryRole);

      $lastIDQuery = "SELECT LAST_INSERT_ID();";        
      $lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
      $lastID = mysqli_fetch_array($lastIDQueryResult)[0];

      $last_id=$lastID;
      $DateAudit = date('Y-m-d H:i:s');
      $Functionality_ID='3.7';
      $userID = $_SESSION['userID'];
      $changes="ID : ".$last_id." | User role name : ".$userRoleName;
      $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
      $audit_result=mysqli_query($DBConnect,$audit_query);

      $arraySize = sizeof($userRoleFunctionalities);
      for ($i=0; $i < $arraySize; $i++) 
      { 
        $queryFunctionality = "INSERT INTO ACCESS_LEVEL_FUNCTIONALITY(ACCESS_LEVEL_ID, FUNCTIONALITY_ID) VALUES( '$lastID','$userRoleFunctionalities[$i];')";
        mysqli_query($DBConnect, $queryFunctionality);
      }

      $arraySize = sizeof($userRoleSubFunctionalities);
      for ($i=0; $i < $arraySize; $i++) 
      { 
        $querysubFunctionality = "INSERT INTO ACCESS_LEVEL_SUB_FUNCTIONALITY(ACCESS_LEVEL_ID, SUB_FUNCTIONALITY_ID) VALUES( '$lastID', '$userRoleSubFunctionalities[$i]')";
        mysqli_query($DBConnect, $querysubFunctionality);
      }

        //Close database connection
      mysqli_close($DBConnect);

      //Send success response
      $response = "success";
      echo $response;
    }
    else
    {
      mysqli_close($DBConnect);
      $response = "User role exists";
      echo $response;
    }
  }
?>