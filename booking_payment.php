<?php
include './dbConnect.php';

if(!isset($_COOKIE['bookingServiceId'])){
	echo "<script> alert('예약 쿠키가 만료되었습니다. 다시 시도해주세요.'); </script>";
	echo "<script> location.href = './';</script>";
}

$bookingServiceId = isset($_COOKIE['bookingServiceId']) ? $_COOKIE['bookingServiceId'] : '';
$bookingStartDate = isset($_COOKIE['bookingStartDate']) ? $_COOKIE['bookingStartDate'] : '';
$bookingEndDate = isset($_COOKIE['bookingEndDate']) ? $_COOKIE['bookingEndDate'] : '';
$bookingAdultNum = isset($_COOKIE['bookingAdultNum']) ? $_COOKIE['bookingAdultNum'] : '';
$bookingKidsNum = isset($_COOKIE['bookingKidsNum']) ? $_COOKIE['bookingKidsNum'] : '';
$bookingPrice = isset($_COOKIE['bookingPrice']) ? $_COOKIE['bookingPrice'] : '';

//저전 비타민
$bookingStartTime = isset($_COOKIE['bookingStartTime']) ? $_COOKIE['bookingStartTime'] : '';
$bookingEndTime = isset($_COOKIE['bookingEndTime']) ? $_COOKIE['bookingEndTime'] : '';

$priceNumber = preg_replace("/[^0-9]/", "", $bookingPrice);

$serviceSql = "SELECT * FROM service_list WHERE service_id='$bookingServiceId'";
$serviceResult = $conn->query($serviceSql);
$serviceRow = $serviceResult->fetch_assoc();

$peopleTxt = "";
$bookingDate = "";
$bookingTime = "";
$adultKids = "";
if($bookingServiceId==1 || $bookingServiceId==2 || $bookingServiceId==3){
	$peopleTxt = "기준 : ".$serviceRow['service_min']."명 / 최대 : ".$serviceRow['service_max']."명";
	$bookingDate = $bookingStartDate." ~ ".$bookingEndDate;
	$adultKids = "성인 ".$bookingAdultNum." / 아동 ".$bookingKidsNum;
}else if($bookingServiceId==4 || $bookingServiceId==5){
	$peopleTxt = "최대 60명";
	$bookingDate = $bookingStartDate;
	$bookingTime = $bookingStartTime.":00 ~ ".$bookingEndTime.":00";
	$adultKids = "-";
}else{
	$peopletxt = "정원제한 없음";
	$bookingDate = $bookingStartDate;
	$bookingTime = $bookingStartTime.":00 ~ ".$bookingEndTime.":00";
	$adultKids = "-";
}

$bookingName = '';
$bookingEmail = '';
$phone1 = '';
$phone2 = '';

if(isset($_COOKIE['login_name'])){
	$bookingName = $_COOKIE['login_name'];
	$bookingPhone = $_COOKIE['login_contact'];
	$bookingEmail = $_COOKIE['login_email'];
	$bookingBirth = $_COOKIE['login_birth'];

	$prefix = substr($bookingPhone, 0, 3);
	$remainder = substr($bookingPhone, 3);

	// 네 자리씩 나누기
	$chunks = str_split($remainder, 4);
	$phone1 = $chunks[0];
	$phone2 = $chunks[1];
}


$accountSql = "SELECT * FROM account_number WHERE service_id='$bookingServiceId'";
$accountResult = $conn->query($accountSql);
$accountRow = $accountResult->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="code" charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes"/>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ko.js"></script>
	<link rel="stylesheet" type="text/css" href="STATIC/css/style.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="./STATIC/JS/common.js"></script>


  
