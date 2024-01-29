<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$bookIx = isset($_POST['bookIx']) ? $_POST['bookIx'] : 1;


$chkSql = "SELECT * FROM cart WHERE user_ix='$user_ix' AND book_ix='$bookIx'";
$chkResult = $conn->query($chkSql);
$chkCount = $chkResult->num_rows;

if($chkCount <= 0){
	$sql = "INSERT INTO cart(user_ix,book_ix,quantity,rental_price) SELECT $user_ix, $bookIx, 1, rental_price FROM books WHERE book_ix='$bookIx'";

	if($conn->query($sql)){
		$data = json_encode(array(
	        'resultCode' => 1
	    ));
	}else{
		$data = json_encode(array(
	        'resultCode' => 0
	    ));
	}
}else{
	//이미 장바구니에 담긴상품이라면 수량 늘리기
	// $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_ix='$user_ix' AND book_ix='$bookIx'";

	$data = json_encode(array(
        'resultCode' => -1
    ));
}


echo $data;

$conn->close();


?>
