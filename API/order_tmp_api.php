<?php
include '../dbConnect.php';
//상품페이지에서 바로 대여하기눌럿을때 프로세싱 페이지

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;
$bookIx = isset($_POST['bookIx']) ? $_POST['bookIx'] : 1;

// 남아있던 tmp_order는 삭제하는 전처리
$delSql = "DELETE FROM tmp_order WHERE user_ix='$user_ix'";
$conn->query($delSql);


$sql = "INSERT INTO tmp_order (user_ix,book_ix,quantity,rental_price) SELECT $user_ix,$bookIx,1,rental_price FROM books WHERE book_ix='$bookIx'";

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
