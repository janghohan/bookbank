<?php 
include '../dbConnect.php';

$userId = isset($_POST['user_id']) ? $_POST['user_id'] : 1;
$userPwd = isset($_POST['user_password']) ? $_POST['user_password'] : 'wkdgh4232';
$userName = isset($_POST['user_name']) ? $_POST['user_name'] : 1;
$userBirth = isset($_POST['user_birth']) ? $_POST['user_birth'] : 1;
$userEmail = isset($_POST['user_email']) ? $_POST['user_email'] : 1;
$userContact = isset($_POST['user_contact']) ? $_POST['user_contact'] : 1;

$userContact = str_replace("-", "", $userContact);
// 솔트 생성

$hashedPassword = md5($userPwd);
// echo $hashed_password;

// 데이터베이스에 사용자 정보 저장
$sql = "INSERT INTO user_list(id,pwd,name,birth,email,contact) VALUES('$userId','$hashedPassword','$userName','$userBirth','$userEmail','$userContact')";

if ($conn->query($sql) === TRUE) {
    echo "회원가입이 완료되었습니다.";
} else {
    echo "문제가 발생하였습니다. 관리자에게 문의해주세요.";
}

$conn->close();

?>