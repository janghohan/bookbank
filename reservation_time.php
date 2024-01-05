<?php
//시간단위로 예약하는 저전나눔터, 비타민센터에 대한 예약 페이지
include './dbConnect.php';

$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : 1;
$choice_date =  isset($_GET['date']) ? $_GET['date']  : date("Y-m-d");


$currentTime = isset($_GET['time']) ? $_GET['time'] : date("H");
$nextTime = date("H", strtotime($currentTime) + 3600);

$currentTime = explode(":", $currentTime)[0];
$nextTime = explode(":", $nextTime)[0];


$serviceSql = "SELECT * FROM service_list WHERE service_id='$service_id'";
$serviceResult = $conn->query($serviceSql);
$serviceRow = $serviceResult->fetch_assoc();

$serviceName = $serviceRow['service_name'];
$serviceMin = $serviceRow['service_min'];
$serviceMax = $serviceRow['service_max'];
$servicePrice = $serviceRow['service_price'];

$imgSql = "SELECT * FROM img_list WHERE service_id='$service_id'";
$imgResult = $conn->query($imgSql);


$initPrice = number_format($servicePrice);
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
  
</head>
<body>
	<?php include 'header.html'; ?>	

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
		.reservation-fullbox{
			margin: 0 auto;
			margin-top: 150px;
			overflow: hidden;
			margin-bottom: 50px;
			max-width: 1440px;

		}
		.reservation-fullbox h1{
			font-size: 32px;
			margin-bottom: 40px;
		}

		.reservation-info{
			display: flex;
			justify-content: space-between;
			align-items: center;
			background: #f9f9f9;
   			padding: 30px;

		}
		.reservation-info .txtBox{
			margin-bottom: 8px;
		}
		.reservation-info .title{
			font-weight: bold;
			margin-right: 25px;
			display: inline-block;
			width: 70px;
		}
		.reservation-info .select-people{
			width: 250px;
		}
		.reservation-info .select-people input[type='text']{
			width: 100px;
		}

		.adult-container {
	      	display: flex;
	      	align-items: center;
	      	margin-bottom: 3px;
	    }
	    .kids-container {
	      	display: flex;
	      	align-items: center;
	    }

	    .adult-title {
	      	margin-right: 10px;
	    }
	    .kids-title {
	      	margin-right: 10px;
	    }

	    .quantity-input {
	      	width: 50px;
	      	text-align: center;
	      	border-color: #eee;
	    }

	    .quantity-btn {
	      	cursor: pointer;
	      	padding: 5px 10px;
	      	font-size: 16px;
	      	background-color: #fff;
	      	height: 40px;
	      	width: 45px;
	    }

	    .stay-fullBox{
	    	margin-top: 50px;
	    }
	    .stay-range{
	    	display: flex;
	    	justify-content: left;
	    	align-items: center;

	    }
	    .calendar-box{
	    	border: 1px solid #eee;
    		padding: 10px 30px;
    	}
    	.calendar-box img{
    		width: 33px;
    	}
		.flat-box{
			display: flex;
		    justify-content: center;
		    width: 370px;
		    padding-left: 27px;
		    align-items: center;
		    border: 1px solid #eee;
		    padding: 9px 50px;
		    border-left: 0;
		}
		.flat-box input{
			margin-left: 55px;
			border:0;
			width: 110px;
		}
		.flat-box span{
			display: inline;
		    width: 120px;
		    text-align: center;
		    border: 1px solid #eee;
		    border-radius: 8px;
		    padding: 3px;
		}
		.total-range{
			margin-left: 60px;
		    padding: 14px 45px;
		    font-size: 20px;
		    background: #eb5d3e;
		    color: #fff;
		    border-radius: 15px;
		}

		.bar{
			margin: 55px 0;
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
		.reserve-btn{
			margin-left: 30px;
			padding: 14px 45px;
			font-size: 20px;
			background: #eb5d3e;
			color: #fff;
			border-radius: 15px;
		}

		.img-list{
			width: 48%;

		}
		.onetime{
			margin-top: 15px;
		    padding-left: 35px;
		    color: #0000ff;
		}
	</style>
	<section class="reservation-fullbox">
		<h1><?=$serviceName?></h1>
		<div class="reservation-info">
			<div class="explain">
				<div class="txtBox">
					<span class="title">주소</span>
					<span><?=$serviceRow['service_address']?></span>
				</div>
				<div class="txtBox">
					<span class="title">연락처</span>
					<span><?=$serviceRow['service_contact']?></span>
				</div>
				<div class="txtBox">
					<span class="title">결제방법</span>
					<span>카드/무통장</span>
				</div>
				<?php 
				if($service_id==4){
				 ?>
				<div class="txtBox">
					<span class="title">대관비용</span>
					<span>1~4시간 5만원, 5시간 이상은 10만원</span>
				</div>
				<?php } ?>
				<div class="txtBox">
					<span class="title">예약날짜</span>
					<span><?=$choice_date?></span>
				</div>
			</div>
			
		</div>

		<div class="stay-fullBox">
			<h1>대관기간</h1>
			<div class="stay-range">
				<div class="calendar-box">
					<img src="./STATIC/img/icon/calendar.png">
				</div>
				<div class="flat-box">
					<span>시작 시간</span>
					<input type="text" id="reservationDates">
				</div>
				<div class="flat-box">
					<span>종료 시간</span>
					<input type="text" id="reservationDates2">
				</div>
				<div>
					<span class="total-range">1시간</span>
				</div>
			</div>
			<p class="onetime">* 18시 이후는 종료시간과 상관없이 한타임으로 적용됩니다.</p>

			<div class="bar"></div>
			<div class="price-box">
				<span>총 결제 금액 : </span>
				<span class="total-price"><?=$initPrice?>원</span>
				<button class="reserve-btn">예약 결제</button>
			</div>
		</div>

		<style type="text/css">
			/*swiper-container {
		      width: 100%;
		      padding-top: 50px;
		      padding-bottom: 50px;
		    }

		    swiper-slide {
		      background-position: center;
		      background-size: cover;
		      width: 300px;
		      height: 300px;
		    }

		    swiper-slide img {
		      display: block;
		      width: 100%;
		    }*/
		    .img-fullBox{
		    	margin-top: 120px;
		    }
		    .swiper-container {
			  width: 700px;
			  height: 600px
			  padding-top: 50px;
			  padding-bottom: 50px;
			  margin: 0 auto;
			}
			.swiper-slide img{
			  width: 700px;
			  height: 600px;
			  margin: 0 auto;
			}

		</style>

		<div class="img-fullBox">
 			<div class="swiper-container">
			  <div class="swiper-wrapper">
			    <!-- Slides -->
			    <?php 
			    while($imgRow = $imgResult->fetch_assoc()){
			     ?>
			    
			    <div class="swiper-slide">
			      	<img src="./STATIC/img/<?=$imgRow['img_url']?>" alt="Image 1">
			    </div>
			<?php } ?>
			    <!-- Add more slides as needed -->
			  </div>
			  <!-- Add Pagination -->
			  <div class="swiper-pagination"></div>
			</div>
		</div>
		<!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script> -->
		
	</section>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script type="text/javascript">
		var swiper = new Swiper('.swiper-container', {
		    pagination: '.swiper-pagination',
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflow: {
                rotate: 20,
                stretch: 0,
                depth: 200,
                modifier: 1,
                slideShadows: true,
            },
            loop: true,
		  });
	</script>

	

	<script type="text/javascript">
		
		const adultCountElement = document.getElementById('adultQuantityInput');
		const kidsCountElement = document.getElementById('kidsQuantityInput');
		var maxNum = parseInt("<?=$serviceMax?>");
		var minNum = parseInt("<?=$serviceMin?>");
		var startTime = "<?=$currentTime?>";
		var endTime = "<?=$nextTime?>";

		var startDate = "<?=$choice_date?>";


		flatpickr("#reservationDates", {
			enableTime: true, // 시간 활성화
		    noCalendar: true, // 달력 비활성화
		    dateFormat: "H:i", // 시간 형식 설정 (24시간)
		    time_24hr: true, // 24시간 형식 사용 
		    defaultDate: ["<?=$currentTime?>"],
		    // 다양한 옵션 추가 가능
		    onChange: function(selectedDates, dateStr, instance) {
		    	// changeRageText(dateStr);
		    	startTime = parseInt(dateStr.split(":")[0]);
		    	if(startTime==18) {
		    		$("#reservationDates2").css("visibility","hidden");
		    	}else{
		    		$("#reservationDates2").css("visibility","visible");
		    	}
		    	changeRageText();
		    	
		    }
		});
		flatpickr("#reservationDates2", {
			enableTime: true, // 시간 활성화
		    noCalendar: true, // 달력 비활성화
		    dateFormat: "H:i", // 시간 형식 설정 (24시간)
		    time_24hr: true, // 24시간 형식 사용 
		    defaultDate: ["<?=$nextTime?>"],
		    // 다양한 옵션 추가 가능
		    onChange: function(selectedDates, dateStr, instance) {
		    	// if(dateStr.includes('~')) changeRageText(dateStr);
		    	endTime = parseInt(dateStr.split(":")[0]);
		    	changeRageText();
		    }
		});

		function changeRageText(){
			console.log(startTime + "/" +endTime);
			if(startTime!=18 && startTime >= endTime) {
				alert("종료시간을 시작시간보다 작거나 같게 설정할 수 없습니다.")
				return false;
			}

			if(startTime==18) {
				$(".total-range").html("6시 이후");
			}else{
				$(".total-range").html((endTime-startTime)+"시간");
			}

		    timeChkgetPrice(startTime,endTime);
		}

		function timeChkgetPrice(start,end){
			timeRange = end - start;
			console.log("<?=$serviceName?>");
			if("<?=$serviceName?>"==="저전나눔터"){
				console.log(timeRange);
				if(timeRange<=4){
					totalPrice = 50000;
				}else{
					totalPrice = 100000;
				}
				if(startTime==18){
					totalPrice = 50000;
					$(".total-price").html(totalPrice.toLocaleString('ko-KR')+"원");
				}else{
					$(".total-price").html(totalPrice.toLocaleString('ko-KR')+"원");
				}

			}else{
				if(start==18){
					timeRange = 1;
				}else if(start<18 && end >=19){
					timeRange = (18-start)+1;
				}

				totalPrice = parseInt("<?=$servicePrice?>") * timeRange;
				if(startTime==18){
					totalPrice = parseInt("<?=$servicePrice?>");
					$(".total-price").html(totalPrice.toLocaleString('ko-KR')+"원");
				}else{
					$(".total-price").html(totalPrice.toLocaleString('ko-KR')+"원");
				}
			}
		}

		$(".reserve-btn").click(function(){
			// location.href = './booking_payment.php?service_id='+"<?=$service_id?>"+"&startDate="+startDate+"&endDate="+endDate;
			console.log($(".total-price").text());
			$.ajax({
	            type: "POST",
	            url: "API/booking_cookie_api.php", // 서버 엔드포인트를 적절히 변경
	            data: {bookingServiceId : "<?=$service_id?>", bookingStartDate:startDate, bookingStartTime : startTime, bookingEndTime:endTime, bookingPrice: $(".total-price").text()},
	            success: function(response) {
	                // 서버로부터 성공 응답을 받았을 때 처리
	                console.log(response);
	                if(response==1){
	                	location.href = './booking_payment.php';
	                }else{
	                  alert('결제페이지에 오류가 있습니다. 관리자에게 문의하세요.');
	                }
	            },
	            error: function(error) {
	                // 서버로부터 오류 응답을 받았을 때 처리
	                console.error("Error:", error);
	            }
	        });
		});

	</script>

	<?php include 'footer.html'; ?>
</body>
</html>