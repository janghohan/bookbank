<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;
$orderIx = isset($_POST['orderIx']) ? $_POST['orderIx'] : '';


$errorChkTxt = "";
$ordersUpdateSql = "UPDATE orders SET status='cancelled' WHERE order_ix='$orderIx' AND user_ix='$user_ix'";

$selectDetailsSql = "SELECT * FROM order_details WHERE order_ix='$orderIx'";
$selectDetailsResult = $conn->query($selectDetailsSql);

$ownershipUpdateError = false;
$rentalDeleteError = false;
while($selectDetailsRow = $selectDetailsResult->fetch_assoc()){
	$ownership_ix = $selectDetailsRow['ownership_ix'];

	$ownershipUpdateSql = "UPDATE ownership SET status='available' WHERE ownership_ix='$ownership_ix'";
	$rentalDeleteSql = "DELETE FROM rental_history WHERE ownership_ix='$ownership_ix'";

	if(!$conn->query($ownershipUpdateSql)) $ownershipUpdateError = true;
	if(!$conn->query($rentalDeleteSql)) $rentalDeleteError = true;
}

if($ownershipUpdateError) $errorChkTxt .= " ownershipUpdate Error";
if($rentalDeleteError) $errorChkTxt .= " rentalDelete Error";



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
