<?php 
include 'checkUserLogin.php';
include 'User.php';
$user = new User();

$exd_id = $_GET['exd_id'];


$user->deleteSpecificExpenseDetails($exd_id);

header('location:dashboard.php');

 ?>