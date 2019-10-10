<?php

  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    
    //Close database connection


    if(isset($_GET["email"]) && (!empty($_GET["email"])))
    {
        $email = $_GET["email"];
        
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      
        /*$email = filter_var($email, FILTER_VALIDATE_EMAIL);
        var_dump($email);*/
        if (!$email) {//removed "!"
           $error .="<p>Invalid email address please type a valid email address!</p>";
           }else{

          

           $query = "SELECT * FROM `USER` WHERE USERNAME =$email";
            //var_dump($query);
           $submit_query = mysqli_query($DBConnect,$query);
         // var_dump($submit_query);
           $findAttr = mysqli_fetch_assoc($submit_query);
            $userId = $findAttr["USER_ID"]; 
           

           $rows = mysqli_num_rows($submit_query);
          $error = "";
           if ($rows==""){
           $error .= "<p>No user is registered with this email address!</p>";
           }
          }
           if($error!=""){
           echo "<div class='error'>".$error."</div>
           <br /><a href='javascript:history.go(-1)'>Go Back</a>";
           }else{


            //Set the timer of password.

           $expFormat = mktime(
           date("H"), date("i")+10, date("s"), date("m") ,date("d"), date("Y")
           );
           $expDate = date("Y-m-d H:i:s",$expFormat);
           $key = md5(425*4+$email); //
           $salt = substr(md5(uniqid(rand(),1)),3,10);
           $key = $key . $salt;
        // Insert Temp Table

        $insertTempPass =  "INSERT INTO `USER_TEMPORARY_PASSWORD` (`EMAIL`, `KEY`, `EXPIRY_DATE`,`USER_ID`)
         VALUES ($email, '$key', '$expDate', '$userId')";
         //var_dump($insertTempPass);
        $confirm=mysqli_query($DBConnect,$insertTempPass);
          // var_dump($confirm);
         
        $output='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p><a href="../reset-user-password.php?
        key='.$key.'&userID='.$userId.'&action=reset" target="_blank">
        ../reset-user-password.php?key='.$key.'&userID='.$userId.'&action=reset</a></p>'; 
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 minute for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action 
        is needed, your password will not be reset. However, you may want to log into 
        your account and change your security password as someone may have guessed it.</p>';   
        $output.='<p>Thanks,</p>';
        $output.='<p>Systematic Team</p>';
        $body = $output; 
        $subject = "Password Recovery - Stockpath.com";

      echo "<div>". $subject . " <br> ".$body. "<br> </div>";
        
        
       ?>

       <?php

   
          }

    }
    else
    {
        ?>
      <?php /* <form method="post" action="" name="reset"><br /><br />
        <label><strong>Enter Your Email Address:</strong></label><br /><br />
        <input type="email" name="email" placeholder="username@email.com" />
        <br /><br />
        <input type="submit" value="Reset Password"/>
        </form>*/
      ?>
    <?php

    }
    mysqli_close($DBConnect);
  }


 ?>