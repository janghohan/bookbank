<?php 

include './dbConnect.php';

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$today = $_GET['today'];
$service_id = $_GET['service_id'];




// $year =  date('Y');
// 	// GET으로 넘겨 받은 month값이 있다면 넘겨 받은걸 month변수에 적용하고 없다면 현재 월
// $month =  date('m');


// $date = "$year-$month-01"; // 01 일
// $time = strtotime($date); // 현재 날짜의 타임스탬프
// $start_week = date('w', $time); // 1. 시작 요일
// $total_day = date('t', $time); // 2. 현재 달의 총 날짜
// $total_week = ceil(($total_day + $start_week) / 7);  // 3. 현재 달의 총 주차


// // w = 6 : 토, 0 : 일
// $today = "2023-11-09";
// $ttime = strtotime($today);
// $t_week = date('w',$ttime);

// echo $t_week;


// for ($i = 1; $i <= $total_day; $i++){
// 	$day = "2023-11-".sprintf('%02d', $i);
// 	$dtime = strtotime($day);
// 	$dweek = date('w',$dtime);

// 	echo $day."/".$dweek."</br>";

// 	$sql = "INSERT INTO reserve_date(real_date,room_ix,week_num,user_ix,name,user_phone) VALUES('$day','','$dweek','','','')";
// 	mysqli_query($con,$sql);
// }


 ?>


 <script type="text/javascript">	
	function dateAddDel(sDate, nNum, type) {
		var yy = parseInt(sDate.substr(0, 4), 10);
		var mm = parseInt(sDate.substr(5, 2), 10);
		var dd = parseInt(sDate.substr(8), 10);
		
		if (type == "d") {
			d = new Date(yy, mm - 1, dd + nNum);
		}
		else if (type == "m") {
			d = new Date(yy, mm - 1, dd + (nNum * 31));
		}
		else if (type == "y") {
			d = new Date(yy + nNum, mm - 1, dd);
		}
	 
		yy = d.getFullYear();
		mm = d.getMonth() + 1; mm = (mm < 10) ? '0' + mm : mm;
		dd = d.getDate(); dd = (dd < 10) ? '0' + dd : dd;
	 
		return '' + yy + '-' +  mm  + '-' + dd;
	}

	
	function replaceAll(str, searchStr, replaceStr) {
	  return str.split(searchStr).join(replaceStr);
	}
</script>
<style>
	.price_box{float:left; width:100%; background:#fff; text-align:center; border-bottom: 1px solid #dbdbdb; line-height:1.2;}
	.roomname{float:left; width:15%; padding-top:18px; height:100%;}
	.person{padding-top:10px;}
    	.price_day_box{float:right; width:100%;}
		.price_day {width:100%; border-right: 1px solid #dbdbdb;}
	.price_day li{float:left; width:14%; border-left: 1px solid #dbdbdb; padding:6px 0; height: 84px;}
	.price_day li p{padding:2px 0;}

	.price_day li .y1 {}
	.price_day li .y2 {}
	.price_day li .y3 + .y3 {padding-bottom:7px;}
	.price_day li .y3 del {font-size:.9em;}
	.reser_button {line-height: 4.4em}

	.reser_button .bt1{padding:4px 10px; background:#f4516c; color:#fff}
	.reser_button .bt2{background:#444; color:#fff}
	.reser_button .bt3{background:#444; color:#fff}

	.table {border-top: 2px solid #222;}
	.b1 {border-top: 2px solid #EB5D3E;}
	.t1 {}
	ul.top_cal {padding-bottom: 15px;}
	ul.top_cal li {float: left; margin: 0 5px; padding:10px 30px; border: 1px solid #dbdbdb; background: #fff;}
</style>

<div class="price_box b1 clearfix">
    <div class="price_day_box">
		<ul class="price_day clearfix">
			<?php 	

			$sql = "SELECT * FROM calendar_data WHERE real_date>='$today' LIMIT 7";
			$result = $conn->query($sql);

			while($row = $result->fetch_assoc()){

				$day = $row['real_date'];
				$daydivide = explode("-", $day);
				$day = $daydivide[1]."/".$daydivide[2];



				switch ( $row['week_data'] ) {
				  case 1:
				    $weekday = "(월)";
				    $textcolor = "#000";
				    $weektext = "월요일";
				  case 2:
				    $weekday = "(화)";
				    $textcolor = "#000";
				    $weektext = "화요일";
				    break;
				  case 3:
				  	$weekday = "(수)";
				  	$textcolor = "#000";
				  	$weektext = "수요일";
				  case 4:
				  	$weekday = "(목)";
				  	$textcolor = "#000";
				  	$weektext = "목요일";
				  	break;
				  case 5:
				  	$weekday = "(금)";
				  	$weektext = "금요일";
				  	break;
				  case 6:
				  	$weekday = "(토)";
				  	$weektext = "토요일";
				  	$textcolor = "#4b95ff";
				  	break;
				  case 0:
				  	$weekday = "(일)";
				  	$textcolor = "#f4516c";
				  	break;
				  default:
				    $weekday = "";
				    $weektext = "주중";
				}
			 ?>
        	<li style="color:<?=$textcolor?>">
				<p class="y1"><?=$weekday?></p>
			    <p class="y1"><?=$day?></p>
			    <p class="y2"><?=$weektext?></p>
			</li>
		<?php }?>

           
        </ul>
	</div>
</div>
<div class="price_box clearfix">
    <div class="price_day_box">
		<ul class="price_day clearfix">
			<?php 	

			$sql = "SELECT * FROM calendar_data WHERE real_date>='$today' LIMIT 7";
			$result = $conn->query($sql);

			while($row = $result->fetch_assoc()){

				$booked_date = $row['real_date'];
				$chk_sql = "SELECT booked_list.booked_ok FROM booked_list JOIN service_list ON service_list.service_id = booked_list.service_id AND booked_list.start_date='$booked_date' AND service_list.service_id ='$service_id' AND booked_list.service_id='$service_id'";
				$chkresult = $conn->query($chk_sql);

				$chkrow = $chkresult->fetch_assoc();
        		$booked = $chkrow['booked_ok'];

				if($booked==2){
			?>
    		<li>	        				
				<div style="line-height:4.4em;color:#979797">예약 완료</div>
			</li>
			<?php 
				}else{
			 ?>
    		<li>
				<div class="reser_button">
					<a class="bt1" href="./reservation.php?date=<?=$booked_date?>&service_id=<?=$service_id?>" target="_blank">예약 가능
					</a>
				</div>		
			</li>
			<?php }} ?>
    	</ul>
	</div>
</div> 

<?php 



 ?>