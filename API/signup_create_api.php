<?php 
include '../dbConnect.php';

$userId = isset($_POST['user_id']) ? $_POST['user_id'] : 1;
$userPwd = isset($_POST['user_password']) ? $_POST['user_password'] : 'wkdgh4232';
$userName = isset($_POST['user_name']) ? $_POST['user_name'] : 1;
$userContact = isset($_POST['user_contact']) ? $_POST['user_contact'] : 1;

$formattedPhoneNumber = formatPhoneNumber($userContact);
// 솔트 생성

$hashedPassword = md5($userPwd);
// echo $hashed_password;

// 데이터베이스에 사용자 정보 저장
$sql = "INSERT INTO user(user_id,user_pwd,user_name,user_contact) VALUES('$userId','$hashedPassword','$userName','$formattedPhoneNumber')";

if ($conn->query($sql) === TRUE) {
    echo "회원가입이 완료되었습니다.";
} else {
    echo "문제가 발생하였습니다. 관리자에게 문의해주세요.";
}

$conn->close();



function formatPhoneNumber($phoneNumber) {
    // 정규표현식을 사용하여 11자리 숫자 추출
    preg_match('/^(\d{3})(\d{4})(\d{4})$/', $phoneNumber, $matches);

    // 형식에 맞게 조합
    if (count($matches) === 4) {
        $formattedNumber = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
        return $formattedNumber;
    } else {
        // 유효하지 않은 전화번호 형식일 경우 처리
        return "유효하지 않은 전화번호 형식입니다.";
    }
}
?>