</head>
<body>
	<?php include 'header.html'; ?>	

	<style type="text/css">
		.scroll-header{
			background-color: rgba(235,93,62,0.75);
			width: 100%;
			height: 280px;
			position: fixed;
		    top: 0;
		    z-index: 9999;
		    color: #fff;
		    display: none;
		}
		.scroll-container{
			width: 1440px;
			margin: 0 auto;
			display: flex;
			justify-content: space-between;
			align-items: baseline;
		}
		.scroll-container ul{
			text-align: center;
		}
		.scroll-container ul li:first-child{
			font-size: 22px;
		}
		.scroll-container ul li{
			padding-top: 15px;
		}


	</style>
	<button class="ham-button" id="ham-button">
		<img src="./STATIC/img/icon/black3bar.png">
	</button>
	<section class="scroll-header">
		<div class="scroll-container">
			<ul>
				<li>
					<a href="">홈</a>
				</li>
			</ul>
			<ul>
				<li>
					<a href="">마을조합</a>
				</li>
			</ul>
			<ul>
				<li><a href="">어여와</a></li>
				<li><a href="">어여와 1호</a></li>
				<li><a href="">어여와 2호</a></li>
				<li><a href="">어여와 3호</a></li>
			</ul>
			<ul>
				<li><a href="">저전나눔터</a></li>
			</ul>
			<ul>
				<li><a href="">비타민센터</a></li>
				<li><a href="">3층 비타민실</a></li>
				<li><a href="">3층 작은활동실</a></li>
			</ul>
			<ul>
				<li><a href="">쉐어하우스</a></li>
				<li><a href="">1호</a></li>
				<li><a href="">2호</a></li>
				<li><a href="">3호</a></li>
				<li><a href="">4호</a></li>
			</ul>
			<ul>
				<li><a href="">게시판</a></li>
				<li><a href="">공지사항</a></li>
				<li><a href="">문의사항</a></li>
			</ul>
		</div>

	</section>

	<script type="text/javascript">
		let prevScrollPos = window.pageYOffset;
		const headerHeight = 272; // 헤더의 높이에 따라 조절


		window.onscroll = function() {
		  let currentScrollPos = window.pageYOffset;
		  if (prevScrollPos > currentScrollPos) {
		    // 스크롤을 올릴 때

		    if(currentScrollPos < headerHeight) {
		    	document.getElementById("header").style.top = "0";
			    document.getElementById("ham-button").style.display = "none";
			    $(".scroll-header").css('display','none');
		    }
		    
		  } else {
		    // 스크롤을 내릴 때
		    document.getElementById("header").style.top = "-262px"; // 헤더의 높이에 따라 조절
		    document.getElementById("ham-button").style.display = "block";
		  }

		  prevScrollPos = currentScrollPos;
		};

		$("#ham-button").click(function (){
			$(".scroll-header").css('display','block');
		});

	</script>

	<style type="text/css">
		.payment-fullbox{
			margin: 0 auto;
			margin-top: 150px;
			overflow: hidden;
			margin-bottom: 50px;
			max-width: 1440px;

		}
		.payment-fullbox h1{
			font-size: 22px;
			margin-bottom: 5px;
		}

		table{
			width: 100%;
			text-align: center;
		}
		table th{
			padding-bottom: 20px;
			border-bottom: 1px solid #e7e7e7;
		}
		table td{
			padding: 20px 0;
			border-bottom: 1px solid #e7e7e7;
		}
		.serviceName{
			width: 400px;
		}
		.serviceDate{
			width: 400px;
		}
		.serviceNum {
			width: 200px;
		}
		.servicePrcie{
			width: 400px;
		}

		
	    .stay-fullBox{
	    	margin-top: 50px;
	    }
	   

		.bar{
			margin: 25px 0 20px 0;
    		border-bottom: 2px solid #aaa;
		}
		.price-box{
			display: flex;
			justify-content: right;
			align-items: center;
		}
		.price-box span{
			font-size: 24px;
		}
		.total-price{
		    padding-left: 17px;
		    font-weight: bold;
		}
		
	</style>
	<section class="payment-fullbox">
		<h1>선택 목록</h1>
		<div class="bar"></div>
		<div class="payment-info">
			<table>
				<thead>
					<th class="serviceName">서비스명</th>
					<th class="serviceDate">이용일/시간</th>
					<th class="serviceNum">인원</th>
					<th class="servicePrice">이용요금</th>
				</thead>
				<tbody>
					<tr>
						<td class="serviceName"><?=$serviceRow['service_name']?>
							<p><?=$peopleTxt?></p>
						</td>
						<td class="serviceDate"><?=$bookingDate?>
							<p><?=$bookingTime?></p>
						</td>
						<td class="serviceNum"><?=$adultKids?></td>
						<td class="servicePrice"><?=$bookingPrice?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="stay-fullBox">
			<div class="price-box">
				<span>총 결제 금액 : </span>
				<span class="total-price"><?=$bookingPrice?></span>
			</div>
		</div>

		<style type="text/css">
			.payment-info{
				display: flex;
				justify-content: space-between;
				align-items: center;
				margin-top: 80px;
			}
			.agree-box{
				width: 45%;
				height: 900px;
			}
			.term_wrap .dorp_wrap {
				display: block;
			}
		</style>
		<div class="payment-info">
 			<div class="agree-box">
 				<div class="term_wrap">
 					<ul>
						<li>
							<div class="term allCehck">
								<div class="checkbox_">
									<input type="checkbox" id="allCheck" class="agree-checkbox">
									<label>전체 약관에 모두 동의합니다.</label>
								</div>
							</div>
						</li>
						<li>
							<div class="term">
								<div class="checkbox_">
									<input type="checkbox" name="checkTrem" class="agree-checkbox">
									<label>이용시 유의사항에 동의(필수)</label>
								</div>
							</div>
							<div class="dorp_wrap" style="display: block;">
								<div class="text"><?php 
									if($bookingServiceId==1 || $bookingServiceId==2 || $bookingServiceId==3){
									 ?>
									- 어여와는 오우 3시 체크인, 오전 11시 체크아웃입니다.
									- 어여와는 안내견을 제외한 반려동물의 입실은 불가합니다.
									- 어여와는 금연공간입니다.
									- 침대에서는 음식물 섭취를 자제 부탁드립니다.
									- 비치된 집기류는 소중하게 다루어 주세요.
									- 인화성 휘발물, 냄새가 심한 물품 등 위험한 물품의 반입은 불가합니다.
									- 늦은 시간까지 과도한 소음 발생, 파티, 허용된 투숙객수의 초과, 기타 소란 행위를 피해주세요.
									- 보관품 및 분실물은 1개월 후에도 찾아가지 않으면 임의 처리 합니다.
									<?php }else if($bookingServiceId==5 || $bookingServiceId==6 || $bookingServiceId==7){ ?>

									-비타민센터는 지역 경제·문화 활성화 기여 등을 목적으로 합니다.
									-천재지변이나 기타 운영 상의 이유로 이용 시간을 변경할 수 있습니다.
									-비타민 저전골 마을관리 사회적협동조합, 저전동 주민에게는 시설 사용의 우선권이 주어집니다.
									-이용 기간 및 시간을 준수하여야 합니다.

									금지 및 제한사항
									1. 정치‧종교적 목적의 사용을 금지합니다.
									2. 현행법에 위반되는 행위
									3. 비타민 저전골 마을관리 사회적협동조합 프로그램 등 운영에 지장을 초래하거나, 이용 목적에 맞지 않을 경우 공간 사용을 제한할 수 있습니다.
									4. 승인이 되지 않은 예약은 시설 이용을 제한합니다.
									5. 소란을 피우거나 주변에 혐오감이나 불쾌감을 주는 행위, 쓰레기 등 오물을 지정장소 외의 곳에 버리는 행위, 시설 내부에서 허가 없이 불법 취사를 하는 행위, 기타 시설 관리‧운영에 지장을 주는 행위를 금지합니다.

									공간 대관승인 거절하는 경우
									1. 사후 처리가 미흡하거나 원상복구에 및 퇴실 등에 불응한 사실이 있는 경우
									2. 시설과 장비를 훼손했거나, 훼손할 우려가 확실하다고 판단된 경우3. 운영상의 이유로 이용 신청에 문제가 있다고 판단하는 경우

									<?php }else if($bookingServiceId==4){ ?>
									-저전나눔터는 지역 경제·문화 활성화 기여 등을 목적으로 합니다.
									-천재지변이나 기타 운영 상의 이유로 이용 시간을 변경할 수 있습니다.
									-비타민 저전골 마을관리 사회적협동조합, 저전동 주민에게는 시설 사용의 우선권이 주어집니다.
									-이용 기간 및 시간을 준수하여야 합니다.

									금지 및 제한사항
									1. 정치‧종교적 목적의 사용을 금지합니다.
									2. 현행법에 위반되는 행위
									3. 비타민 저전골 마을관리 사회적협동조합 프로그램 등 운영에 지장을 초래하거나, 이용 목적에 맞지 않을 경우 공간 사용을 제한할 수 있습니다.
									4. 승인이 되지 않은 예약은 시설 이용을 제한합니다.
									5. 소란을 피우거나 주변에 혐오감이나 불쾌감을 주는 행위, 쓰레기 등 오물을 지정장소 외의 곳에 버리는 행위, 시설 내부에서 허가 없이 불법 취사를 하는 행위, 기타 시설 관리‧운영에 지장을 주는 행위를 금지합니다.

									공간 대관승인 거절하는 경우
									1. 사후 처리가 미흡하거나 원상복구에 및 퇴실 등에 불응한 사실이 있는 경우
									2. 시설과 장비를 훼손했거나, 훼손할 우려가 확실하다고 판단된 경우3. 운영상의 이유로 이용 신청에 문제가 있다고 판단하는 경우
									<?php } ?>

								</div>
							</div>
						</li>
						<?php 
							if($bookingServiceId==1 || $bookingServiceId==2 || $bookingServiceId==3){
						 ?>
						<li>
							<div class="term">
								<div class="checkbox_">
									<input type="checkbox" name="checkTrem" class="agree-checkbox">
									<label>환불규정에 동의(필수)</label>
								</div>
							</div>
							<div class="dorp_wrap">
								<div class="text">
									<table>
										<thead>
											<th style="width: 50%;">기준</th>
											<th>취소요금</th>
										</thead>
										<tbody>
											<tr>
												<td>사용예정일 10일전까지 취소 또는 계약체결당일 취소</td>
												<td>100% 환급</td>
											</tr>
											<tr>
												<td>사용예정일 7일전까지 취소</td>
												<td>총 요금의 10%공제 후 환급</td>
											</tr>
											<tr>
												<td>사용예정일 5일전까지 취소</td>
												<td>총 요금의 30%공제 후 환급</td>
											</tr>
											<tr>
												<td>사용예정일 3일전까지 취소</td>
												<td>총 요금의 50%공제 후 환급</td>
											</tr>
											<tr>
												<td>사용예정일 1일전까지 취소</td>
												<td>총 요금의 80%공제 후 환급</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</li>
						<?php } ?>
						<li>
							<div class="term">
								<div class="checkbox_" >
									<input type="checkbox" name="checkTrem" class="agree-checkbox">
									<label>개인정보 수집 및 이용에 동의(필수)</label>
								</div>
							</div>
							<div class="dorp_wrap">
								<div class="text">
									<?php include './personalinfo.html'; ?>
								</div>
							</div>
						</li>		
					</ul>			
 				</div>
 			</div>
 			<style type="text/css">
 				input{
 					border-radius: 5px;
 				}
 				.reserve-box{
 					width: 50%;
 					height: 900px;
 				}
 				.reserve-box h1{
 					margin-bottom: 30px;
 				}
 				.input-row{
 					display: flex;
 					justify-content: flex-start;
 					align-items: center;
 					margin-bottom: 15px;
 				}
 				.input-row label{
 					width: 150px;
 				}
 				.input-row input[type='text']{
 					width: 430px;
 				}

 				.input-row input[type='number']{
 					width: 430px;
 				}

 				.input-row .notLogin{
 					width: 95px !important;
 				}
 				.input-row .login{
 					width: 132px !important;
 				}
 				.input-row span{
 					display: inline;
 					width: 17px;
 					text-align: center;
 				}
 				textarea{
 					width: 430px;
 					height: 70px;
 					border-radius: 5px;
 				}
 				.payment-box{
 					margin-top: 80px;
 				}
 				.input-row2{
 					display: flex;
 					justify-content: space-between;
 					align-items: center;
 				}
 				.pay-price{
 					color: #eb5d3e;

 				}
 				.payment-box .input-row .lab{
 					padding-left: 5px;
 					display: inline;
 				}
 				.btn-box{
 					display: flex;
 					justify-content: space-around;
 					margin-top: 15px;
 				}
 				.payBtn{
				    height: 60px;
				    border-radius: 10px;
				    font-size: 18px;
				    font-weight: 700;
				    background-color: #eb5d3e;
				    color: #fff;
				    width: 300px;
 				}
 				.cancelBtn{
 					height: 60px;
 					border-color: #eb5d3e;
				    border-radius: 10px;
				    font-size: 18px;
				    font-weight: 700;
				    color: #eb5d3e;
				    width: 300px;
				    background-color: #fff;
 				}
 				.input-row a{
 					flex-shrink: 0;
    				display: flex;
				    justify-content: center;
				    align-items: center;
				    text-align: center;
				    width: 101px;
				    height: 40px;
				    color: #eb5d3e;
				    border: 1px solid #eb5d3e;
				    border-radius: 5px;
				    font-size: 14px;
				    font-weight: 500;
				    margin-left: 10px;
				    cursor: pointer;
 				}
 				.accountText{
 					background-color: #F5F5FA;
				    border-radius: 5px;
				    padding: 5px 8px;
				    max-height: 180px;
				    white-space: pre-line;
				    font-size: 14px;
				    display: none;
 				}
 				.orange{
 					color: #eb5d3e;
 				}
 			</style>
 			<div class="reserve-box">
 				<form id="booking_form">
 					<h1>예약정보 입력</h1>
	 				<div class="input-row">
	 					<label>예약자명</label>
	 					<input type="text" name="bookingName" placeholder="예약자명" value="<?=$bookingName?>">
	 				</div>
	 				<div class="input-row">
	 					<label>생년월일</label>
	 					<input type="number" name="bookingBirth" placeholder="생년월일(예: 20231218)" value="<?=$bookingBirth?>">
	 				</div>
	 				<?php 
	 				if($bookingName==''){
	 				 ?>
	 				<div class="input-row">
	 					<label>연락처</label>
	 					<input class="notLogin" type="number" name="bookingNum1" value="010"><span>-</span>
	 					<input class="notLogin" type="number" name="bookingNum2" value="<?=$phone1?>" id="two"><span>-</span>
	 					<input class="notLogin" type="number" name="bookingNum3" value="<?=$phone2?>">
	 					<a class="send_auth">인증번호 전송</a>
	 				</div>
	 				<div class="input-row">
	 					<label>인증번호</label>
	 					<input type="number" name="auth_number"  placeholder="인증번호 입력">
	 				</div>
	 				<?php }else{
	 				 ?>
	 				 <div class="input-row">
	 					<label>연락처</label>
	 					<input class="login" type="number" name="bookingNum1" value="010"><span>-</span>
	 					<input class="login" type="number" name="bookingNum2" value="<?=$phone1?>"><span>-</span>
	 					<input class="login" type="number" name="bookingNum3" value="<?=$phone2?>">
	 				</div>
	 				<?php } ?>
	 				<div class="input-row">
	 					<label>이메일</label>
	 					<input type="text" name="bookingEmail" placeholder="이메일" value="<?=$bookingEmail?>">
	 				</div>
	 				<div class="input-row">
	 					<label>예약요청사항</label>
	 					<textarea name="bookingTxt"></textarea>
	 				</div>
 				</form>

 				<div class="payment-box">
 					<h1>결제정보</h1>
 					<div class="bar"></div>
 					<div class="input-row2">
 						<span>총 결제 금액</span>
 						<span style="font-weight: bold; font-size: 24px;"><span class="pay-price"><?=number_format($priceNumber)?></span>원</span>
 					</div>
 					<div class="input-row">
 						<label>결제 수단</label>
 						<!-- 
 						<input type="radio" name="paymentChk">
 						<label class="lab">신용카드</label>
 						 -->
 						<input type="radio" name="paymentChk" value="무통장입금">
 						<label class="lab">무통장입금</label>
 					</div>
 					<div class="accountText">
						<h2>무통장(계좌) 입금안내</h2>
						<p class="orange">* 입금계좌 : <?=$accountRow['bank']." ".$accountRow['number']?> 비타민 저전골 마을관리 사회적협동조합</p>
						<p class="orange">* 입금이 확인되면, 예약완료문자(업소연락처, 예약날짜 등)가 핸드폰으로 전송됩니다.</p>
						<p class="orange">* 무통장입금시 반드시 예약자명으로 입금하셔야합니다. 그렇지 않으면 입금확인이 되지 않을 수 있습니다.</p>
						<p>* 예약시점 이후 12시간(이용일 전날예약시 1시간, 당일예약시 1시간) 이내에 입금완료하지 않는 경우 자동취소됩니다.</p>
 					</div>
 					<div class="btn-box">
 						<button class="cancelBtn">이전/취소</button>
 						<button class="payBtn">결제</button>
 					</div>
 				</div>
 			</div>
		</div>
		<!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script> -->
		
	</section>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<?php include 'footer.html'; ?>

	<script type="text/javascript">
		$(".cancelBtn").click(function(){
			window.history.back();
		});

		var authNumber;

		//전체 동의 체크박스의 상태가 변경될 때
		$('#allCheck').change( function(){
			var check = $(this).is(':checked');
			if(check){
				$('input[name="checkTrem"]').prop("checked", true);
			}else{
				$('input[name="checkTrem"]').prop("checked", false);
			}
		});

		

		$(".send_auth").click(function(){
			var phoneNumber = $("input[name='bookingNum1']").val()+$("input[name='bookingNum2']").val()+$("input[name='bookingNum3']").val();
			$.ajax({
	          	type: "POST",
	          	dataType: 'json',
	          	url: "./API/sms_send_api.php", // 실제 서버 엔드포인트로 교체
	          	data: {receiverNumber : phoneNumber},
	          	success: function (response) {
	            // 성공적으로 응답을 받았을 때의 처리;
	            	console.log(response);
	            	if(response.result_code==1){
	            		alert('인증번호가 전송되었습니다.');
	            		authNumber = response.authNumber;
	            	}else{
	            		alert('문제가 발생했습니다. 관리자에게 문의해주세요.');
	            	}
	            	
	            	// $('#singup_form :input').val('');
	          	},
	          	error: function (error) {
	            // 오류 발생 시의 처리
	            	console.error("Error:", error);
	          	}
	        });
		});

		$("input[name='paymentChk']").change(function(){
			$(".accountText").css('display','block');
		});

		$(".payBtn").click(function(){
			console.log('a');
			if($("input[name='bookingName']").val()==""){
				newAlert('성함을 입력해주세요.');
				return false;
			}
			if($("input[name='bookingBirth']").val()==""){
				newAlert('생년월일을 입력해주세요.');
				return false;
			}
			if($("input[name='bookingEmail']").val()==""){
				newAlert('이메일을 입력해주세요.');
				return false;
			}

			if($("input[name='bookingNum2']").val()=="" || $("input[name='bookingNum3']").val()==""){
				newAlert('연락처를 입력해주세요.');
				return false;
			}

			if($("input[name='auth_number']").val()==""){
				newAlert('인증번호를 입력해주세요.');
				return false;
			}

			if($("input[name='auth_number']").val()!=authNumber){
				newAlert('인증번호가 일치하지 않습니다.');
				return false;
			}

			if($('.agree-checkbox:checked').length !== $('.agree-checkbox').length){
				newAlert('이용약관에 동의해주세요.');
				return false;
			}

			if($("input[name='paymentChk']:checked").length <= 0){
				newAlert('결제 방법을 선택해주세요.');
				return false;
			}

			

			Swal.fire({
		      text: "예약을 완료하시겠습니까?",
		      showCancelButton: true,
		      confirmButtonColor: '#eb5d3e',
		      cancelButtonColor: '#EEEEEE',
		      confirmButtonText: '확인',
		      cancelButtonText: '취소',
		    }).then((result) => {
		      	if (result.isConfirmed) {
		       		booking();
		      	} else if (result.dismiss === Swal.DismissReason.cancel) {
		        // Swal.fire('취소', '작업이 취소되었습니다.', 'error');
		        // 여기에 취소 버튼을 눌렀을 때의 동작을 추가할 수 있습니다.
		      	}
		    });
			
		});

		function booking(){
			var formData = $("#booking_form").serialize();
			$.ajax({
	          	type: "POST",
	          	dataType: 'json',
	          	url: "./API/booking_complete_api.php", // 실제 서버 엔드포인트로 교체
	          	data: formData,
	          	success: function (response) {
	            // 성공적으로 응답을 받았을 때의 처리;
	            	console.log(response);
	            	if(response.resultCode==1){
	            		Swal.fire({
					      text: "예약이 완료되었습니다.",
					      confirmButtonColor: '#eb5d3e',
					      confirmButtonText: '확인',
					    }).then((result) => {
					      	if (result.isConfirmed) {
					      		sendSms(response.bookingNumber);
					      	} 
					    });
	            		
	            	}else if(response.resultCode==-1){
	            		if("<?=$bookingServiceId?>"<=3){
	            			alert('예약이 불가능한 날짜가 포함되어 있습니다.');
	            		}else{
	            			alert('예약이 불가능한 시간 포함되어 있습니다.');
	            		}
	            		
	            	}else{
	            		alert('문제가 발생했습니다. 관리자에게 문의해주세요.');
	            	}
	            	
	            	// $('#singup_form :input').val('');
	          	},
	          	error: function (error) {
	            // 오류 발생 시의 처리
	            	console.error("Error:", error);
	          	}
	        });
		}

		function sendSms(bookingNumber){
			$.ajax({
	          	type: "POST",
	          	dataType: 'json',
	          	url: "./API/sms_booking_api.php", // 실제 서버 엔드포인트로 교체
	          	data: {bookingNumber:bookingNumber},
	          	success: function (response) {
	            // 성공적으로 응답을 받았을 때의 처리;
	            	console.log(response);
	            	if(response.result_code==1){
	            		Swal.fire({
					      text: "예약정보가 문자로 발송되었습니다. ",
					      confirmButtonColor: '#eb5d3e',
					      confirmButtonText: '확인',
					    }).then((result) => {
					      	if (result.isConfirmed) {
					      		location.href='./reserve_view.html?bookingNumber='+response.bookingNumber;
					      	} 
					    });
	            	}else{
	            		alert('문제가 발생했습니다. 관리자에게 문의해주세요.');
	            	}
	            	
	            	// $('#singup_form :input').val('');
	          	},
	          	error: function (error) {
	            // 오류 발생 시의 처리
	            	console.error("Error:", error);
	          	}
	        });
		}




	</script>
</body>
</html>