<?php
//시간단위로 예약하는 서비스에 관한 페이지
include './dbConnect.php';

$serviceId = isset($_GET['service_id']) ? $_GET['service_id'] : 1;


$today = date('Y-m-d');
$fourDaysAgo = date('Y-m-d', strtotime('-4 days'));	

$year = date("Y");
$month = date("m");

$serviceSql = "SELECT * FROM service_list WHERE service_id='$serviceId'";
$serviceResult = $conn->query($serviceSql);
$serviceRow = $serviceResult->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="code" charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes"/>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="STATIC/js/common.js"></script>
	<script type="text/javascript" src="STATIC/js/swiper-bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="STATIC/css/swiper-bundle.min.css"/>
	<link rel="stylesheet" type="text/css" href="STATIC/css/style.css"/>
</head>
<body>
	<?php include 'header.html'; ?>	

	<img src="./STATIC/img/icon/newham.png" id="ham-button">
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
		.fullCalendar-fullbox{
			margin: 0 auto;
			margin-top: 150px;
			overflow: hidden;
			margin-bottom: 50px;
			max-width: 1440px;
		}
		
	</style>
	
	<section class="fullCalendar-fullbox">


		
	</section>

	<script type="text/javascript">
		getFullCalendar("<?=$year?>","<?=$month?>");
		
		function getFullCalendar(year,month){
			$.ajax({
				type: "GET",
				url: "./get_fulltime_calendar.php?service_id="+"<?=$serviceId?>"+"&year="+year+"&month="+month,
				//url: "http://foreverps.net/contents/room_all_date_info_xml.php?start_date="+startDate+"&end_date="+endDate+"&today="+today,
				cache: false,
				success: function(obj){
				    // console.log(obj);
					$('.fullCalendar-fullbox').html(obj).hide().fadeIn();
				},
				
				error: function(xhr, status,error) {
					console.log(error);
				}
			});
		}


		$(document).on('click', '.reserve_head button.able',function() {
			console.log('btn');
			var wantDate = $(this).attr('data-date');
			const resultArray = wantDate.split("-");
			getFullCalendar(resultArray[0],resultArray[1]);

		});
	</script>

	<?php include 'footer.html'; ?>
</body>
</html>