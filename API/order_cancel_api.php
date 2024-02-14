<?php
include '../dbConnect.php';
//배송이 시작되기전 취소하는 api

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;
$orderIx = isset($_POST['orderIx']) ? $_POST['orderIx'] : '';


$errorChkTxt = "";
//orders db status 변경
$ordersUpdateSql = "UPDATE orders SET status='cancelled' WHERE order_ix='$orderIx' AND user_ix='$user_ix'";


$selectDetailsSql = "SELECT * FROM order_details WHERE order_ix='$orderIx'";
$selectDetailsResult = $conn->query($selectDetailsSql);

$ownershipUpdateError = false;
$rentalDeleteError = false;
$bookStockError = false;
while($selectDetailsRow = $selectDetailsResult->fetch_assoc()){
	$ownership_ix = $selectDetailsRow['ownership_ix'];

	//책을 이용가능하도록 변경한다.
	$ownershipUpdateSql = "UPDATE ownership SET status='available' WHERE ownership_ix='$ownership_ix'";
	//취소이기 때문에 rental_history에 남기진 않는다.
	$rentalDeleteSql = "DELETE FROM rental_history WHERE ownership_ix='$ownership_ix'";

	//books의 재고 다시 증가
	$booksStockSql = "UPDATE books SET stock_quantity = stock_quantity + 1 WHERE book_ix IN (SELECT book_ix FROM ownership WHERE ownership_ix='$ownership_ix')";

	if(!$conn->query($ownershipUpdateSql)) $ownershipUpdateError = true;
	if(!$conn->query($rentalDeleteSql)) $rentalDeleteError = true;
	if(!$conn->query($booksStockSql)) $bookStockError = true;
}

if($ownershipUpdateError) $errorChkTxt .= " ownershipUpdate Error";
if($rentalDeleteError) $errorChkTxt .= " rentalDelete Error";
if($bookStockError) $errorChkTxt .= " bookStock Error";

//사용한 포인트 확인해서 취소시키기
$pointSelectSql = "SELECT * FROM orders WHERE order_ix='$orderIx' AND user_ix='$user_ix'";
$pointSelectResult = $conn->query($pointSelectSql);
$pointSelectRow = $pointSelectResult->fetch_assoc();

$usedPoint = $pointSelectRow['points_used']; //사용된 포인트
$order_num = $pointSelectRow['order_num'];

//사용된 포인트 추가
$pointSql = "UPDATE user SET points = points + $usedPoint WHERE user_ix='$user_ix'";
if(!$conn->query($pointSql)) $errorChkTxt .= " pointError ";

//포인트 이력 추가
if($usedPoint!=0){
    $pointCreateSql = "INSERT INTO points_history(user_ix,type,order_num,val) VALUES('$user_ix','취소','$order_num','$usedPoint')";
    $conn->query($pointCreateSql);
}

if($conn->query($ordersUpdateSql)){
	$data = json_encode(array(
        'resultCode' => 1,
        'errorTxt' => $errorChkTxt
    ));
}else{
	$errorChkTxt .= " ordersUpdate Error";
	$data = json_encode(array(
        'resultCode' => 0,
        'errorTxt' => $errorChkTxt
    ));
}

echo $data;

$conn->close();


?>
