<?php 
public $url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

 public $dbparts = parse_url($url);

  public $hostname = $dbparts['host'];
  public $username = $dbparts['user'];
  public $password = $dbparts['pass'];
  public $database = ltrim($dbparts['path'],'/');
  public $DBConnect;
  

  


class DBconnection
{
  public $server = "localhost";
  public $user = "root";
  public $pass = "";
  public $dbname = "howtoqr";
	public $conn;
  public function __construct()
  {
	  //$this->conn= new mysqli($this->server,$this->user,$this->pass,$this->dbname);
	  
	  $this->$DBConnect = mysqli_connect($this->$hostname, $this->$username, $this->$password, $this->$database);

	  if($this->$DBConnect === false)
	  {
		die("ERROR: Could not connect. " . mysqli_connect_error());
	  }
	  else
	  {
		
		//Close database connection
		mysqli_close($this->$DBConnect);
	  }

  /*	if($this->conn->connect_error)
  	{
  		die("connection failed");
  	}*/
  }
 	
}
$connect = new DBconnection();