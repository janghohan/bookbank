<?php 
session_start();
include '../dbConnect.php';

$expiration_time = time() + (86400 * 30);


$editId = isset($_POST['edit_id']) ? $_POST['edit_id'] : 'wkdgh5430';
$editEmail = isset($_POST['edit_email']) ? $_POST['edit_email'] : 'wkdgh5430';
$editContact = isset($_POST['edit_contact']) ? $_POST['edit_contact'] : 'wkdgh4232';


$sql = "UPDATE user_list SET email='$editEmail', contact='$editContact' WHERE id='$editId'";



if($conn->query($sql)){
    setcookie('login_email', $editEmail, $expiration_time, "/");
    setcookie('login_contact', $editContact, $expiration_time, "/");

    echo 1;
}else{
    echo 0;
}

$conn->close();


 ?>