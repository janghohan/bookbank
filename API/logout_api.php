<?php 
$cookies = $_COOKIE;

foreach ($cookies as $cookie_name => $cookie_value) {
    setcookie($cookie_name, "", time() - 3600, "/");
}


echo "<script> location.href='../';</script>";


 ?>