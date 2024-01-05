<?php 
include '../dbConnect.php';

if(isset($_COOKIE['user_id'])){
	$loginId =  $_COOKIE['user_id'];
	$bookingType = '회원';
}else{
	$loginId = '';
	$bookingType = '비회원';
}

//공통 쿠키
$bookingServiceId = isset($_COOKIE['bookingServiceId']) ? $_COOKIE['bookingServiceId'] : '';
$bookingStartDate = isset($_COOKIE['bookingStartDate']) ? $_COOKIE['bookingStartDate'] : '';
$bookingEndDate = isset($_COOKIE['bookingEndDate']) ? $_COOKIE['bookingEndDate'] : '';
$bookingAdultNum = isset($_COOKIE['bookingAdultNum']) ? $_COOKIE['bookingAdultNum'] : 0;
$bookingKidsNum = isset($_COOKIE['bookingKidsNum']) ? $_COOKIE['bookingKidsNum'] : 0;

//저전,비타민 쿠키
$bookingStartTime = isset($_COOKIE['bookingStartTime']) ? $_COOKIE['bookingStartTime'] : '';
$bookingEndTime = isset($_COOKIE['bookingEndTime']) ? $_COOKIE['bookingEndTime'] : '';

$bookingStartTime = $bookingStartTime.":00";
$bookingEndTime = $bookingEndTime.":00";

//요금관련
$bookingPrice = isset($_COOKIE['bookingPrice']) ? $_COOKIE['bookingPrice'] : '';
$bookingPrice = str_replace(",", "", $bookingPrice);
$bookingPrice = str_replace("원", "", $bookingPrice);

//포스트
$bookingName = isset($_POST['bookingName']) ? $_POST['bookingName'] : '';
$bookingBirth = isset($_POST['bookingBirth']) ? $_POST['bookingBirth'] : '';
$bookingNum1 = isset($_POST['bookingNum1']) ? $_POST['bookingNum1'] : '';
$bookingNum2 = isset($_POST['bookingNum2']) ? $_POST['bookingNum2'] : '';
$bookingNum3 = isset($_POST['bookingNum3']) ? $_POST['bookingNum3'] : '';

$bookingPhone = $bookingNum1."-".$bookingNum2."-".$bookingNum3;
$bookingNum = $bookingAdultNum + $bookingKidsNum;

$bookingEmail = isset($_POST['bookingEmail']) ? $_POST['bookingEmail'] : '';
$bookingTxt = isset($_POST['bookingTxt']) ? $_POST['bookingTxt'] : '';

$paymentChk = isset($_POST['paymentChk']) ? $_POST['paymentChk'] : '무통장입금';

// 솔트 생성
$bookingNumber = date("YmdHis").$bookingServiceId;

$today = date("Y-m-d");


//예약된 날짜가 있는지 체크
if($bookingServiceId<=3){
	$chkSql = "SELECT * FROM booked_list WHERE start_date<='$bookingStartDate' AND '$bookingStartDate'<end_date";

}else{
	$chkSql = "SELECT * FROM hourbooked_list WHERE start_date='$bookingStartDate' AND start_time<='$bookingStartTime' AND end_time>'$bookingEndTime'";
}


$chkRresult = $conn->query($chkSql);

if($chkRresult->num_rows <= 0){
	// 데이터베이스에 사용자 정보 저장
	if($bookingServiceId<=3){
		$sql = "INSERT INTO booked_list(booking_number,booking_type,service_id,user_id,booked_name,booked_birth,booked_contact,booked_num,booked_fee,booked_memo,payment_method,payment_time,start_date,end_date) VALUES('$bookingNumber','$bookingType','$bookingServiceId','$loginId','$bookingName','$bookingBirth','$bookingPhone','$bookingNum','$bookingPrice','$bookingTxt','$paymentChk','','$bookingStartDate','$bookingEndDate')";
	}else{
		$sql = "INSERT INTO hourbooked_list(booking_number,booking_type,service_id,user_id,booked_name,booked_birth,booked_contact,booked_fee,booked_memo,payment_method,payment_time,start_time,end_time,start_date,create_date) VALUES('$bookingNumber','$bookingType','$bookingServiceId','$loginId','$bookingName','$bookingBirth','$bookingPhone','$bookingPrice','$bookingTxt','$paymentChk','','$bookingStartTime','$bookingEndTime','$bookingStartDate','$today')";
	}




	if ($conn->query($sql) === TRUE) {
	    $data = json_encode(array(
		    'resultCode' => 1,
		    'bookingNumber' => $bookingNumber

		));
	} else {
	    $data = json_encode(array(
		    'resultCode' => 0,
		    'bookingNumber' => $bookingNumber

		));
	}
}else{
	$data = json_encode(array(
	    'resultCode' => -1,
	    'bookingNumber' => ''
	));
}




echo $data;

$conn->close();

?>