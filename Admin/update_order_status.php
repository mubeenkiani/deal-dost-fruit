<?php
include 'connection.php';
if(isset($_POST['id']) && isset($_POST['status'])){
$id = $_POST['id'];
$status = $_POST['status'];
$update = mysqli_query($connect, "UPDATE `orders` SET order_status='$status' WHERE id='$id'");
if($update){echo "success";}else{echo "error";}
}
?>
