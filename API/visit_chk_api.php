<?php

// 사용자의 IP 주소
$userIP = getClientIP();

// 사용자의 브라우저 정보
$userBrowser = $_SERVER['HTTP_USER_AGENT'];

// 사용자의 운영체제 정보
$userOS = getOS($_SERVER['HTTP_USER_AGENT']);

// 사용자의 디바이스 타입 (모바일, 태블릿, 데스크톱 등)
$userDeviceType = getDeviceType($_SERVER['HTTP_USER_AGENT']);

$today = date("Y-m-d");
$time  = date("H:i:s");

$chkSql = "SELECT * FROM visitor_logs WHERE ip='$userIP' AND browser='$userBrowser' AND os='$userOS' AND device='$userDeviceType' AND visit_date='$today'";
$chkResult = $conn->query($chkSql);

if($chkResult->num_rows <= 0){
    $visitSql = "INSERT INTO visitor_logs(ip,browser,os,device,visit_date,visit_time) VALUES('$userIP','$userBrowser','$userOS','$userDeviceType','$today','$time')";
    $conn->query($visitSql);
}



// 얻은 정보 출력
// echo "IP 주소: $userIP<br>";
// echo "브라우저: $userBrowser<br>";
// echo "운영체제: $userOS<br>";
// echo "디바이스 타입: $userDeviceType";

// 사용자의 운영체제를 얻는 함수
function getOS($userAgent) {
    $osPlatforms = array(
        'Windows' => 'Windows',
        'Linux' => 'Linux',
        'Macintosh' => 'Macintosh',
        'Android' => 'Android',
        'iOS' => 'iOS'
    );

    foreach ($osPlatforms as $osPlatform => $osPattern) {
        if (stripos($userAgent, $osPattern) !== false) {
            return $osPlatform;
        }
    }

    return 'Unknown';
}

// 사용자의 디바이스 타입을 얻는 함수
function getDeviceType($userAgent) {
    $tabletBrowser = strpos($userAgent, 'iPad') || strpos($userAgent, 'Android') && strpos($userAgent, 'Mobile');
    $mobileBrowser = strpos($userAgent, 'Mobile');

    if ($tabletBrowser) {
        return 'Tablet';
    } elseif ($mobileBrowser) {
        return 'Mobile';
    } else {
        return 'Desktop';
    }
}

function getClientIP() {
    $ipAddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    return $ipAddress;
}
?>
