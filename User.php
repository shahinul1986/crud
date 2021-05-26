<?php 

include 'Connection.php';

class User{
	use connection;
	public $conn = "";
	public function __construct()
	{
		$this ->conn = $this->databaseCon();
	}

	public function loginCheck($userName, $password)
	{
		$password = md5($password);
		$sql = "SELECT * FROM users WHERE user_name='$userName' AND password = '$password'";

		$statement = $this->conn->prepare($sql);
		$statement ->execute();
		$res =$statement->fetchAll();
		if(count($res) == 1){
			session_start();
			foreach($res as $value){
				$_SESSION['user_name'] = $value['user_name'];
				$_SESSION['id'] = $value['id'];
			}
			header("location:dashboard.php");
		}else{
			return 'Login failed';
		}
	}

	//CREATE NEW EXPENSES
	public function newExpense($user_id,$name)
	{
	$sql = "INSERT INTO expenses (user_id,name) VALUES(:user_id,:name)";

	$statement = $this->conn->prepare($sql);
	$statement->execute(array(
		':user_id' => $user_id,
		':name' => $name
	));

	return true;

	}


	// GET USER EXPENSE
	public function getExpenses()
	{
		$userId= $_SESSION['id'];

		$sql = "SELECT * FROM expenses WHERE user_id=:user_id";
		$params_array = array(
			':user_id'=> $userId
		);

		$data = $this->retrieve($sql,$params_array);

		return $data;
	}

	//MAKE AN EXPENSE DETAILS
	public function saveExpenseDetails($data_array)
	{
		$sql = "INSERT INTO expense_details (expense_id ,name,details,image,amount) VALUES (:expense_id , :name,:details,:image,:amount)";

		
		$this->saveData($sql,$data_array);
	}

	//GET ALL EXPENSE DETAILS
	public function getAllexpenseDetails($ex_id)
	{
		$sql = "SELECT * from expense_details WHERE expense_id=:expense_id";

		$params_array = array(
			':expense_id' => $ex_id
		);
		$data = $this->retrieve($sql, $params_array);
		return $data;
	}

	//GET SPECIFIC EX DETAILS DATA
	public function getSpecificExpenseDetails($id)
	{
		$sql = "SELECT * FROM expense_details WHERE id=:id";
		$params_array= array(
			':id' => $id
		);
		$data = $this->retrieve($sql,$params_array);
		return $data;
	}

	//UPDATE EXPENSE DETAILS
	public function updateExpenseDetails($data_array)
	{
		$sql = "UPDATE expense_details SET name=:name,details=:details,image=:image,amount=:amount WHERE id =:exd_id";
		$this->saveData($sql, $data_array);

		return true;
	}

	//DELETE SPECIFIC EXPENSE
	public function deleteSpecificExpenseDetails($id)
	{
		$sql = "DELETE FROM expense_details WHERE id=:exd_id";
		$params_array = array(
			':exd_id' =>$id
		);
		$this->saveData($sql, $params_array);

		return true;
	}

	//RETRIEDE DATA METHOD
	public function retrieve($sql,$array_vars)
	{
		$statement= $this->conn->prepare($sql);
		$statement->execute($array_vars);
		$result = $statement->fetchAll();

		return $result;	
	}

	//SAVE DATA METHOD
	public function saveData($sql,$array_vars){

		$statement = $this->conn->prepare($sql);
		$statement->execute($array_vars);

		return true;
	
	}

}

 ?>