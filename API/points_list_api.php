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

//포인트내역 가져오기
if($type=='all'){
	$pointSql = "SELECT * FROM points_history WHERE user_ix='$userIx' ORDER BY create_date DESC  LIMIT $start, $itemsPerPage";
}else if($type=='in'){
	$pointSql = "SELECT * FROM points_history WHERE user_ix='$userIx' AND type='적립' ORDER BY create_date DESC LIMIT $start, $itemsPerPage";
}else if($type=='out'){
	$pointSql = "SELECT * FROM points_history WHERE user_ix='$userIx' AND type='출금' ORDER BY create_date DESC LIMIT $start, $itemsPerPage";
}

$rows = array();
$pointResult = $conn->query($pointSql);
if ($pointResult->num_rows > 0) {
    while($row = $pointResult->fetch_assoc()) {

        if($row['type']=='적립'){
        	$row['txt'] = '구매적립';
        	$row['ord_txt'] = $row['order_num'];
        	$row['sign'] = '+';
        }else{
        	$row['txt'] = '포인트출금';
        	$row['ord_txt'] = '-';
        	$row['sign'] = '-';
        }

        $rows[] = $row;
 
    }
}

if($type=='all'){
	$totalSql = "SELECT COUNT(*) AS count FROM points_history WHERE user_ix='$userIx' ORDER BY create_date DESC";
}else if($type=='in'){
	$totalSql = "SELECT COUNT(*) AS count FROM points_history WHERE user_ix='$userIx' AND type='적립' ORDER BY create_date DESC ";
}else if($type=='out'){
	$totalSql = "SELECT COUNT(*) AS count FROM points_history WHERE user_ix='$userIx' AND type='출금' ORDER BY create_date DESC";
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