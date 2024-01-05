<?php 
session_start();
include '../dbConnect.php';

$popup_id = isset($_POST['popup_id']) ? $_POST['popup_id'] : '';

$expiration_time = time() +  86400;


$today = date("Y-m-d");
setcookie($popup_id, $today, $expiration_time, "/");

$conn->close();


 ?>