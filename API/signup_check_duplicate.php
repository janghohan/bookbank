<?php 
include '../dbConnect.php';

$user_ix = isset($_POST['user_ix']) ? $_POST['user_ix'] : 1;


$sql = "SELECT COUNT(*) as count FROM user WHERE user_ix='$user_ix'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
	echo true;
}else{
	echo false;
}


?>