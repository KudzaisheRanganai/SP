<?php
  include_once("../../sessionCheckPages.php");
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

          $userID; 
          $checkInTime = 0; 
          $checkOutTime = 0;

          $employee_ID = "";

         

         

          if(isset($_POST["userID"]))
          {
            $userID = $_POST["userID"]; 
          }
          if(isset($_POST["checkin"]))
          {
            $checkInTime = $_POST["checkin"];
          }
          if(isset($_POST["checkout"]))
          {
            $checkOutTime = $_POST["checkout"];
          }
          
          $checkintimeSet = "";
          $checkouttimeSet = "";
          $successIn = "";
          $successOut = "";



          $getIDQuery = "SELECT * FROM USER WHERE USER_ID='$userID'";
          $subIDQuery = mysqli_query($DBConnect , $getIDQuery);

          if(mysqli_num_rows($subIDQuery)>0)
          {
              if($rowID= mysqli_fetch_assoc($subIDQuery))
              {
                $employee_ID = $rowID["EMPLOYEE_ID"];
              }
          }

          $changes="";
          $changes="ID :".$employee_ID;
          $changes=$changes." | Checkin Checkout Time Changed";

          if($checkOutTime != 0)
          {
              $sql = "UPDATE CHECKIN_CHECKOUT_TIME 
              SET `DEPATURE_TIME` = '$checkOutTime', `USER_ID` = '$userID'
              WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";
              $query_QR = mysqli_query($DBConnect , $sql);
              
              
              if($query_QR)
              {
                $successOut = "success";
                $checkouttimeSet = "Checkout Time has been successfully changed";
              }
              else
              {
                  echo "Failure";
              }
          }
          if($checkInTime != 0)
          {
              $sql = "UPDATE CHECKIN_CHECKOUT_TIME 
              SET `ARRIVAL_TIME` = '$checkInTime', `USER_ID` = '$userID'
              WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";
              $query_QR = mysqli_query($DBConnect , $sql);
              
            
              if($query_QR)
              {
                $successIn = "success";
                $checkintimeSet = "Check-in Time has been successfully changed";
              }
              else
              {
                  echo "Failure";
              }
          }




          if(($successOut=="success") && ($successIn !="success"))
          {
            $changes=$changes." | Checkout Time :".$checkOutTime;

            $DateAudit = date('Y-m-d H:i:s');
            $Functionality_ID='2.9';
            $userID = $_SESSION['userID'];
            $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
            $audit_result=mysqli_query($DBConnect,$audit_query);  


            echo $checkouttimeSet;
          } 
          else if(($successOut !="success") && ($successIn =="success"))
          {
            $changes=$changes." | CheckIn Time :".$checkInTime;

            $DateAudit = date('Y-m-d H:i:s');
            $Functionality_ID='2.9';
            $userID = $_SESSION['userID'];
            $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
            $audit_result=mysqli_query($DBConnect,$audit_query);  

            echo $checkintimeSet;
          }   
          else if(($successOut=="success") && ($successIn =="success"))
          {
            $changes=$changes." | CheckIn Time :".$checkInTime." | Checkout Time :".$checkOutTime;

            $DateAudit = date('Y-m-d H:i:s');
            $Functionality_ID='2.9';
            $userID = $_SESSION['userID'];
            $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
            $audit_result=mysqli_query($DBConnect,$audit_query);  

            echo $checkouttimeSet . " and " . $checkintimeSet;
          }
          else
          {
            echo "Nothing was changed!";
          }
 
     mysqli_close($DBConnect); 
    //Close database connection
   
  }
?>