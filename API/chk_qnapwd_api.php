<?php 
// $cookieName = 'qnaPwd_2';
// setcookie($cookieName,true,time() -1, "/");

session_start();
include '../dbConnect.php';
$today = date("Y-m-d");

$qnaId = isset($_POST['qna_id']) ? $_POST['qna_id'] : 1;
$qnaPwd = isset($_POST['qna_pwd']) ? $_POST['qna_pwd'] : 1;

$sql = "SELECT qna_pwd FROM qna_list WHERE qna_id = '$qnaId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



if($row['qna_pwd'] == md5($qnaPwd)){
	$cookieName = 'qnaPwd_' . $qnaId;
	setcookie($cookieName,true,time() + 3600, "/");
	echo 1;
}else{
	echo 0;
}



$conn->close();
 ?>
