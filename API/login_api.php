<?php 
session_start();
include '../dbConnect.php';
$expiration_time = time() + (86400 * 30);

$userId = isset($_POST['user_id']) ? $_POST['user_id'] : 'wkdgh5430';
$userPwd = isset($_POST['user_password']) ? $_POST['user_password'] : 'wkdgh4232';


$sql = "SELECT * FROM user_list WHERE id='$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // 저장된 솔트와 입력된 비밀번호를 조합하여 해시 생성
   	$hashedPassword = md5($userPwd);

    // 비밀번호 일치 여부 확인
    if ($hashedPassword == $row['pwd']) {
        setcookie('user_id', $row['user_id'], $expiration_time, "/");
        setcookie('login_id', $row['id'], $expiration_time, "/");
        setcookie('login_name', $row['name'], $expiration_time, "/");
        setcookie('login_email', $row['email'], $expiration_time, "/");
        setcookie('login_contact', $row['contact'], $expiration_time, "/");
        setcookie('login_birth', $row['birth'], $expiration_time, "/");

        echo 200;
        // exit;
    } else {
        echo "아이디 또는 비밀번호가 일치하지 않습니다.";
    }
} else {
    echo "아이디 또는 비밀번호가 일치하지 않습니다.";
}

// $conn->close();


 ?>