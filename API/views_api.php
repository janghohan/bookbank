<?php 
include '../dbConnect.php';


$notice_id = isset($_POST['notice_id']) ? $_POST['notice_id'] : '';


$sql = "UPDATE notice_list SET notice_views = notice_views + 1 WHERE notice_id='$notice_id'";

if ($conn->query($sql)) {
    echo 200;
} else {
    echo 100;
}



$conn->close();


 ?>