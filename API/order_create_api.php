<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$usePoint = isset($_POST['usePoint']) ? $_POST['usePoint'] : 0; //사용포인트
$totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : 0; //포인트 사용해서 총 결제한 금액
$deliveryIx = isset($_POST['deliveryIx']) ? $_POST['deliveryIx'] : 0;
$memo = isset($_POST['memo']) ? $_POST['memo'] : '';

$totalPrice = str_replace(",", "", $totalPrice);
$total_amount = (int)$totalPrice + (int)$usePoint;

// 주문생성
$orderSql = "INSERT INTO orders(user_ix,delivery_ix,total_amount,discount_amount,points_used,memo) VALUES('$user_ix','$deliveryIx','$total_amount','$totalPrice','$usePoint','$memo')";

if($conn->query($orderSql)){
    $order_ix = $conn->insert_id;

    // 주문 상세내역
    $detailSql = "INSERT INTO order_details (order_ix, book_ix, quantity, unit_price)
        SELECT $order_ix, book_ix, quantity, price FROM tmp_order WHERE user_ix='$user_ix'";
    if($conn->query($detailSql)){
        //임시 테이블 삭제
        // $deleteSql = "DELETE FROM tmp_order WHERE user_ix='$user_ix'";
        // $conn->query($deleteSql);

        // 포인트 업데이트
        // $pointSql = "UPDATE user SET points=points-$usePoint WHERE user_ix='$user_ix'";
        // $conn->query($pointSql);

        $data = json_encode(array(
            'resultCode' => 1,
            'usePoint' => $usePoint,
            'totalPrice' => $totalPrice,
            'total_amount' => $total_amount
        ));
    }else{
        $data = json_encode(array(
            'resultCode' => 0
        ));
    }
}else{
    $data = json_encode(array(
        'resultCode' => 0
    ));

}



echo $data;

$conn->close();



?>
