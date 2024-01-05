<?php 
include './dbConnect.php';
$today = date("Y-m-d");

$page = isset($_POST['page']) ? $_POST['page'] : 1;

$itemsPerPage = 10;
$displayPageNum = 5;

//고정 공지사항 위로 올리기
$pinnedSql = "SELECT * FROM notice_list WHERE is_pinned='1' ORDER BY create_time DESC";
$pinnedResult = $conn->query($pinnedSql);
$data = array();
$dataCode = '';

$pinnedCount = $pinnedResult->num_rows;
$itemsPerPage = $itemsPerPage - $pinnedCount; //고정된 공지사항 빼고 나머지만큼 추가한다.
while($pinnedRow = $pinnedResult->fetch_assoc()){
	$dataCode .= "<div class='tr_'>";
	$dataCode .= "<dl class='com'>";
	$dataCode .= "<dd>*</dd>";
	$dataCode .= "<dd style='color:#eb5d3e;'>필독</dd>";
	$dataCode .= "<dd>";
	$dataCode .= "<div class='subject'><a href='notice_detail.html?notice_id=".$pinnedRow['notice_id']."'>".$pinnedRow['notice_title']."</a></div>";
	$dataCode .= "</dd>";
	$dataCode .= "<dd>".$pinnedRow['create_date']."</dd>";
	$dataCode .= "<dd>".$pinnedRow['notice_views']."</dd>";
	$dataCode .= "</dl>";
	$dataCode .= "</div>";
}


// 시작 아이템 및 끝 아이템 계산
$start = ($page - 1) * $itemsPerPage;

$totalRecordsQuery = "SELECT COUNT(*) AS count FROM notice_list WHERE is_pinned='0' ORDER BY create_time DESC";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['count'];
$totalPages = ceil($totalRecords/ $itemsPerPage);
$endPage = ((($page - 1) / $displayPageNum) + 1) * $displayPageNum;

if($totalPages < $endPage) $endPage = $totalPages;

$startPage = (($page - 1)/$displayPageNum) * $displayPageNum + 1;



$listSql = "SELECT * FROM notice_list WHERE is_pinned='0' ORDER BY create_time DESC LIMIT $start, $itemsPerPage";
$listResult = $conn->query($listSql);


while($listRow = $listResult->fetch_assoc()){
	$start = $start + 1;

	$dataCode .= "<div class='tr_'>";
	$dataCode .= "<dl class='com'>";
	$dataCode .= "<dd>".$start."</dd>";
	$dataCode .= "<dd>일반</dd>";
	$dataCode .= "<dd>";
	if($today==$listRow['create_date']){
		$dataCode .= "<div class='subject new'><a href='notice_detail.html?notice_id=".$listRow['notice_id']."'>".$listRow['notice_title']."</a></div>";
	}else{
		$dataCode .= "<div class='subject'><a href='notice_detail.html?notice_id=".$listRow['notice_id']."'>".$listRow['notice_title']."</a></div>";
	}
	
	$dataCode .= "</dd>";
	$dataCode .= "<dd>".$listRow['create_date']."</dd>";
	$dataCode .= "<dd>".$listRow['notice_views']."</dd>";
	$dataCode .= "</dl>";
	$dataCode .= "</div>";
}



$data = json_encode(array(
    'data' => $dataCode,
    'totalRecords' => $totalRecords,
    'startPage' => $startPage,
    'endPage' => $endPage,
    'totalPages' => $totalPages

));


echo $data;

$conn->close();
 ?>