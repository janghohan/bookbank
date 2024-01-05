<?php 
include '../dbConnect.php';

$userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$exPassword = isset($_POST['ex_password']) ? $_POST['ex_password'] : '';
$newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : '';
$newPassword2 = isset($_POST['new_password2']) ? $_POST['new_password2'] : '';

$hashedPassword = md5($newPassword);

//기존 비밀번호 체크
$chk_sql = "SELECT * FROM user_list WHERE id='$userId'";
$result = $conn->query($chk_sql);
$row = $result->fetch_assoc();

if(md5($exPassword) != $row['pwd']) {
    echo '기존 비밀번호가 일치하지 않습니다.';
}else if($newPassword!=$newPassword2) {
    echo '새 비밀번호가 일치하지 않습니다.';
}else{
    $sql = "UPDATE user_list SET pwd='$hashedPassword' WHERE id='$userId'";

    if($conn->query($sql)){
        echo 1;
    }else{
        echo '문제가 발생하였습니다. 관리자에게 문의해주세요.';
    }
}

$conn->close();


 ?>