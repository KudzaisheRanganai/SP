<?php


$email=$_POST["email"];;



  include_once("DBConnection.php");

  if($DBConnect === false)
  {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    
    //Close database connection

    $subject;
    $body;
    $email;
    $headers;
    if(isset($email) && (!empty($email)))
    {
        $email = $email;
        
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      
        /*$email = filter_var($email, FILTER_VALIDATE_EMAIL);
        var_dump($email);*/
        if (!$email) {//removed "!"
           $error .="<p>Invalid email address please type a valid email address!</p>";
           }else{

          

           $query = "SELECT * FROM `USER` WHERE USERNAME ='$email'";
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
           if($error!="")
           {
           echo "<div class='error'>".$error."</div>
           <br /><a href='javascript:history.go(-1)'>Go Back</a>";
           }
           else
           {


            //Set the timer of password.

                $expFormat = mktime(
                date("H"), date("i")+10, date("s"), date("m") ,date("d")+1, date("Y")
                );
                $expDate = date("Y-m-d H:i:s",$expFormat);
               
                $key = md5(425*4+$userId); 
                $salt = substr(md5(uniqid(rand(),1)),3,10);
                $key = $key . $salt;
              // Insert Temp Table

              $insertTempPass =  "INSERT INTO `USER_TEMPORARY_PASSWORD` (`EMAIL`, `KEY`, `EXPIRY_DATE`,`USER_ID`)
              VALUES ('$email', '$key', '$expDate', '$userId')";
              //var_dump($insertTempPass);
              $confirm=mysqli_query($DBConnect,$insertTempPass);

              if($confirm)
              {


              
                $subject = "Password Recovery - StockPath.com";
                $href1 = 'http://stockpath.co.za/pages/user/reset-user-password.php?key='.$key.'&userID='.$userId.'&action=reset';
                $href = '<a href='.$href1.'>Reset Password Now!</a>';
                

                //echo $body;
                
                
                
                

              }
              else
              {
                echo "Could not insert the temp password";
              }
    
        


   
          }

    }
    else
    {
       
        echo "Email not inputted correctly! , please input email again!";
    }
    mysqli_close($DBConnect);
  }

 ?>
 
 
 
 

<?php

if(isset($href) )
{
    
    $name='User';
   
    $mailjetApiKey = '962a0c6bb1e35b09640053dadd79c38e';
    $mailjetApiSecret = 'd8601378a7597741833fe768d76e03e4';
    $messageData = [
        'Messages' => [
            [
                'From' => [
                    'Email' => 'u17174572@tuks.co.za',
                    'Name' => 'Greens Supermarket'
                ],
                'To' => [
                    [
                        'Email' => $email,
                        'Name' =>  $name
                    ]
                ],
                'Subject' => 'Stockpath Reset Password',
                'TextPart' => 'Mailjet test body email message',
                'HTMLPart' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>
    
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="telephone=no" name="format-detection">
        <title></title>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
    </head>
    
    <body>
        <div class="es-wrapper-color">
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
    
                    <tr>
                        <td class="esd-email-paddings" valign="top">
                    
                            <table class="es-header" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="6339" align="center">
                                            <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p20t es-p10b es-p10r es-p10l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-image es-p25t es-p25b es-p10r es-p10l" align="center"><a href target="_blank"><img src="https://tlr.stripocdn.email/content/guids/CABINET_3df254a10a99df5e44cb27b842c2c69e/images/7331519201751184.png" alt style="display: block;" width="40"></a></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" style="background-color: rgb(255, 255, 255);" esd-custom-block-id="6340" bgcolor="#ffa73b" align="center">
                                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                            <table style="background-color: rgb(255, 255, 255); border-radius: 4px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-image es-infoblock" align="center"><a target="_blank" href="http://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=software2&utm_content=trigger_newsletter"><img src="http://dithulaganyo.co.za/stockpath/assets/img/brand/blue.png" alt width="400"></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p35t es-p5b es-p30r es-p30l" align="center">
                                                                                            <h1>Reset Password</h1>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-spacer es-p5t es-p5b es-p20r es-p20l" bgcolor="#ffffff" align="center">
                                                                                            <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="border-bottom: 1px solid rgb(255, 255, 255); background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center">
                                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                            <table style="border-radius: 4px; border-collapse: separate; background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p20t es-p20b es-p30r es-p30l es-m-txt-l" bgcolor="#ffffff" align="left">
                                                                                            <p>Dear user,</p>
                                                                                            <p>Please click on the  following link to reset your password: '.$href. '</p>
                                                                                           
                                                                                        </td>
                                                                                    </tr>
                                                                              
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p20t es-p30r es-p30l es-m-txt-l" align="left">
                                                                                             <p>Please be sure to click  on the link in order to reset password.</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p20t es-p40b es-p30r es-p30l es-m-txt-l" align="left">
                                                                                            <p>Brought to you  by StockPath</p>
                                                                                            <p>The Greens Supermarket Team</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center">
                                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-spacer es-p10t es-p20b es-p20r es-p20l" align="center">
                                                                                            <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="border-bottom: 1px solid rgb(244, 244, 244); background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="6341" align="center">
                                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                            <table style="background-color: rgb(132, 183, 99); border-radius: 4px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffecd1">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-block-text es-p30t es-p30r es-p30l" align="center">
                                                                                            <h3 style="color:white;">Greens Supermarket</h3>
                                                                                        </td>
                                                                                    </tr>
                                                                       
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    
    </html>'
            ]
        ]
    ]; 
    $jsonData = json_encode($messageData);
    $ch = curl_init('https://api.mailjet.com/v3.1/send');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);
    $response = json_decode(curl_exec($ch));
    echo "success";
    //var_dump($response);
}
else
{
    echo "Email Subject and Body not set";
}

?>