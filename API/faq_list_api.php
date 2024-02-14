<?php 
include '../dbConnect.php';
$today = date("Y-m-d");

$userIx = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 1;
$type = isset($_POST['type']) ? $_POST['type'] : 'all';

//포인트내역 가져오기
if($type=='all'){
	$faqSql = "SELECT * FROM faq ";
}else if($type=='이용문의'){
	$faqSql = "SELECT * FROM faq WHERE faq_type='이용문의'";
}else if($type=='배송'){
	$faqSql = "SELECT * FROM faq WHERE faq_type='배송'";
}else if($type=='포인트'){
    $faqSql = "SELECT * FROM faq WHERE faq_type='포인트'";
}

$rows = array();
$faqResult = $conn->query($faqSql);
if ($faqResult->num_rows > 0) {
    while($row = $faqResult->fetch_assoc()) {
        $rows[] = $row;
 
    }
}


$data = array();

$data = json_encode(array(
    'data' => $rows
));


echo $data;

$conn->close();
 ?>