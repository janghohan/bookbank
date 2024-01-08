<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['login_user_ix']) ? $_COOKIE['login_user_ix'] : 0;


$sql = "SELECT * FROM delivery WHERE user_ix='$user_ix' ORDER BY is_basic,create_time DESC";

if($conn->query($sql)){
	echo 1;
}else{
	echo 0;
}



$conn->close();


?>
