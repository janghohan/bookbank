<?php

include './dbConnect.php';

//1일에 시작하는 cron으로 만들 예정

// 전송할 데이터 배열 생성
$realYear = date("Y");

$data = array(
    'solYear' => $realYear,
    'ServiceKey' => 'iZ93kHwpo0%2BZZgQSipDA762exEZqviH5buiM4nZBEl%2FbtJjYvCtRTrDxsv2%2B%2FTnUA6TF1JyFhQB0Gib2OB1YPA%3D%3D',
    '_type' => 'json',
    'numOfRows' =>100
    // 추가 필드가 필요하면 여기에 계속해서 추가하세요
);



// echo date('t');

// $lastDayOfMonth = date('t', strtotime("$targetYear-$targetMonth-01"));

$yearArray = array();
$monthArray = array();


$currentYear = date("Y"); //현재년도
array_push($yearArray, $currentYear);
$currentMonth = date("n"); //현재월


$nextMonth = date('m', strtotime('+1 month'));
if($nextMonth==1) $currentYear += 1;
array_push($yearArray, $currentYear);

$nextNextMonth = date('m', strtotime('+2 months'));
if($nextNextMonth==1) $currentYear += 1;
array_push($yearArray, $currentYear);

array_push($monthArray,$currentMonth);
array_push($monthArray,$nextMonth);
array_push($monthArray,$nextNextMonth);


// echo $nextMonth;
// echo $nextNextMonth;


//3개월만 테스트

for($i=0; $i<count($monthArray); $i++){

    $cMonth = $monthArray[$i];
    $cYear = $yearArray[$i];

    $firstDayOfWeek = date("w", mktime(0, 0, 0, $cMonth, 1, $cYear)); //1일의 요일
    $lastDayOfMonth = date("t", mktime(0, 0, 0, $cMonth, 1, $cYear)); //마지막 날



    for($d=1; $d<=$lastDayOfMonth; $d++){
 
        $formattedNumber = sprintf("%02d", $d);


        $dayOfWeekNumber = getDayOfWeekNumber("$cYear-$cMonth-$formattedNumber");
        $dayOfWeek = date('l', strtotime("$cYear-$cMonth-$formattedNumber")); //요일 영어 알아내는 함수

            
        $real_date = $cYear."-".$cMonth."-".$formattedNumber;

        $week_txt = getKoreanDayOfWeek($dayOfWeekNumber);


        $chk_sql = "SELECT COUNT(*) as count FROM calendar_data WHERE real_date = '$real_date'";
        $result = $conn->query($chk_sql); 
        $row = $result->fetch_assoc();
        $dataCount = $row['count'];


        // 데이터가 있는지 여부 확인
        if ($dataCount > 0) {
            $d = 32;
        } else {
            $day_sql = "INSERT INTO calendar_data(real_date,year_data,month_data,day_data,week_data,week_txt) VALUES('$real_date','$cYear','$cMonth','$formattedNumber','$dayOfWeekNumber','$week_txt')";
    
            $conn->query($day_sql);
        }
    }

}

function getKoreanDayOfWeek($dayNumber) {
    $dayOfWeekMap = array(
        1 => '월요일',
        2 => '화요일',
        3 => '수요일',
        4 => '목요일',
        5 => '금요일',
        6 => '토요일',
        0 => '일요일'
    );

    // 주어진 숫자에 해당하는 한글 요일을 반환합니다
    return isset($dayOfWeekMap[$dayNumber]) ? $dayOfWeekMap[$dayNumber] : '알 수 없음';
}

function getDayOfWeekNumber($dateString) {
    // 입력된 날짜를 기반으로 timestamp 생성
    $timestamp = strtotime($dateString);

    // date 함수를 사용하여 요일을 숫자로 변환 (월요일부터 일요일까지 1부터 7까지)
    $dayOfWeek = date('N', $timestamp);

    // 0부터 6까지의 숫자로 요일을 표현하고 있으므로, 월요일부터 일요일까지의 숫자로 변환
    if ($dayOfWeek == 7) {
        return 0; // 일요일
    } else {
        return $dayOfWeek;
    }
}


//공휴일 등 정보를 받아온다.
for($num=0; $num<count($monthArray); $num++){

    $year = $yearArray[$num];
    $month = $monthArray[$num];

    $key = "iZ93kHwpo0%2BZZgQSipDA762exEZqviH5buiM4nZBEl%2FbtJjYvCtRTrDxsv2%2B%2FTnUA6TF1JyFhQB0Gib2OB1YPA%3D%3D";



    $queryString = "solYear=".$year."&solMonth=".$month."&ServiceKey=".$key."&_type=json&numOfRows=100";

    $url = "http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/getHoliDeInfo?";

    // cURL 초기화
    $ch = curl_init();

    // cURL 옵션 설정
    curl_setopt($ch, CURLOPT_URL, $url.$queryString); // API 엔드포인트 URL 및 쿼리 문자열 설정
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 결과를 문자열로 반환

    // cURL 실행 및 결과 얻기
    $result = curl_exec($ch);

    // cURL 세션 닫기
    curl_close($ch);


    echo $result;
    // $jsonString = json_encode($result);
    // // 결과 출력


    $jsonData = json_decode($result,true);
    $holidayCount = $jsonData['response']['body']['totalCount'];

    echo $holidayCount;

    if($holidayCount==0) {
        continue;
    }else if($holidayCount==1){

        $holidayName = $jsonData["response"]["body"]["items"]['item']['dateName'];
        $holidayDay = $jsonData["response"]["body"]["items"]['item']['locdate'];

        $real_date = getDayInfo($holidayDay); //날짜형식으로 변환

        $update_sql = "UPDATE calendar_data SET isholiday=1,holiday_txt='$holidayName' WHERE real_date='$real_date'";
        $conn->query($update_sql);

    }else{

        for($i=0; $i<$holidayCount; $i++){
            $holidayName = $jsonData["response"]["body"]["items"]['item'][$i]['dateName'];
            $holidayDay = $jsonData["response"]["body"]["items"]['item'][$i]['locdate'];

            $real_date = getDayInfo($holidayDay); //날짜형식으로 변환

            $update_sql = "UPDATE calendar_data SET isholiday=1,holiday_txt='$holidayName' WHERE real_date='$real_date'";
            $conn->query($update_sql);
        }
    }
}


function getDayInfo($dayNumber){

    // 8개의 숫자를 날짜 형식으로 변환
    $year = substr($dayNumber, 0, 4);
    $month = substr($dayNumber, 4, 2);
    $day = substr($dayNumber, 6, 2);

    // 날짜 문자열 생성
    return $dateString = "$year-$month-$day";
}

?>
