<?php
/*장바구니에서 대여하기로 이동할때 동작하는 페이지*/
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

// 남아있던 tmp_order는 삭제하는 전처리
$delSql = "DELETE FROM tmp_order WHERE user_ix='$user_ix'";
$conn->query($delSql);

if (isset($_POST['checkTrem']) && is_array($_POST['checkTrem'])) {

	$is_ok = true;

    foreach ($_POST['checkTrem'] as $selectedOption) {
        $sql = "INSERT INTO tmp_order (user_ix,book_ix,quantity,rental_price) SELECT user_ix,book_ix,quantity,rental_price FROM cart WHERE cart.cart_ix='$selectedOption'";
        if($conn->query($sql)){

        }else{
        	$is_ok = false;
        }
        // $aa = $selectedOption;
    }

    if($is_ok){
    	$data = json_encode(array(
	        'resultCode' => 1
	    ));
    }else{
    	$data = json_encode(array(
	        'resultCode' => 0
	    ));
    }
    
} else {
    $data = json_encode(array(
        'resultCode' => -1
    ));
}



echo $data;

$conn->close();


?>
