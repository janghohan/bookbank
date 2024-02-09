<?php 
include '../dbConnect.php';
$today = date("Y-m-d");

$userIx = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 1;
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$type = isset($_POST['type']) ? $_POST['type'] : 'all';

$itemsPerPage = 5;
$displayPageNum = 5;

// 시작 아이템 및 끝 아이템 계산
$start = ($page - 1) * $itemsPerPage;

//주문내역 가져오기
if($type=='all'){
	$orderSql = "SELECT * FROM orders WHERE user_ix='$userIx' ORDER BY order_date DESC LIMIT $start, $itemsPerPage";
}else if($type=='pending'){
	$orderSql = "SELECT * FROM orders WHERE user_ix='$userIx' AND status='pending' ORDER BY order_date DESC LIMIT $start, $itemsPerPage";
}else if($type=='processing'){
    $orderSql = "SELECT * FROM orders WHERE user_ix='$userIx' AND status='processing' ORDER BY order_date DESC LIMIT $start, $itemsPerPage";
}else if($type=='completed'){
    $orderSql = "SELECT * FROM orders WHERE user_ix='$userIx' AND status='completed' ORDER BY order_date DESC LIMIT $start, $itemsPerPage";
}else if($type=='cancelled'){
    $orderSql = "SELECT * FROM orders WHERE user_ix='$userIx' AND status='cancelled' ORDER BY order_date DESC LIMIT $start, $itemsPerPage";
}


$rows = array();
$orderResult = $conn->query($orderSql);
if ($orderResult->num_rows > 0) {
    while($row = $orderResult->fetch_assoc()) {

        $orderIx = $row['order_ix'];
        $detailSql = "SELECT * FROM order_details JOIN ownership ON order_details.order_ix='$orderIx' AND ownership.ownership_ix = order_details.ownership_ix JOIN books ON ownership.book_ix = books.book_ix";
        $detailResult = $conn->query($detailSql);
        $detailRow = $detailResult->fetch_assoc();

        $row['count'] = $detailResult->num_rows;
        $row['title'] = $detailRow['title'];
        $row['img_path'] = $detailRow['image_path'];
        $row['total_amount'] = number_format($row['total_amount']);
        if($row['count']>=2){
            $row['title'] = $detailRow['title']." 외 ".($row['count']-1)."권";
        }

        if($row['status']=='pending'){
            $row['status_txt'] = '상품준비중';
            $row['btn_txt'] = '주문취소';
            $row['btn_class'] = 'order-cancel';
        }else if($row['status']=='processing'){
            $row['status_txt'] = '배송중';
            $row['btn_txt'] = '회수신청';
            $row['btn_class'] = 'order-return';
        }else if($row['status']=='completed'){
            $row['status_txt'] = '배송완료';
            $row['btn_txt'] = '리뷰작성';
            $row['btn_class'] = 'order-review';
        }if($row['status']=='cancelled'){
            $row['status_txt'] = '주문취소';
            $row['btn_txt'] = '구매하기';
            $row['btn_class'] = 'order-rebuy';
        }
    
        $rows[] = $row;
    }
}

//주문내역 가져오기
if($type=='all'){
    $totalSql = "SELECT COUNT(*) as count FROM orders WHERE user_ix='$userIx' ORDER BY order_date DESC";
}else if($type=='pending'){
    $totalSql = "SELECT COUNT(*) as count FROM orders WHERE user_ix='$userIx' AND status='pending' ORDER BY order_date DESC";
}else if($type=='processing'){
    $totalSql = "SELECT COUNT(*) as count FROM orders WHERE user_ix='$userIx' AND status='processing' ORDER BY order_date DESC";
}else if($type=='completed'){
    $totalSql = "SELECT COUNT(*) as count FROM orders WHERE user_ix='$userIx' AND status='completed' ORDER BY order_date DESC";
}else if($type=='cancelled'){
    $totalSql = "SELECT COUNT(*) as count FROM orders WHERE user_ix='$userIx' AND status='cancelled' ORDER BY order_date DESC";
}

$totalRecordsResult = $conn->query($totalSql);
$totalRecords = $totalRecordsResult->fetch_assoc()['count'];


$totalPages = ceil($totalRecords/ $itemsPerPage);
$endPage = ((($page - 1) / $displayPageNum) + 1) * $displayPageNum;

if($totalPages < $endPage) $endPage = $totalPages;

$startPage = (($page - 1)/$displayPageNum) * $displayPageNum + 1;

$data = array();
$data = json_encode(array(
    'data' => $rows,
    'totalRecords' => $totalRecords,
    'startPage' => $startPage,
    'endPage' => $endPage,
    'totalPages' => $totalPages

));


echo $data;

$conn->close();

?>