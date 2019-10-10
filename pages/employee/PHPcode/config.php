<?php 

  public $hostname = 'localhost';
  public $username = 'stockofc_sp';
  public $password = '@System111';
  public $database = 'stockofc_stockpath';
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