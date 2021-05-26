<?php 
include 'checkUserLogin.php';
include 'User.php';
$user = new User();

$ex_id = $_GET['exd_id'];
$expense_id = $_GET['exid'];

$updateData = $user->getSpecificExpenseDetails($ex_id);

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit Expense</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 </head>
 <body>
 	<div class="container">
 		<div class="row mt-5">
 			<div class="col-8 offset">
 				<?php 
				if(isset($_POST['submit'])){
					

					if($_FILES['image']['tmp_name'] != ''){
						//print_r($_FILES);
						$tmp_file = $_FILES['image']['tmp_name'];
						$image_name = uniqid().'.jpg';
						move_uploaded_file($tmp_file, 'photos/'.$image_name);

						$data_array = array(
								':exd_id' => $ex_id,
								':name' => $_POST['name'],
								':details' => $_POST['details'],
								':image' => $image_name,
								':amount' => $_POST['amount']
							);
						
						$user->updateExpenseDetails($data_array);
						

					}else{
						$data_array = array(
								':exd_id' => $ex_id,
								':name' => $_POST['name'],
								':details' => $_POST['details'],
								':image' => $_POST['image_name'],
								':amount' => $_POST['amount']
							);
							$user->updateExpenseDetails($data_array);
						}

						header("location:expense-details.php?exid=$expense_id");			
				}

				foreach($updateData as $value):

			 ?>
			<form action="" method="POST" class="form-group" enctype="multipart/form-data">
				<input class="form-control" value="<?= $value['name'] ?>" placeholder="Name" type="text" name="name" required><br>
				<input class="form-control" value="<?= $value['details'] ?>" placeholder="Details" type="text" name="details" required><br>
				<input class="form-control" value="<?= $value['amount'] ?>" placeholder="Amount" type="number" name="amount" required><br>
				<input type="hidden" name="image_name" value="<?= $value['image'] ?>">
				<input class="form-control"  type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
				<img src="photos/<?= $value['image'] ?>" width = "100px"><br><br>
				<input class="btn btn-warning" type="submit" name="submit" value="Update">
			</form>
		<?php endforeach; ?>
 			</div>
 		</div>
 	</div>
 
 </body>
 </html>