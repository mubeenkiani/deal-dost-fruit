<?php 
include 'connection.php';
	$id = $_GET['Id'];

	$sql = "DELETE FROM `policy` WHERE Id = '$id'";
	$run = mysqli_query($connect,$sql);
	if (!$run) {}
		else {
			header("location:managepolicy.php");
		}
?>
