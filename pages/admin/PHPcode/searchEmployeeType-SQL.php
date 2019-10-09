<?php
$url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');

  $DBConnect = mysqli_connect($hostname, $username, $password, $database);

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




