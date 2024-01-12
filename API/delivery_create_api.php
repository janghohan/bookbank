<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['login_user_ix']) ? $_COOKIE['login_user_ix'] : 0;

$delivery_name = isset($_POST['delivery_name']) ? $_POST['delivery_name'] : '';
$receiver_name = isset($_POST['receiver_name']) ? $_POST['receiver_name'] : '';
$receiver_contact = isset($_POST['receiver_contact']) ? $_POST['receiver_contact'] : '';
$new_address = isset($_POST['new_address']) ? $_POST['new_address'] : '';
$new_address_detail = isset($_POST['new_address_detail']) ? $_POST['new_address_detail'] : '';

$formattedPhoneNumber = formatPhoneNumber($receiver_contact);
// $receiver_address = $new_address." ".$new_address_detail;


$sql = "INSERT INTO delivery(user_ix,delivery_name,receiver_name,receiver_contact,receiver_address,receiver_address2) VALUES('$user_ix','$delivery_name','$receiver_name','$formattedPhoneNumber','$new_address','$new_address_detail')";


if($conn->query($sql)){
    $delivery_ix = $conn->insert_id;

    $dataCode = '<li class="address_item">';
    $dataCode .= '<div class="address_chk_box">';
    $dataCode .= '<span class="form_rdo no_label">';
    $dataCode .= '<input type="radio" value="'.$delivery_ix.'" name="pop_delivery_list_item">';
    $dataCode .= '<label for="chkAddressList01-2">배송지 선택</label></span></div>';
    $dataCode .= '<div class="address_info_box">';
    $dataCode .= '<div class="address_name">';
    $dataCode .= '<span class="delivery_name fc_spot fwb">'.$delivery_name.'</span>';
    $dataCode .= '</div>';
    $dataCode .= '<div class="address_person mt5">';
    $dataCode .= '<span class="name">'.$receiver_name.' /</span>';
    $dataCode .= '<span class="phone_number">'.$formattedPhoneNumber.'</span>';
    $dataCode .= '</div>';
    $dataCode .= '<div class="address mt5">'.$new_address." ".$new_address_detail.'</div>';
    $dataCode .= '<input type="hidden" class="address_detail" value="'.$new_address_detail.'">';
    $dataCode .= '</div>';
    $dataCode .= '<div class="btn_wrap">';
    $dataCode .= '<button type="button" class="btn_xs btn_line_green pd5 bdr7 editBtn" data-id="'.$delivery_ix.'" data-dvsn-code="100">';
    $dataCode .= '<span class="text">수정</span></button>';
    $dataCode .= '<button type="button" class="btn_xs btn_light_gray pd5 bdr7 deleteBtn" data-id="'.$delivery_ix.'"><span class="text">삭제</span></button>';
    $dataCode .= '</div>';
    $dataCode .= '</li>';


	$data = json_encode(array(
        'resultCode' => 1,
        'data' => $dataCode

    ));
}else{
	$data = json_encode(array(
        'resultCode' => 0

    ));
}



echo $data;


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
