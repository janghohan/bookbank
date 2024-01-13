<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$cart_ix = isset($_POST['cart_ix']) ? $_POST['cart_ix'] : '';


$sql = "DELETE FROM cart WHERE user_ix='$user_ix' AND cart_ix='$cart_ix'";

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
