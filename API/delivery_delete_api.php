<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$delivery_ix = isset($_POST['delivery_ix']) ? $_POST['delivery_ix'] : '';


$sql = "DELETE FROM delivery WHERE user_ix='$user_ix' AND delivery_ix='$delivery_ix'";

if($conn->query($sql)){
	echo 1;
}else{
	echo 0;
}



$conn->close();


?>
