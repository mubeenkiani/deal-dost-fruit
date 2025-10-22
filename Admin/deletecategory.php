<?php 
include 'connection.php';
	$id = $_GET['Id'];

	$sql = "DELETE FROM `product_category` WHERE Id = '$id'";
	$run = mysqli_query($connect,$sql);
	if (!$run) {}
		else {
			header("location:managecategory.php");
		}
?>
