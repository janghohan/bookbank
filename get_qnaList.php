<?php 
include './dbConnect.php';
$today = date("Y-m-d");

$page = isset($_POST['page']) ? $_POST['page'] : 1;

$itemsPerPage = 10;
$displayPageNum = 5;


// 시작 아이템 및 끝 아이템 계산
$start = ($page - 1) * $itemsPerPage;

$totalRecordsQuery = "SELECT COUNT(*) AS count FROM qna_list ORDER BY create_time DESC";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['count'];
$totalPages = ceil($totalRecords/ $itemsPerPage);
$endPage = ((($page - 1) / $displayPageNum) + 1) * $displayPageNum;

if($totalPages < $endPage) $endPage = $totalPages;

$startPage = (($page - 1)/$displayPageNum) * $displayPageNum + 1;



$listSql = "SELECT qna_list.qna_id,qna_list.category,qna_list.qna_title,qna_list.create_date,qna_list.is_secret,qna_list.is_answered,user_list.id FROM qna_list JOIN user_list ON qna_list.user_id = user_list.user_id ORDER BY qna_list.create_time DESC LIMIT $start, $itemsPerPage";
$listResult = $conn->query($listSql);

$data = array();
$dataCode = '';
while($listRow = $listResult->fetch_assoc()){
	$start = $start + 1;

	$dataCode .= "<div class='tr_'>";
	$dataCode .= "<dl class='com'>";
	$dataCode .= "<dd>".$start."</dd>";
	$dataCode .= "<dd>".$listRow['category']."</dd>";
	$dataCode .= "<dd>";

	if($listRow['is_secret']==1){
		if($listRow['is_answered']==1){
			$dataCode .= "<div class='subject lock'><a href='qna_detail.html?qna_id=".$listRow['qna_id']."'>".$listRow['qna_title']."</a></div><span class='answered'>답변완료</span>";
		}else{
			$dataCode .= "<div class='subject lock'><a href='qna_detail.html?qna_id=".$listRow['qna_id']."'>".$listRow['qna_title']."</a></div>";
		}
	}else{
		if($listRow['is_answered']==1){
			$dataCode .= "<div class='subject'><a href='qna_detail.html?qna_id=".$listRow['qna_id']."'>".$listRow['qna_title']."</a></div><span class='answered'>답변완료</span>";
		}else{
			$dataCode .= "<div class='subject'><a href='qna_detail.html?qna_id=".$listRow['qna_id']."'>".$listRow['qna_title']."</a></div>";
		}
		
	}
	$dataCode .= "</dd>";
	$dataCode .= "<dd>".maskEndOfString($listRow['id'])."</dd>";
	$dataCode .= "<dd>".$listRow['create_date']."</dd>";
	$dataCode .= "</dl>";
	$dataCode .= "</div>";
}

function maskEndOfString($input) {
    $length = strlen($input);

    // 문자열의 절반부터 끝까지를 '*'로 채우기
    $maskedString = substr($input, 0, $length / 2) . str_repeat('*', $length / 2);

    return $maskedString;
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
