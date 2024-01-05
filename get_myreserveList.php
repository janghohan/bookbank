<?php 
include './dbConnect.php';

$user_id = $_COOKIE['user_id']; //유저 고유 번호
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$serviceId = isset($_POST['serviceId']) ? $_POST['serviceId'] : 1;

$itemsPerPage = 5;
$displayPageNum = 10;

// 시작 아이템 및 끝 아이템 계산
$start = ($page - 1) * $itemsPerPage;

if($serviceId<=3){
	$listSql = "SELECT service_list.service_name,booked_list.start_date,booked_list.end_date,booked_list.booked_ok,booked_list.is_canceled,booked_list.booked_name,booked_list.booked_contact,booked_list.booked_num,booked_list.booked_fee,booked_list.payment_method,booked_list.payment_time,booked_list.booking_number FROM booked_list JOIN service_list ON booked_list.user_id='$user_id' AND booked_list.service_id = service_list.service_id AND booked_list.service_id='$serviceId' ORDER BY booked_list.create_time DESC LIMIT $start, $itemsPerPage";

	$listResult = $conn->query($listSql);

	//남은 갯수가 몇갠지 판단
	$nextStart = $page * $itemsPerPage;
	$chkSql = "SELECT * FROM booked_list JOIN service_list ON booked_list.user_id='$user_id' AND booked_list.service_id = service_list.service_id AND booked_list.service_id='$serviceId' ORDER BY booked_list.create_time DESC LIMIT $nextStart, $itemsPerPage";
	$chkResult = $conn->query($chkSql);
	$count = $chkResult->num_rows;


	$data = array();
	$dataCode = '';
	while($listRow = $listResult->fetch_assoc()){
		$isCanceled = $listRow['is_canceled'];
		$bookedOk = $listRow['booked_ok'];
		$paymentTime = $listRow['payment_time'];

		if($bookedOk==1){
			$classText = "booked";
			$text = "예약완료";
		}else if($bookedOk==0){
			$classText = "booking";
			$text = "예약진행중";
			$paymentTime = "입금대기";
		}
		if($isCanceled==1){
			$classText = "cancel";
			$text = "예약취소";
		}


		$dataCode .= "<li class='$classText'>";
		$dataCode .= "<div class='reserve-row'>";
		$dataCode .= "<div class='details_'>";
		$dataCode .= "<span>".$text."</span>";
		$dataCode .= "<p>".$listRow['start_date']."~".$listRow['end_date']."</p>";
		$dataCode .= "<div>".$listRow['service_name']."</div>";
		$dataCode .= "</div>";
		$dataCode .= "<div class='point_'>";
		$dataCode .= "<div class='drop_btn show'>전체보기</div>";
		$dataCode .= "</div>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='full-text'>";
		$dataCode .= "<div class='bar'></div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약번호 : </span>";
		$dataCode .= "<span>".$listRow['booking_number']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약자 이름 : </span>";
		$dataCode .= "<span>".$listRow['booked_name']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약자 연락처 : </span>";
		$dataCode .= "<span>".$listRow['booked_contact']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약인원 : </span>";
		$dataCode .= "<span>".$listRow['booked_num']."명</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>결제방법 : </span>";
		$dataCode .= "<span>".$listRow['payment_method']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>결제요금 : </span>";
		$dataCode .= "<span>".number_format($listRow['booked_fee'])."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>결제일 : </span>";
		$dataCode .= "<span>".$paymentTime."</span>";
		$dataCode .= "</div>";

		$dataCode .= "</div></li>";
	}


	// // JSON으로 반환
	$data = json_encode(array(
	    'data' => $dataCode,
	    'nextNum' => $count

	));

//저전나눔터, 비타민센터
}else{
	$listSql = "SELECT service_list.service_name,hourbooked_list.start_date,hourbooked_list.booked_ok,hourbooked_list.is_canceled,hourbooked_list.booked_name,hourbooked_list.booked_contact,hourbooked_list.booked_num,hourbooked_list.booked_fee,hourbooked_list.payment_method,hourbooked_list.payment_time,hourbooked_list.booking_number,hourbooked_list.start_time,hourbooked_list.end_time FROM hourbooked_list JOIN service_list ON hourbooked_list.user_id='$user_id' AND hourbooked_list.service_id = service_list.service_id AND hourbooked_list.service_id='$serviceId' ORDER BY hourbooked_list.create_time DESC LIMIT $start, $itemsPerPage";

	$listResult = $conn->query($listSql);

	//남은 갯수가 몇갠지 판단
	$nextStart = $page * $itemsPerPage;
	$chkSql = "SELECT * FROM hourbooked_list JOIN service_list ON hourbooked_list.user_id='$user_id' AND hourbooked_list.service_id = service_list.service_id AND hourbooked_list.service_id='$serviceId' ORDER BY hourbooked_list.create_time DESC LIMIT $nextStart, $itemsPerPage";
	$chkResult = $conn->query($chkSql);
	$count = $chkResult->num_rows;


	$data = array();
	$dataCode = '';
	while($listRow = $listResult->fetch_assoc()){
		$isCanceled = $listRow['is_canceled'];
		$bookedOk = $listRow['booked_ok'];
		$paymentTime = $listRow['payment_time'];

		if($bookedOk==1){
			$classText = "booked";
			$text = "예약완료";
		}else if($bookedOk==0){
			$classText = "booking";
			$text = "예약진행중";
			$paymentTime = "입금대기";
		}
		if($isCanceled==1){
			$classText = "cancel";
			$text = "예약취소";
		}


		$dataCode .= "<li class='$classText'>";
		$dataCode .= "<div class='reserve-row'>";
		$dataCode .= "<div class='details_'>";
		$dataCode .= "<span>".$text."</span>";
		$dataCode .= "<p>".$listRow['start_date']."</p>";
		$dataCode .= "<div>".$listRow['service_name']."</div>";
		$dataCode .= "</div>";
		$dataCode .= "<div class='point_'>";
		$dataCode .= "<div class='drop_btn show'>전체보기</div>";
		$dataCode .= "</div>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='full-text'>";
		$dataCode .= "<div class='bar'></div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약번호 : </span>";
		$dataCode .= "<span>".$listRow['booking_number']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약시간 : </span>";
		$dataCode .= "<span>".$listRow['start_time']." ~ ".$listRow['end_time']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약자 이름 : </span>";
		$dataCode .= "<span>".$listRow['booked_name']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약자 연락처 : </span>";
		$dataCode .= "<span>".$listRow['booked_contact']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>예약인원 : </span>";
		$dataCode .= "<span>".$listRow['booked_num']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>결제방법 : </span>";
		$dataCode .= "<span>".$listRow['payment_method']."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>결제요금 : </span>";
		$dataCode .= "<span>".number_format($listRow['booked_fee'])."</span>";
		$dataCode .= "</div>";

		$dataCode .= "<div class='data-row'>";
		$dataCode .= "<span class='title'>결제일 : </span>";
		$dataCode .= "<span>".$paymentTime."</span>";
		$dataCode .= "</div>";

		$dataCode .= "</div></li>";
	}


	// // JSON으로 반환
	$data = json_encode(array(
	    'data' => $dataCode,
	    'nextNum' => $count

	));
}



echo $data;

$conn->close();
 ?>