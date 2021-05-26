<?php 

include 'Database.php';
$db = new Database();

// WHEN USER PRESS REGISTER
if(isset($_POST['submit'])){
	$user_name  = $_POST['user_name'];
	$password = $_POST['password'];
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];

	$exisUserCount = $db-> checkUserName($user_name);
	if($exisUserCount > 0){
		echo " User Name Already Exists";
	}else{
		$res = $db->register($user_name,$email,$full_name,$password);
		if($res =='success'){
			echo "Register Success!!";
		}else{
			echo "something wrong!!";
		}

	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class ="container">
		<div class ="row mt-5">
			<div class = "card col-6 offset-lg-3">
				<form class="form-group" method="POST" action="">
					<h2>Register</h2>
					<input class="form-control" placeholder="User Name" type="text" name="user_name" required><br>
					<input class="form-control" placeholder="Full Name" type="text" name="full_name" required><br>
					<input class="form-control" placeholder="Email" type="email" name="email" required=><br>
					<input class="form-control" placeholder="Password" type="password" name="password" required=""><br>
					<input class="btn btn-success" type="submit" name="submit" value="Register">
					<p>Already Register??Login <a href="login.php">Here</a></p>
				</form>
			</div>
		</div>
	</div>

</body>
</html>