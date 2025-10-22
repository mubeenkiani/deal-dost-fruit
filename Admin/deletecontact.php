 <?php 
include 'connection.php';
	$id = $_GET['Id'];

	$sql = "DELETE FROM `contact` WHERE Id = '$id'";
	$run = mysqli_query($connect,$sql);
	if (!$run) {}
		else {
			header("location:managecontact.php");
		}
?>
