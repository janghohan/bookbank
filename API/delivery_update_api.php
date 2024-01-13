<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$delivery_ix = isset($_POST['deliver_edit_ix']) ? $_POST['deliver_edit_ix'] : '';
$delivery_name = isset($_POST['delivery_edit_name']) ? $_POST['delivery_edit_name'] : '';
$receiver_name = isset($_POST['receiver_edit_name']) ? $_POST['receiver_edit_name'] : '';
$receiver_contact = isset($_POST['receiver_edit_contact']) ? $_POST['receiver_edit_contact'] : '';
$receiver_address = isset($_POST['edit_address']) ? $_POST['edit_address'] : '';
$receiver_address2 = isset($_POST['edit_address_detail']) ? $_POST['edit_address_detail'] : '';


$sql = "UPDATE delivery SET delivery_name='$delivery_name', receiver_name='$receiver_name', receiver_contact='$receiver_contact', receiver_address='$receiver_address', receiver_address2='$receiver_address2' WHERE user_ix='$user_ix' AND delivery_ix='$delivery_ix'";

if($conn->query($sql)){
	$data = json_encode(array(
        'resultCode' => 1,
        'delivery_name' => $delivery_name,
        'receiver_name' => $receiver_name,
        'receiver_contact' => $receiver_contact,
        'receiver_address' => $receiver_address,
        'receiver_address2' => $receiver_address2

    ));
}else{
	$data = json_encode(array(
        'resultCode' => 0

    ));
}

echo $data;


$conn->close();


?>
