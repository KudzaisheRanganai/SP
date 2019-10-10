<?php
  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    $sql = "SELECT USER.USER_ID, USER.USERNAME, USER.USER_PASSWORD , USER.EMPLOYEE_ID, EMPLOYEE.NAME , EMPLOYEE.SURNAME , ACCESS_LEVEL.ROLE_NAME
    FROM USER
    INNER JOIN EMPLOYEE ON USER.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
    INNER JOIN ACCESS_LEVEL on USER.ACCESS_LEVEL_ID =ACCESS_LEVEL.ACCESS_LEVEL_ID
    WHERE USER.USER_STATUS_ID = '1'";
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




