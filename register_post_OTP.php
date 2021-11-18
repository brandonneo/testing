<?php
// include './functions/SendMailFunction.php';
include './connection/db.php';
include('./functions/session_handles.php'); 
include('./functions/database_functions.php');

if(!empty($_POST["OTPinput"])){
echo 'hi';
echo $_POST["OTPinput"];
        $data = getUserOtp($_SESSION['email']);
            echo $data[0]["otp_code"];
            echo 'hi';
  
}



?>
