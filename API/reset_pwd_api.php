<?php 
session_start();
include '../dbConnect.php';

$userId = isset($_COOKIE['find_id']) ? $_COOKIE['find_id'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

$hashedPassword = md5($password1);

//기존 비밀번호 체크
$chk_sql = "SELECT * FROM user_list WHERE id='$userId'";
$result = $conn->query($chk_sql);
$row = $result->fetch_assoc();

if($password1!=$password2) {
    echo 100;
}else{
    $sql = "UPDATE user_list SET pwd='$hashedPassword' WHERE id='$userId'";

    if($conn->query($sql)){
    	setcookie('find_id', "", time() - 3600, "/");
        echo 200;
    }else{
        echo 100;
    }
}

$conn->close();


 ?>