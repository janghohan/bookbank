<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['login_user_ix']) ? $_COOKIE['login_user_ix'] : 0;

$delivery_name = isset($_POST['delivery_name']) ? $_POST['delivery_name'] : '';
$receiver_name = isset($_POST['receiver_name']) ? $_POST['receiver_name'] : '';
$receiver_contact = isset($_POST['receiver_contact']) ? $_POST['receiver_contact'] : '';
$new_address = isset($_POST['new_address']) ? $_POST['new_address'] : '';
$new_address_detail = isset($_POST['new_address_detail']) ? $_POST['new_address_detail'] : '';

$formattedPhoneNumber = formatPhoneNumber($receiver_contact);
$receiver_address = $new_address." ".$new_address_detail;


$sql = "INSERT INTO delivery(user_ix,delivery_name,receiver_name,receiver_contact,receiver_address) VALUES('$user_ix','$delivery_name','$receiver_name','$formattedPhoneNumber','$receiver_address')";

if($conn->query($sql)){
	echo 1;
}else{
	echo 0;
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
