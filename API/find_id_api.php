<?php 
session_start();
include '../dbConnect.php';
$expire = time() + (5 * 60);

$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$user_contact = isset($_POST['user_contact']) ? $_POST['user_contact'] : '';

$sql = "SELECT * FROM user_list WHERE name='$user_name' AND contact='$user_contact'";
$result = $conn->query($sql);

if($result->num_rows > 0){
	$row = $result->fetch_assoc();

	setcookie('find_id', $row['id'], $expire, "/");
	setcookie('find_date', $row['create_date'], $expire, "/");

	echo 200;

}else{
	echo 100;
}


$conn->close();


 ?>