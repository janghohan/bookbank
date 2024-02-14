<?php
include '../dbConnect.php';
//배송이 시작되기전 취소하는 api

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;
$orderIx = isset($_POST['orderIx']) ? $_POST['orderIx'] : '';
$today = date("Y-m-d");

$errorChkTxt = "";
//orders db status 회수중(retrieval)변경
$ordersUpdateSql = "UPDATE orders SET status='retrieval' WHERE order_ix='$orderIx' AND user_ix='$user_ix'";
if(!$conn->query($ordersUpdateSql)) $errorChkTxt .= " ordersUpdate Error";


//return_history 추가
$returnSql = "INSERT INTO return_history(user_ix,orders_ix,request_date) VALUES('$user_ix','$orderIx','$today')";

if($conn->query($returnSql)){
	$data = json_encode(array(
        'resultCode' => 1,
        'errorTxt' => $errorChkTxt
    ));
}else{
	$errorChkTxt .= " returnSql Error";
	$data = json_encode(array(
        'resultCode' => 0,
        'errorTxt' => $errorChkTxt
    ));
}

echo $data;

$conn->close();


?>
