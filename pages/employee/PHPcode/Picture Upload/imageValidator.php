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

    $dir= "../../images/ProfilePic/";
     $fileTo= $_FILES["picToUpload"];
     $counter = count($fileTo["name"]);
     $employeeID = $_POST["employeeID"];
     $f_file;
     $imageFileType;
     //$email = $_POST['email'];
     //$pass = $_POST['pass'];
   if(($fileTo["type"] == "image/jpeg")&& ($fileTo["size"] < 125000))
   {
         if($fileTo["error"] > 0)
         {
             echo "Error: " . $fileTo["error"] . "<br/>";
         }
     else
     {
        /* echo "Upload: " . $fileTo["name"][$k] . "<br/>";
         echo "Type: " . $fileTo["type"][$k] . "<br/>";
         echo "Size: " . ($fileTo["size"][$k] / 1024) . "Kb<br/>";
         echo "Temp file: " . $fileTo["tmp_name"][$k]  . "<br/>";*/
         $faker = true;
             if(file_exists($dir . $fileTo["name"]))
             {
                // echo $fileTo["name"][$k] . " already exists.";
             } 
             else
             {
                 
                 
                //$filer = $fileTo["name"][$k];
                
                 $temp = explode(".", $fileTo["name"]);
                // var_dump(end($temp));
                 $newfilename = $employeeID . '.' . end($temp);
                // var_dump($newfilename);
                 //var_dump($fileTo["tmp_name"]);
                 move_uploaded_file($fileTo["tmp_name"], $dir . $newfilename);
                //$_SESSION["picSet"]= "sett";


               // header('location:profile.php');
                     //move_uploaded_file($fileTo["tmp_name"],
                     //$dir . $fileTo["name"][$k]);

                     
                   
                        
                         $query = "INSERT INTO EMPLOYEE_PICTURE (FILENAME, EMPLOYEE_ID) VALUES ('$newfilename', '$employeeID');"; // insert the user_id for specific pictures
                         $res = mysqli_query($DBConnect, $query);
                         if($res)
                         {
                             echo "successfully saved picture";
                         }
                     

                
                }
             

     }


   }
   else
   {
       echo  '<div class="alert alert-danger mt-3" role="alert">
       There was an error within the picture upload<br/>
   </div>';
       
   }
 
//Close database connection
mysqli_close($DBConnect);
 }
    
    
  
   

?>
