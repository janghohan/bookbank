<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

$reviewBookIx = isset($_POST['reviewBookIx']) ? $_POST['reviewBookIx'] : 1;
$reviewTxt = isset($_POST['reviewTxt']) ? $_POST['reviewTxt'] : '';
$reviewRate = isset($_POST['reviewRate']) ? $_POST['reviewRate'] : 5.0;
$date = date("Y-m-d");
$time = date("H:i:s");

$reviewSql = "INSERT INTO review(user_ix,book_ix,rate,review_text,create_date,create_time) VALUES('$user_ix','$reviewBookIx','$reviewRate','$reviewTxt','$date','$time')";


$chkSql = "SELECT * FROM review WHERE user_ix='$user_ix' AND book_ix='$reviewBookIx'";
$chkResult = $conn->query($chkSql);

if($chkResult->num_rows > 0){
	$data = json_encode(array(
        'resultCode' => -1
    ));

}else{
	if($conn->query($reviewSql)){
		$data = json_encode(array(
	        'resultCode' => 1
	    ));
	}else{
		$data = json_encode(array(
	        'resultCode' => 0
	    ));
	}
}


echo $data;

$conn->close();


?>
