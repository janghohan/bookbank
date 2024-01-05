<?php 
include '../dbConnect.php';

$today = date("Y-m-d");

$userId = $_COOKIE['user_id'];
$userName = $_COOKIE['login_name'];
$qnaPwd = isset($_POST['qna_pwd']) ? $_POST['qna_pwd'] : '';
$qnaCate = isset($_POST['qna_cate']) ? $_POST['qna_cate'] : 1;
$qnaTitle = isset($_POST['qna_title']) ? $_POST['qna_title'] : 1;
$qnaContent = isset($_POST['qna_content']) ? $_POST['qna_content'] : 1;

if($qnaPwd==""){
	$sql = "INSERT INTO qna_list(user_id,user_name,category,qna_title,qna_content,create_date) VALUES('$userId','$userName','$qnaCate','$qnaTitle','$qnaContent','$today')";
}else{
	$qnaPwd = md5($qnaPwd);
	$sql = "INSERT INTO qna_list(user_id,user_name,category,is_secret,qna_pwd,qna_title,qna_content,create_date) VALUES('$userId','$userName','$qnaCate',1,'$qnaPwd','$qnaTitle','$qnaContent','$today')";
}

if ($conn->query($sql) === TRUE) {
    echo "문의가 작성되었습니다.";
} else {
    echo "문제가 발생하였습니다. 관리자에게 문의해주세요.";
}

$conn->close();

?>