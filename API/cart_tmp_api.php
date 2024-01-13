<?php
include '../dbConnect.php';

$user_ix = isset($_COOKIE['user_ix']) ? $_COOKIE['user_ix'] : 0;

if (isset($_POST['checkTrem']) && is_array($_POST['checkTrem'])) {

	$is_ok = true;

    foreach ($_POST['checkTrem'] as $selectedOption) {
        $sql = "INSERT INTO tmp_order (user_ix,book_ix,quantity) SELECT user_ix,book_ix,quantity FROM cart WHERE cart.cart_ix='$selectedOption'";
        if($conn->query($sql)){

        }else{
        	$is_ok = false;
        }
        // $aa = $selectedOption;
    }

    if($is_ok){
    	$data = json_encode(array(
	        'resultCode' => 1
	    ));
    }else{
    	$data = json_encode(array(
	        'resultCode' => 0
	    ));
    }
    
} else {
    $data = json_encode(array(
        'resultCode' => -1
    ));
}



echo $data;

$conn->close();


?>
