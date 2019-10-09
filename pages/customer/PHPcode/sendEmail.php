<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Send mail - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<body>
<?php
error_reporting(E_ALL);
  ini_set('error_reporting', E_ALL);



// if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
  
    $email_subject = "Registration";
    $email_to = "systematicworks370@gmail.com";
    $email_from="webmaster@stockpath.co.za";
    
//Uncomment when using POST via ajax to send variables for emai
    // $email_subject=$_POST['subject'];
    // $first_name = $_POST['first_name']; // required
    // $last_name = $_POST['last_name']; // required
    // $reply_to= $_POST['email']; // required


    $first_name = "Ditiro"; // required
    $last_name = "Seperpeere"; // required
    $reply_to= "ditiroseperepere@gmail.com"; // required



    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid. Welcome :<br />';
  }

    $email_message = "You have been successfully registered.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";

 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$reply_to."\r\n" .
'X-Mailer: PHP/' . phpversion();
if(mail($email_to, $email_subject, $email_message, $headers)){
echo '<div class="alert alert-success mt-3" role="alert">
                Submitted
        </div>
        <a href="../index.html" class="btn lineup-btn btn-success active" role="button" >Return home</a>';
  
}  
else{
  echo '<div class="alert alert-danger mt-3" role="alert">
                Failed to submit, please try again
        </div>
        <a href="../index.html" class="btn lineup-btn btn-success active" role="button" >Return home</a>';
}
// }
?>

</body>
</html>