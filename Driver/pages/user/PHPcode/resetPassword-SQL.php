<?php
  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
   
    $key = $_POST["key"];
    $userId = $_POST["userID"];
    $action = $_POST["action"];

      if (isset($key) && isset($userId) && isset($action) 
      && ($action=="reset")){
         
        
       // var_dump($userId);
        $currentDate = date("Y-m-d H:i:s");

        $queryCheck =  "SELECT * FROM `USER_TEMPORARY_PASSWORD` WHERE `KEY`='$key' and `USER_ID`='$userId'";
        $submitquery = mysqli_query($DBConnect,$queryCheck);
        //var_dump($submitquery);
        $row = mysqli_num_rows($submitquery);
        $error = "";
        if ($row==""){
        $error .= '<h2>Invalid Link</h2>
      <p>The link is invalid/expired. Either you did not copy the correct link
      from the email, or you have already used the key in which case it is 
      deactivated.</p>
      <p><a href="https://www.allphptricks.com/forgot-password/index.php">
      Click here</a> to reset password.</p>';
      }else{
        $rowArr = mysqli_fetch_assoc($submitquery);
        $expiryDate = $rowArr['EXPIRY_DATE'];
        //var_dump($expiryDate);
        if ($expiryDate >= $currentDate)
        {

        }
        else
        {
          $error = "";
          $error .= "<h2>Link Expired</h2>
          <p>The link is expired. You are trying to use the expired link which 
          as valid only 24 hours (1 days after request).<br /><br /></p>";
                      }
                }
          if($error!="")
            {
            echo "<div class='error'>".$error."</div><br />";
            } 
          } // isset email key validate end
           
          
           
          //if(isset($_POST["resetPassword"]) &&
           //($_POST["resetPassword"]=="resetPassword"))
          // {
            //echo "renew pass";
              $error="";
              $pass1 = mysqli_real_escape_string($DBConnect,$_POST["newpass"]);
              $pass2 = mysqli_real_escape_string($DBConnect,$_POST["confirmpass"]);
              //$email = $_POST["email"];
             // $currentDate = date("Y-m-d H:i:s");
            
              if ($pass1!=$pass2){
              $error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
                }
                if($error!=""){
              echo "<div class='error'>".$error."</div><br />";
              }else{
                //var_dump($pass1);

                $saltedQuery =  "SELECT * FROM `USER` WHERE  `USER_ID`='$userId'";
               
                $submitSalt = mysqli_query($DBConnect,$saltedQuery);
                //var_dump($submitSalt);
                $rowArray = mysqli_fetch_assoc($submitSalt);

                

                $oldSalt = $rowArray["PASSWORD_SALT"];
                //var_dump($oldSalt);
              $newPassword1 = $pass1 .  $oldSalt;
              $hashedPassword = hash("sha256",$newPassword1);
              $updatePass = "UPDATE `USER` SET `USER_PASSWORD`='$hashedPassword'
              WHERE `USER_ID`='$userId'";
              $newCheckedPass=mysqli_query($DBConnect,$updatePass);
              
              $delPass = "DELETE FROM `USER_TEMPORARY_PASSWORD` WHERE `USER_ID`='$userId'";
              $redirect =mysqli_query($DBConnect,$delPass);
              //var_dump($redirect);
              if($submitSalt==true && $newCheckedPass==true && $redirect==true)
              {
                echo "successful reset password";
              }
               
             
            // } 
          } 
        //}
  mysqli_close($DBConnect);
}
?>