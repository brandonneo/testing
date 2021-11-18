<?php 
include '../connection/db.php'; 
include './SendMailFunction.php';
include './hashing_functions.php';

if(@$_POST["fp"]=="forgetpassord")
{
  $return_arr = array();
  $txtemail=$_POST["txtemail"];
  $sel=mysqli_query($link,"SELECT * from User where  userEmail='$txtemail'");
  $num=mysqli_num_rows($sel);
  if ($num>0) {

   $OTPCODE=rand(99999,999999); // random generator for OTP
   $subject = "Forget Password OTP Code";
   $message="Your OTP Code:".$OTPCODE;
   $headers =  'MIME-Version: 1.0' . "\r\n"; 
   $headers .= 'From: EYD0T  <info@eydot.com>' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
   if(mail($txtemail,$subject, $message,$headers)) // if statement
   {
    $queryupdate="UPDATE User set otp_code='$OTPCODE' where userEmail='$txtemail'"; // create query
    $exquery=mysqli_query($link,$queryupdate); // update DB
    $return_arr[] = array("recordexist" =>"SendEmail"); // this is for ajax
    sendmailmarc($txtemail,$message); // This sends the message to the txtmail input


  }
  else
  {
    $return_arr[] = array("recordexist" =>"MailCannot");
  }
}
else{
  $return_arr[] = array("recordexist" =>"NotFound");
}
echo json_encode($return_arr);
}

if(@$_POST["cp"]=="changepassord")
{
  $return_arr = array();
  $txtotp=$_POST["txtotp"];
  $txtnewpassword=$_POST["txtnewpassword"];
  $txtnewpassword=hashCredential($txtnewpassword);
  
  $txtemail=$_POST["txtemail"];
  $sel=mysqli_query($link,"SELECT * from User where  otp_code='$txtotp'");
  $num=mysqli_num_rows($sel);
  
  if ($num>0) 
  {
   $queryupdate="UPDATE User set Password='$txtnewpassword' where userEmail='$txtemail'";
   $exquery=mysqli_query($link,$queryupdate);
   $return_arr[] = array("recordexist" =>"UpdatePassword");
 }
 else
 {
   $return_arr[] = array("recordexist" =>"NotFound");
 }
 echo json_encode($return_arr);
}  
?> 