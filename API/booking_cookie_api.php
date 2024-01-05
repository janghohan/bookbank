<?php 
//결제 하려고 하는 내역을 임시 저장하는 쿠키 페이지
session_start();
include '../dbConnect.php';

// echo $_COOKIE['bookingPrice'];

$expire = time() + (300 * 60);

$bookingServiceId = isset($_POST['bookingServiceId']) ? $_POST['bookingServiceId'] : '';
$bookingStartDate = isset($_POST['bookingStartDate']) ? $_POST['bookingStartDate'] : '';
$bookingEndDate = isset($_POST['bookingEndDate']) ? $_POST['bookingEndDate'] : '';
$bookingAdultNum = isset($_POST['bookingAdultNum']) ? $_POST['bookingAdultNum'] : '';
$bookingKidsNum = isset($_POST['bookingKidsNum']) ? $_POST['bookingKidsNum'] : '';
$bookingPrice = isset($_POST['bookingPrice']) ? $_POST['bookingPrice'] : '';

$bookingStartTime = isset($_POST['bookingStartTime']) ? $_POST['bookingStartTime'] : '';
$bookingEndTime = isset($_POST['bookingEndTime']) ? $_POST['bookingEndTime'] : '';

//어여와
if($bookingServiceId<=3){
	setcookie('bookingServiceId', $bookingServiceId, $expire, "/");
	setcookie('bookingStartDate', $bookingStartDate, $expire, "/");
	setcookie('bookingEndDate', $bookingEndDate, $expire, "/");
	setcookie('bookingAdultNum', $bookingAdultNum, $expire, "/");
	setcookie('bookingKidsNum', $bookingKidsNum, $expire, "/");
	setcookie('bookingPrice', $bookingPrice, $expire, "/");

//저전마을 비타민
}else if($bookingServiceId>=4){
	setcookie('bookingServiceId', $bookingServiceId, $expire, "/");
	setcookie('bookingStartDate', $bookingStartDate, $expire, "/");
	setcookie('bookingStartTime', $bookingStartTime, $expire, "/");
	setcookie('bookingEndTime', $bookingEndTime, $expire, "/");
	setcookie('bookingPrice', $bookingPrice, $expire, "/");
}


echo 1;




 ?>