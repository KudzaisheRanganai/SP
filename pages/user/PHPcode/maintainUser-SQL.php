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

        $user_ID = $_POST["user_ID"];
        $password;
        $username;
        $accessLevelID;
        $salt;
        $saltedPassword;
        $hashedpassword;
        $maintainedChecker;
     
          if(isset($_POST["pass"]))
          {

            $password = $_POST["pass"];
            $salt = rand_string(10);
            $saltedPassword = $password. $salt;
            $hashedpassword = hash("sha256",$saltedPassword);
          }
          if(isset($_POST["email"]))
          {
            $username = $_POST["email"];
          }
          if(isset($_POST["accessLevel"]))
          {
            $accessLevelID = $_POST["accessLevel"];
          }

       

          $checkUser = "SELECT USER.USERNAME, USER.USER_PASSWORD, ACCESS_LEVEL.ROLE_NAME, ACCESS_LEVEL.ACCESS_LEVEL_ID FROM USER INNER JOIN ACCESS_LEVEL ON USER.ACCESS_LEVEL_ID = ACCESS_LEVEL.ACCESS_LEVEL_ID WHERE USER.USER_ID= '$user_ID' ";

           $submit = mysqli_query($DBConnect,$checkUser);
              if($submit)
              {
                if (mysqli_num_rows($submit)>0)
                {
        
                    $vals=mysqli_fetch_assoc($submit);
                    
                    $changes=$vals["USERNAME"];
                    if($hashedpassword!=$vals["USER_PASSWORD"]){
                      $changes=$changes." | Password Changed ";
                    }
                    if($accessLevelID!=$vals["ACCESS_LEVEL_ID"]){
                      $changes=$changes." | ".$vals["ACCESS_LEVEL_ID"];
                    }
                   
                    $last_id=$user_ID;
                    $DateAudit = date('Y-m-d H:i:s');
                    $Functionality_ID='3.2';
                    $userID = $_SESSION['userID'];
                    $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                    $audit_result=mysqli_query($DBConnect,$audit_query);
                  
                
                }
              }  
           

            

            $checkIfUserExists = "SELECT `USER_ID` FROM USER WHERE (`USER_ID`='$user_ID')";
        
            $checkResult=mysqli_query($DBConnect,$checkIfUserExists);
            if($checkResult)
            {
              
                    if(!empty($hashedpassword))
                    {
                        $add_query="UPDATE USER 
                        SET `USER_PASSWORD`='$hashedpassword', `PASSWORD_SALT` = '$salt'
                        WHERE (`USER_ID`='$user_ID')";
                        $add_result=mysqli_query($DBConnect,$add_query);
                        if($add_result)
                        {
                            $maintainedChecker="success";
                        }
                        else
                        {
                          echo  "failure to update password";
                        } 
                    }
                    if(!empty($username))
                    {
                        $add_query="UPDATE USER 
                        SET `USERNAME`='$username'
                        WHERE (`USER_ID`='$user_ID')";
                        $add_result=mysqli_query($DBConnect,$add_query);
                        if($add_result)
                        {
                            $maintainedChecker="success";
                        }
                        else
                        {
                          echo  "failure to update password";
                        } 
                    }
                    if(!empty($accessLevelID)&& isset($accessLevelID))
                    {
                        $add_query="UPDATE USER 
                        SET `ACCESS_LEVEL_ID`='$accessLevelID'
                        WHERE (`USER_ID`='$user_ID')";
                        //var_dump($add_query);
                        $add_result=mysqli_query($DBConnect,$add_query);
                        if($add_result)
                        {
                            $maintainedChecker ="success";
                        }
                        else
                        {
                          echo  "failure to update accessLevel";
                        } 
                    }
                

                    if($maintainedChecker=="success")
                    {
                        echo $maintainedChecker;
                    }
                    else
                    {
                        echo "Nothing is maintained";
                    }
                
                  
                    //echo "Arrived to insert"; 
                

              
              
            }
            else
            {
            
              echo "Database Error";
             
            }
           
       
      
         





      }


      
    
    //Close database connection
    //.
    mysqli_close($DBConnect);
  }
?>