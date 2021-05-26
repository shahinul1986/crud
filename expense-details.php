<?php 
include 'checkUserLogin.php';
include 'User.php';
$user = new User();

$ex_id = $_GET['exid'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Expense Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="row">
		<div class="card col-6 offset-lg-3">
			<h3>Add Details</h3> <a href="dashboard.php">Home</a>
			<?php 
				if(isset($_POST['submit'])){
					

					if($_FILES['image']['tmp_name'] != ''){
						//print_r($_FILES);
						$tmp_file = $_FILES['image']['tmp_name'];
						$image_name = uniqid().'.jpg';
						move_uploaded_file($tmp_file, 'photos/'.$image_name);

						$data_array = array(
								':expense_id' => $ex_id,
								':name' => $_POST['name'],
								':details' => $_POST['details'],
								':image' => $image_name,
								':amount' => $_POST['amount']
							);
						//print_r($data_array);
						$user->saveExpenseDetails($data_array);
						echo "Data saved";

					}else{
						$data_array = array(
								':expense_id' => $ex_id,
								':name' => $_POST['name'],
								':details' => $_POST['details'],
								':image' => null,
								':amount' => $_POST['amount']
							);
							$user->saveExpenseDetails($data_array);
						}				
				}

			 ?>
			<form action="" method="POST" class="form-group" enctype="multipart/form-data">
				<input class="form-control" placeholder="Name" type="text" name="name" required><br>
				<input class="form-control" placeholder="Details" type="text" name="details" required><br>
				<input class="form-control" placeholder="Amount" type="number" name="amount" required><br>
				<input class="form-control"  type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
				<input class="btn btn-success" type="submit" name="submit" value="Add">
			</form>
		</div>		
	</div>

	<!-- EXPENSE LIST -->
		<div class="row mt-5">
			<div class="col-12">
				<?php 
					
				 ?>				 
				 <table class="table table-striped text-center">
				 	<tr>
				 		<th scope="col">Serial.</th>			 			
				 		<th scope="col">Name</th>
				 		<th scope="col">Details</th>
				 		<th scope="col">Amount</th>
				 		<th scope="col">Image</th>
				 		<th scope="col">ACTION</th>
				 	</tr>
				 	<tbody>
				 		<?php 
				 			$allExpensesData = $user->getAllexpenseDetails($ex_id);
				 			$sum = 0;
				 			foreach($allExpensesData as $key => $value):
				 				$img = $value['image'];
				 				$sum = $sum + $value['amount'];
				 		 ?>
				 		 <tr>
				 		 	<td><?= $key+1 ?></td>
				 		 	<td><?= $value['name'] ?></td>
				 		 	<td><?= $value['details'] ?></td>
				 		 	<td><?= $value['amount'] ?></td>
				 		 	<td><?= $img !=null ? "<img src='photos/$img' width = '200px'/>" :"No Image" ?></td>
				 		 	<td><a href="edit.php?exd_id=<?= $value['id'] ?> &exid=<?= $ex_id ?>">Edit</a>|<a onclick="return confirm('Are you sure?')" href="delete.php?exd_id=<?= $value['id'] ?>">Delete</a></td>
				 		 </tr>
				 		<?php endforeach; ?>
				 		<tr>
				 			<td></td>
				 			<td></td>
				 			<td>Total:</td>
				 			<td><?= $sum ?></td>
				 			<td></td>
				 			<td></td>
				 		</tr>

				 	</tbody>
				 </table>
				
			</div>
		</div>
</body>
</html>