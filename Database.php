<?php 

include 'Connection.php';

class Database{

	use connection;

	public $conn ="";

	public function __construct()
	{
		$this->conn = $this->databaseCon();
		//$con = $this->databaseCon();
	}
	//REGISTER AN USER
	public function register($userName, $email, $fullName, $password)
	{
		$sql = "INSERT INTO users(user_name,password,email,full_name) VALUES (:user_name,:password,:email,:full_name)";
		$statement = $this->conn->prepare($sql);
		$statement ->execute(array(
			':user_name' => $userName,
			':password' => md5($password),
			':email' => $email,
			':full_name' => $fullName
		));
		return 'success';
	}
	//CHECK USER NAME EXIST
	public function checkUserName($userName){
		$sql = "SELECT user_name FROM users WHERE user_name = '$userName'";
		$statement = $this->conn->prepare($sql);
		$statement ->execute();
		$res = $statement ->fetchAll();
		return count($res);
	}
	
}

 ?>