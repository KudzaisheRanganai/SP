<?php
$password = "temp Password";  //$r['password'] ;
$to = $_POST['email'];
$subject = "Your Recovered Password";
 $sendthat = 1;
$message = "Please use this password to login " . $password;
$headers = "From : vivek@codingcyber.com";

if(mail($to, $subject, $message, $headers) || isset($to)){
	echo "success";
}else{
	echo "Failed to Recover your password, try again";
}

?>