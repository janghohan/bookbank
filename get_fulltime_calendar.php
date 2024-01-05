<!-- 시간단위로 예약하는 서비스에 관한 페이지 -->
<style type="text/css">
    
    .reserve_table {
        width: 1440px;
        border-spacing: 0;
        border-top: 1px solid #aaa;
        border-left: 1px solid #aaa;

    }
    .reserve_table td{
        width: 205px;
    }
    .reserve_head{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    h1{
        font-size: 36px;
        text-decoration: underline;
        text-decoration-color: #eb5d3e;
        text-decoration-thickness: 5px;
        text-underline-offset: 10px;
        margin-bottom: 85px;
        text-align: center;
    
    }
    .reserve_head h2{
        font-size: 24px;
    }
    .reserve_head .prev{
        border:1px solid #aaa;
        padding: 8px 15px;
        background: #fff;
        font-size: 16px;
        border-radius: 25px;
    }
    .reserve_head .next{
        border:1px solid #aaa;
        padding: 8px 15px;
        background: #fff;
        font-size: 16px;
        border-radius: 25px;
    }
    .reserve_table thead tr{
        background-color: #f4f4f4;
        height: 60px;
    }
    .reserve_table thead tr th{
        border-bottom: 1px solid #aaa;
    }
    .reserve_table tbody tr{
        border-top: 1px solid #aaa;
    }

    .reserve_table tbody td{
        height: 285px;
        text-align: center;
        position: relative;
        border-right: 1px solid #e7e7e7;
        border-bottom: 1px solid #e7e7e7;
    }
    .reserve_table tbody td.blank{
        height: 150px;
    }

    .reserve_table .dateNum{
        position: absolute;
        top: 0;
        left: 5px;

    }
    .reserve_table .reserve_data{
        text-align: left;
        padding-left: 5px;
        height: 23px;

    }
    .reserve_table .reserve_data .txt{
        color: #888;
        display: inline;
        padding-left: 5px;
    }
    .fullCalendar-fullbox .booked{
        background-color: #eb5d3e;
        color: #fff;
        padding: 2px 3px 2px 2px;
        font-size: 14px;
    }
    .fullCalendar-fullbox .booking{
        background-color: #41A1BE;
        color: #fff;
        padding: 2px 3px 2px 2px;
        font-size: 14px;
    }
    .fullCalendar-fullbox .possible{
        background-color: #5cb85c;
        color: #fff;
        padding: 2px 3px 2px 2px;
        font-size: 14px;
    }
    .fullCalendar-fullbox .explain{
        width: 65px;
        float: right;
        margin-top: 10px;
        text-align: center;
    }
    .fullCalendar-fullbox .explain .possible{
        margin-bottom: 5px;
    }
    .fullCalendar-fullbox .explain .booking{
        margin-bottom: 5px;
    }
</style>

<?php

include './dbConnect.php';
// 현재 년도와 월 가져오기

$serviceId = isset($_GET['service_id']) ? $_GET['service_id'] : 1;
$year = isset($_GET['year']) ? $_GET['year'] : date("Y");
$month = isset($_GET['month']) ? $_GET['month'] : date("m");

$prevMonth = date("Y-m", strtotime("$year-$month-01 -1 month"));
// 다음 월의 날짜 구하기
$nextMonth = date("Y-m", strtotime("$year-$month-01 +1 month"));

// 현재 월의 첫 날과 마지막 날 계산
$firstDay = strtotime("first day of $year-$month");
$lastDay = strtotime("last day of $year-$month");

// 현재 월의 첫 날이 속한 주의 첫 날 계산
$firstDayOfWeek = date("w", $firstDay);

// 이전 달과 다음 달 계산
// $prevMonth = date("m", strtotime("-1 month", $firstDay));
// $nextMonth = date("m", strtotime("+1 month", $firstDay));

$startYearMonth = date("Y-m");
$impossibleMonth = date("Y-m", strtotime($startYearMonth." -1 month")); //예약가능한 달, 현재를 기준으로 다음달은 안된다.

$serviceSql = "SELECT * FROM service_list WHERE service_id='$serviceId'";
$serviceResult = $conn->query($serviceSql);
$serviceRow = $serviceResult->fetch_assoc();

$serviceName = $serviceRow['service_name'];

echo "<h1>".$serviceName."</h1>";

if($prevMonth == $impossibleMonth) {
    echo "<div class='reserve_head'><button class='prev disable' data-date='$prevMonth'>이전</button>";
}else{
    echo "<div class='reserve_head'><button class='prev able' data-date='$prevMonth'>이전</button>";
}
echo "<h2>".$year."년 ".$month." 월"."</h2>";
echo "<button class='next able' data-date='$nextMonth'>다음</button></div>";
echo "<table class='reserve_table' ><thead>";
echo "<tr>";
echo "<th style='color:#ff4141;'>일</th>";
echo "<th>월</th>";
echo "<th>화</th>";
echo "<th>수</th>";
echo "<th>목</th>";
echo "<th>금</th>";
echo "<th style='color:#0c71c0;'>토</th>";
echo "</tr></thead>";

// 첫 주 전에 빈 칸 출력
echo "<tbody><tr>";
for ($i = 0; $i < $firstDayOfWeek; $i++) {
    echo "<td class='blank'></td>";
}



$today = strtotime(date("Y-m-d"));

// 달력 날짜 출력
$currentDay = $firstDay;
while ($currentDay <= $lastDay) {
    $real_date = $year."-".$month."-".date("d", $currentDay);
    $clickDate = strtotime($real_date);

    if($clickDate>=$today){
        if(date('N',$currentDay)==7){
            echo "<td><div class='dateNum' style='color:#ff4141'>".date("d", $currentDay)."</div>";
        }else if(date('N',$currentDay)==6){
            echo "<td><div class='dateNum' style='color:#0c71c0'>".date("d", $currentDay)."</div>";
        }else{
            echo "<td><div class='dateNum'>".date("d", $currentDay)."</div>";
        }
    }else{
        if(date('N',$currentDay)==7){
            echo "<td class='blank'><div class='dateNum' style='color:#ff4141'>".date("d", $currentDay)."</div>";
        }else if(date('N',$currentDay)==6){
            echo "<td class='blank'><div class='dateNum' style='color:#0c71c0'>".date("d", $currentDay)."</div>";
        }else{
            echo "<td class='blank'><div class='dateNum'>".date("d", $currentDay)."</div>";
        }
    }


    $times = array("09:00","10:00", "11:00", "12:00","13:00","14:00","15:00","16:00","17:00","18:00");

    for($i=0; $i<=9; $i++){
        $timeValue = $times[$i];

        $getTimeReserveSql = "SELECT * FROM hourbooked_list WHERE service_id='$serviceId' AND start_date='$real_date' AND start_time<='$timeValue' AND end_time > '$timeValue'";
        $getTimeReserveResult = $conn->query($getTimeReserveSql);
        $reserveCount = $getTimeReserveResult->num_rows; //0이면 해당날짜는 예약이 없는것

         //오늘 이상의 값만 달력에 표기하기 위한 변수
        if($clickDate>=$today){
            if($reserveCount==0){
                echo "<div class='reserve_data'><a href='./reservation_time.php?date=$real_date&time=$timeValue&service_id=$serviceId'><span class='possible'>예</span><span class='txt'>$timeValue</span></div></a>";
            }else{
                $getTimeReserveRow = $getTimeReserveResult->fetch_assoc();
                if($getTimeReserveRow['booked_ok']==1){
                    echo "<div class='reserve_data'><a><span class='booked'>완</span><span class='txt'>$timeValue</span></a></div>";
                }else if($getTimeReserveRow['booked_ok']==0){
                    echo "<div class='reserve_data'><a><span class='booking'>대</span><span class='txt'>$timeValue</span></div></a>";
                }
            }    
        }
        
    }

    echo "</td>";

    // 주의 끝에 도달하면 다음 줄로 이동
    if (date("w", $currentDay) == 6) {
        echo "</tr><tr>";
    }

    // 다음 날로 이동
    $currentDay = strtotime("+1 day", $currentDay);
}

// 나머지 빈 칸 출력
while (date("w", $currentDay) > 0) {
    echo "<td></td>";
    $currentDay = strtotime("+1 day", $currentDay);
}

echo "</tr></tbody>";
echo "</table>";

echo "<div class='explain'><p class='possible'>예약가능</p><p class='booking'>예약대기</p><p class='booked'>예약완료</p></div>";


?>
