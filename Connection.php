<?php 

trait connection{
	//public $pdo = "";

	public $host = 'localhost';
	public $dbName = 'crud';
	public $dbUserName = 'root';
	public $dbpassword = '';

	public function databaseCon(){
		$conn = new PDO("mysql:host=$this->host; dbname=$this->dbName",$this->dbUserName, $this->dbpassword);

		//if($conn){ echo "connected";}
		return $conn;
	}
}

 ?>