<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['login_user_ix']) ? $_COOKIE['login_user_ix'] : 0;

$delivery_ix = isset($_POST['delivery_ix']) ? $_POST['delivery_ix'] : '';



$sql = "UPDATE delivery SET is_basic = CASE WHEN delivery_ix = '$delivery_ix' THEN 1 ELSE 0 END";

if($conn->query($sql)){
	$data = json_encode(array(
        'resultCode' => 1
    ));
}else{
	$data = json_encode(array(
        'resultCode' => 0

    ));
}

echo $data;


$conn->close();


?>
