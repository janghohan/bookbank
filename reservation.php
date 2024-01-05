<?php
include './dbConnect.php';

$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : 1;
$choice_date =  isset($_GET['date']) ? $_GET['date']  : date("Y-m-d");
$nextDate = date("Y-m-d", strtotime($choice_date . ' +1 day'));


$dateArray = explode("-", $choice_date);

$serviceSql = "SELECT * FROM service_list WHERE service_id='$service_id'";
$serviceResult = $conn->query($serviceSql);
$serviceRow = $serviceResult->fetch_assoc();

$serviceName = $serviceRow['service_name'];
$serviceMin = $serviceRow['service_min'];
$serviceMax = $serviceRow['service_max'];
$servicePrice = $serviceRow['service_price'];
$addCost = $serviceRow['service_addcost'];

$imgSql = "SELECT * FROM img_list WHERE service_id='$service_id'";
$imgResult = $conn->query($imgSql);


?>

<!DOCTYPE html>
<html>
<head>
	<meta name="code" charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes"/>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="STATIC/js/common.js"></script>
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
		    width: 465px;
		    padding-left: 27px;
		    align-items: center;
		    border: 1px solid #eee;
		    padding: 9px 50px;
		    border-left: 0;
		}
		.flat-box input{
			margin-left: 55px;
			border:0;
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
			</div>
			<div class="select-people">
				<div class="adult-container">
				  	<div class="adult-title">성인</div>
				  	<button class="quantity-btn" onclick="adultDecrementQuantity()">-</button>
				  	<input type="text" class="quantity-input" value="<?=$serviceMin?>" id="adultQuantityInput" readonly>
				  	<button class="quantity-btn" onclick="adultIncrementQuantity()">+</button>
				</div>
				<div class="kids-container">
				  	<div class="kids-title">아동</div>
				  	<button class="quantity-btn" onclick="kidsDecrementQuantity()">-</button>
				  	<input type="text" class="quantity-input" value="0" id="kidsQuantityInput" readonly>
				  	<button class="quantity-btn" onclick="kidsIncrementQuantity()">+</button>
				</div>
			</div>
		</div>

		<div class="stay-fullBox">
			<h1>숙박기간</h1>
			<div class="stay-range">
				<div class="calendar-box">
					<img src="./STATIC/img/icon/calendar.png">
				</div>
				<div class="flat-box">
					<span>숙박 기간</span>
					<input type="text" id="reservationDates">
				</div>
				<div>
					<span class="total-range">1박</span>
				</div>
			</div>

			<div class="bar"></div>
			<div class="price-box">
				<span>총 결제 금액 : </span>
				<span class="total-price"><?=number_format($servicePrice)?>원</span>
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
		var startDate = "<?=$choice_date?>";
		var endDate = "<?=$nextDate?>";

		flatpickr("#reservationDates", {
			defaultDate: ["<?=$choice_date?>", "<?=$nextDate?>"],
		    mode: "range",
		    dateFormat: "Y-m-d",
		    minDate: "today",
		    locale: "ko", // 오늘 이전의 날짜는 선택할 수 없도록 설정
		    // 다양한 옵션 추가 가능
		    onChange: function(selectedDates, dateStr, instance) {
		    	if(dateStr.includes('~')) changeRageText(dateStr);
		    	
		    }
		});

		function changeRageText(dateRange){
			const dates = dateRange.split(' ~ ');

			startDate = dates[0];
			endDate = dates[1];
			const start = new Date(dates[0]);
		    const end = new Date(dates[1]);

		    // 날짜 차이 계산 (밀리초 단위)
		    const timeDifference = end - start;

		    // 날짜 차이를 일(day) 단위로 변환
		    const nightDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

		    $(".total-range").html(nightDifference+"박");
		    dateChkgetPrice(nightDifference);
		}


		const adultCountElement = document.getElementById('adultQuantityInput');
		const kidsCountElement = document.getElementById('kidsQuantityInput');
		var maxNum = parseInt("<?=$serviceMax?>");
		var minNum = parseInt("<?=$serviceMin?>");
		var basicPrice = parseInt("<?=$servicePrice?>");
		var peoplePrice = 0;
		var datePrice = basicPrice;

	    function adultDecrementQuantity() {
	      let currentCount = parseInt(adultCountElement.value);
	      if (currentCount > 1) {
	        adultCountElement.value = currentCount - 1;
	      }
	    }

	    function adultIncrementQuantity() {
	      let currentCount = parseInt(adultCountElement.value);
	      if(currentCount + parseInt(kidsCountElement.value) < maxNum){
	      	adultCountElement.value = currentCount + 1;
	      }     
	    }

	    function kidsDecrementQuantity() {
	      let currentCount = parseInt(kidsCountElement.value);
	      if (currentCount >= 1) {
	        kidsCountElement.value = currentCount - 1;
	      }
	    }

	    function kidsIncrementQuantity() {
	      let currentCount = parseInt(kidsCountElement.value);
	      if(currentCount + parseInt(adultCountElement.value) < maxNum){
	      	kidsCountElement.value = currentCount + 1;
	      }
	    }


		$(".quantity-btn").click(function (){
			peopleChkgetPrice();
		});


		function peopleChkgetPrice(){
			var adultCount = parseInt($("#adultQuantityInput").val());
			var kidsCount = parseInt($("#kidsQuantityInput").val());

			if(adultCount + kidsCount > minNum) {
				var gapNum = (adultCount+kidsCount) - minNum;
				totalPrice = (gapNum*"<?=$addCost?>");
			}else{
				totalPrice = 0;
			}
			peoplePrice = totalPrice;
			totalPrice = (peoplePrice + datePrice).toLocaleString('ko-KR');
			$(".total-price").html(totalPrice+"원");
		}

		function dateChkgetPrice(dateRange){
			datePrice = dateRange * basicPrice;
			totalPrice = (peoplePrice + datePrice).toLocaleString('ko-KR');
			$(".total-price").html(totalPrice+"원");
		}


		$(".reserve-btn").click(function(){
			// location.href = './booking_payment.php?service_id='+"<?=$service_id?>"+"&startDate="+startDate+"&endDate="+endDate;
			console.log($(".total-price").text());
			$.ajax({
	            type: "POST",
	            url: "API/booking_cookie_api.php", // 서버 엔드포인트를 적절히 변경
	            data: {bookingServiceId : "<?=$service_id?>", bookingStartDate:startDate, bookingEndDate:endDate, bookingAdultNum:$("#adultQuantityInput").val(),bookingKidsNum:$("#kidsQuantityInput").val(), bookingPrice: $(".total-price").text()},
	            success: function(response) {
	                // 서버로부터 성공 응답을 받았을 때 처리
	                console.log(response);
	                if(response==1){
	                	location.href = './booking_payment.php?';
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

		$()
	</script>

	<?php include 'footer.html'; ?>
</body>
</html>