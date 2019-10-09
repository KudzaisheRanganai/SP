<?php

  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    $sql = "SELECT EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID , EMPLOYEE_TYPE.WAGE_EARNING , EMPLOYEE_TYPE.ACCESS_LEVEL_ID , EMPLOYEE_TYPE.NAME , ACCESS_LEVEL.ROLE_NAME
    FROM EMPLOYEE_TYPE 
    INNER JOIN ACCESS_LEVEL ON EMPLOYEE_TYPE.ACCESS_LEVEL_ID = ACCESS_LEVEL.ACCESS_LEVEL_ID";
    //var_dump($sql);
    $submit = mysqli_query($DBConnect,$sql);
    if($submit)
    {
      if (mysqli_num_rows($submit)>0)
      {
        $count=0;
        while ($row = mysqli_fetch_assoc($submit))
        {
          $vals[]=$row;
          //$vals[$count]["ID"]=$row["SUPPLIER_ID"];
          $count=$count+1;
        }
        echo json_encode($vals);
      }
    }
    else
    {
      echo "False";
    }
    
    //Close the connection
    mysqli_close($DBConnect);
  }
  
?>




