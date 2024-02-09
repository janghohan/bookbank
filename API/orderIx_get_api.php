<?php
include '../dbConnect.php';
//order_ix로 디테일한 정보를 가져오는 api

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;
$orderIx = isset($_POST['orderIx']) ? $_POST['orderIx'] : '';


$detailSql = "SELECT * FROM `order_details` JOIN ownership ON order_details.order_ix='$orderIx' AND order_details.ownership_ix = ownership.ownership_ix JOIN books ON ownership.book_ix = books.book_ix";

$detailResult = $conn->query($detailSql);



$rows = array();
while($detailRow = $detailResult->fetch_assoc()){
	$rows[] = $detailRow;
}


if($detailResult->num_rows > 0){
	$data = json_encode(array(
		'dataResult' => $rows,
	    'resultCode' => 1
	));
}else{
	$data = json_encode(array(
		'dataResult' => $rows,
	    'resultCode' => -1
	));
}


echo $data;

$conn->close();


?>
