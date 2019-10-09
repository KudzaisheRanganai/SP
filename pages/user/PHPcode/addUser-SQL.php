<?php
include_once("../../sessionCheckPages.php");
function rand_string($length)
{
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $size = strlen($chars);
  $str = "";
  for($i=0; $i<$length; $i++)
  {
    $str .= $chars[rand(0,$size-1)];
  }
  return $str;

}




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
      $choice = $_POST["choice"];
      if($choice == 0 )
      {
            $vals = array();

            $get_query = "SELECT * FROM `ACCESS_LEVEL`";
            $get_result = mysqli_query($DBConnect,$get_query);
            if(mysqli_num_rows($get_result)>0)
            {
              while($row=mysqli_fetch_assoc($get_result))
              {
                $vals[]=$row;
              }
              echo json_encode($vals);
            }
            else
            {
              echo "False";
            }
      }
      else if($choice > 0 )
      {
            $password = $_POST["pass"];
            $username = $_POST["email"];
            $accessLevelID = $_POST["accessLevel"];
            $userStatusID = $_POST["userStatusID"];
            $employee_ID = $_POST["employee_ID"];

            $salt = rand_string(10);
            $saltedPassword = $password. $salt;
            $hashedpassword = hash("sha256",$saltedPassword);

            $checkIfUserExists = "SELECT `USER_ID` FROM USER WHERE (`EMPLOYEE_ID`='$employee_ID')";
        
            $checkResult=mysqli_query($DBConnect,$checkIfUserExists);
            if($checkResult)
            {
              $row=mysqli_fetch_assoc($checkResult);
                if(isset($row["USER_ID"]) || isset($row["USERNAME"]))
                {
                  echo "User exists! ";
                }
                else
                {
                   


                    $add_query="INSERT INTO USER (`USERNAME`,`USER_PASSWORD`,`PASSWORD_SALT`,`ACCESS_LEVEL_ID`,`USER_STATUS_ID`,`EMPLOYEE_ID`) VALUES ('$username','$hashedpassword','$salt','$accessLevelID','$userStatusID','$employee_ID')";
                    $add_result=mysqli_query($DBConnect,$add_query);
                    if($add_result)
                    {
                      $last_id = mysqli_insert_id($DBConnect);
                      $DateAudit = date('Y-m-d H:i:s');
                      $Functionality_ID='3.1';
                      $userID = $_SESSION['userID'];
                      $changes="ID : ".$last_id." | Username : ".$username;
                      $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                      $audit_result=mysqli_query($DBConnect,$audit_query);


                      echo "success";
                    }
                    else
                    {
                      echo  "failure to insert";
                    } 
                    //echo "Arrived to insert"; 
                }

              
              
            }
            else
            {
            
              echo "Database Error";
             
            }

       
      






      }


      
    
    //Close database connection
    mysqli_close($DBConnect);
  }
?>