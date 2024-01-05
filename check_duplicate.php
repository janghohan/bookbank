<?php 
include './dbConnect.php';

$userId = isset($_POST['userid']) ? $_POST['userid'] : 1;


$sql = "SELECT COUNT(*) as count FROM user_list WHERE id='$userId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
	echo true;
}else{
	echo false;
}


?>