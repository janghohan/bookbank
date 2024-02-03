<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$usePoint = isset($_POST['usePoint']) ? $_POST['usePoint'] : 0; //사용포인트
$totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : 0; //포인트 사용해서 총 결제한 금액
$deliveryIx = isset($_POST['deliveryIx']) ? $_POST['deliveryIx'] : 0;
$memo = isset($_POST['memo']) ? $_POST['memo'] : '';
$rentalDay = isset($_POST['rentalDay']) ? $_POST['rentalDay'] : 7; //대여기간
$rentalDay = (int)$rentalDay + 2;

$today = date("Y-m-d");

//배송관련 날짜
$rentalDate = $today; 
$returnDate = date("Y-m-d", strtotime("+$rentalDay days"));;//배송받은 다음날부터 rentalDay 만큼 + (보통 주문날 + 2일부터)

$totalPrice = str_replace(",", "", $totalPrice);
$total_amount = (int)$totalPrice + (int)$usePoint;


$current_time_seconds = time();
$order_num = $current_time_seconds;
// 주문생성
$orderSql = "INSERT INTO orders(order_num,user_ix,delivery_ix,total_amount,discount_amount,points_used,memo) VALUES('$order_num','$user_ix','$deliveryIx','$total_amount','$totalPrice','$usePoint','$memo')";



$errorChkTxt = "";
if($conn->query($orderSql)){
    $order_ix = $conn->insert_id;

    // 대여를 요청한 책에서 이용가능한 책에대한 정보를 가져온다(소유권 정보)
    $ownerSql = "SELECT tmp_order.*, 
                    (SELECT ownership_ix 
                     FROM ownership 
                     WHERE ownership.book_ix = tmp_order.book_ix AND ownership.status='available' 
                     ORDER BY RAND() 
                     LIMIT 1) AS selected_ownership_ix
                FROM tmp_order
                WHERE tmp_order.user_ix = '1'";

    if($ownerResult = $conn->query($ownerSql)){

    }else{
        $errorChkTxt .= " ownerSelectError ";
    }


    $detailError = false;
    $historyError = false;
    $stockError = false;
    $possibleError = false;

    while($ownerRow = $ownerResult->fetch_assoc()){
        $book_ix = $ownerRow['book_ix'];
        $ownership_ix = $ownerRow['selected_ownership_ix'];
        $rental_price = $ownerRow['rental_price'];

        // 주문 상세내역 추가sql
        $detailSql = "INSERT INTO order_details (order_ix, ownership_ix, quantity, unit_price) VALUES('$order_ix','$ownership_ix',1,'$rental_price')";
        if(!$conn->query($detailSql)) $detailError = true;

        //대여 히스토리 작성 sql
        $historySql = "INSERT INTO rental_history(user_ix,ownership_ix,rental_date,return_date) VALUES('$user_ix','$ownership_ix','$rentalDate','$returnDate')";
        if(!$conn->query($historySql)) $historyError = true;

        //재고감소 sql
        $stockSql = "UPDATE books SET stock_quantity = stock_quantity-1 WHERE book_ix='$book_ix'";
        if(!$conn->query($stockSql)) $stockError = true;
        
        //책 대여상태 변경 sql
        $possibleSql = "UPDATE ownership SET status='checked_out' WHERE ownership_ix='$ownership_ix'";
        if(!$conn->query($possibleSql)) $possibleError = true;
    }

    if($detailError) $errorChkTxt .= " detailError ";
    if($historyError) $errorChkTxt .= " historyError ";
    if($stockError) $errorChkTxt .= " stockError ";
    if($possibleError) $errorChkTxt .= " possibleError ";


    //유저 포인트 변경 sql
    $pointSql = "UPDATE user SET points = points - $usePoint WHERE user_ix='$user_ix'";
    if(!$conn->query($pointSql)) $errorChkTxt .= " pointError ";

    //임시주문 삭제 sql
    $tmpOrderDelSql = "DELETE FROM tmp_order WHERE user_ix='$user_ix'";
    if(!$conn->query($tmpOrderDelSql)) $errorChkTxt .= " tmpOrderError ";


    if($detailError || $historyError || $stockError || $possibleError ){
        $data = json_encode(array(
            'resultCode' => -1,
            'errorTxt' => $errorChkTxt
        ));
    }else{
        $data = json_encode(array(
            'resultCode' => 1,
            'errorTxt' => $errorChkTxt
        ));
    }

}else{
    $errorChkTxt .= " orderCreateError ";
    $data = json_encode(array(
        'resultCode' => 0,
        'errorTxt' => $errorChkTxt  
    ));

}



echo $data;

$conn->close();



?>
