<?php 
include './dbConnect.php';

$user_id = $_COOKIE['user_id']; //유저 고유 번호
$page = isset($_POST['page']) ? $_POST['page'] : 1;

$itemsPerPage = 5;
$displayPageNum = 10;

// 시작 아이템 및 끝 아이템 계산
$start = ($page - 1) * $itemsPerPage;

$listSql = "SELECT * FROM qna_list JOIN user_list ON qna_list.user_id='$user_id' AND user_list.user_id = qna_list.user_id ORDER BY qna_list.create_time DESC LIMIT $start, $itemsPerPage";
$listResult = $conn->query($listSql);

//남은 갯수가 몇갠지 판단
$nextStart = $page * $itemsPerPage;
$chkSql = "SELECT * FROM qna_list JOIN user_list ON qna_list.user_id='$user_id' AND user_list.user_id = qna_list.user_id ORDER BY qna_list.create_time DESC LIMIT $nextStart, $itemsPerPage";
$chkResult = $conn->query($chkSql);
$count = $chkResult->num_rows;


$data = array();
$dataCode = '';
while($listRow = $listResult->fetch_assoc()){
	$isAnswered = $listRow['is_answered'];

	if($isAnswered==1){
		$classText = "answered";
		$text = "답변완료";
	}else if($isAnswered==0){
		$classText = "notanswered";
		$text = "답변대기";
	}



	$dataCode .= "<li class='$classText'>";
	$dataCode .= "<div class='reserve-row'>";
	$dataCode .= "<div class='details_'>";
	$dataCode .= "<span>".$text."</span>";
	$dataCode .= "<div>".$listRow['qna_title']."</div>";
	$dataCode .= "</div>";
	$dataCode .= "<div class='point_'>";
	$dataCode .= "<div class='drop_btn'>전체보기</div>";
	$dataCode .= "</div>";
	$dataCode .= "</div>";

	$dataCode .= "<div class='full-text'>";
	$dataCode .= "<div class='bar'></div>";
	$dataCode .= "<div class='data-row'>";
	$dataCode .= "<span class='title'>문의 내용 : </span>";
	$dataCode .= "<p>".$listRow['qna_content']."</p>";
	$dataCode .= "</div>";

	$dataCode .= "<div class='bar'></div>";
	$dataCode .= "<div class='data-row'>";
	$dataCode .= "<span class='title'>답변 내용 : </span>";
	$dataCode .= "<p>".$listRow['answer_content']."</p>";
	$dataCode .= "</div>";

	// $dataCode .= "<div class='data-row'>";
	// $dataCode .= "<span class='title'>답변날짜 : </span>";
	// $dataCode .= "<span>".$listRow['answer_time']."</span>";
	// $dataCode .= "</div>";

	$dataCode .= "</div></li>";
}


// // JSON으로 반환
$data = json_encode(array(
    'data' => $dataCode,
    'nextNum' => $count

));

echo $data;

$conn->close();
 ?>