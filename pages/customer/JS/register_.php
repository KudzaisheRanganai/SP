<?php


$url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$con = mysqli_connect($hostname, $username, $password, $database);

//Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$email = ($_POST['email']);
$name = ($_POST['name']);
$vat = ($_POST['vat']);
$number = ($_POST['number']);
$adrress1= ($_POST['adrress1']);
$adrress2= ($_POST['adrress2']);
$suburb = ($_POST['suburb']);
$city = ($_POST['city']);
$zip = ($_POST['zip']);


// $email = "y@gmail.comm";
// $name = "name";
// $vat = "151815";
// $number = "0115151515";

if ($email !="" && $name!=""){


      
    $sql_query ="INSERT INTO CUSTOMER (name,email,vat,contact_number) VALUES ( '$name ', '$email', '$vat', '$number')";
    $result = mysqli_query($con,$sql_query);
   

    if ($result) {
        echo "success";
        
    }
    else{
         echo "failed";
    }
}

mysqli_close($con); 
  
?>
