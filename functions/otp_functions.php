<?php 
include './connection/db.php'; 


function sendOtp($txtemail, $subject){
	$OTPCODE=rand(9999,99999);
	$subject = "Forget Password OTP Code";
	$message="Your OTP Code:".$OTPCODE;
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: EYD0T  <info@eydot.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

	if (mail($txtemail, $subject, $message,$headers))
		return true;
	else
		return false;

}
?>

