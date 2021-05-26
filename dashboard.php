<?php 

include 'User.php';
include 'checkuserLogin.php';
$user = new User();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<h3>Dashboard(<?php echo $_SESSION['user_name']; ?>)-<a href="logout.php">Logout</a></h3>

	<div class="container">
		<div class="row mt-5">
			<div class="card col-6 offset-lg-3">
				<?php
				//USER HIT LOGIN BUTTON
				if(isset($_POST['submit'])){
				$name = $_POST['name']; 
				$res=$user-> newExpense($_SESSION['id'], $name);
				if($res){echo "Added.. ";}
				}
				?>

				<form method="POST" action="" class="form-group form-inline">
					<input class="form control" placeholder="New Expense" type="text" name="name" required><br>
					<input class="btn btn-success" type="submit" name="submit" value="Add">
				</form>
			</div>
		</div>
		<!-- EXPENSE LIST -->
		<div class="row mt-5">
			<div class="col-12">
				<?php 
					$expenses = $user->getExpenses();
				 ?>
				 
				 <table class="table table-striped text-center">
				 	<tr>
				 		<th scope="col">Serial.</th>			 			
				 		<th scope="col">Expense Name</th>
				 		<th scope="col">List</th>
				 	</tr>
				 	<tbody>
				 		<?php 
				 			foreach($expenses as $key => $value):
				 		 ?>
				 		 <tr>
				 		 	<td><?= $key+1 ?></td>
				 		 	<td><?= $value['name'] ?></td>
				 		 	<td><a href="expense-details.php?exid=<?= $value['id'] ?>">List</a></td>
				 		 </tr>
				 		<?php endforeach; ?>

				 	</tbody>
				 </table>
				
			</div>
		</div>
	</div>

</body>
</html>