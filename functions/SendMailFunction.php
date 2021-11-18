<?php
include '../includes/Exception.php';
include '../includes/PHPMailer.php';
include '../includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendmailmarc($email,$message){
    
    $mail = new PHPMailer();
    
    try{
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
       
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail-> Port = "587";

        $mail->Username = "testeyd0t1@gmail.com";
        $mail->Password = "Marcuscai96!";
        $mail->Subject = "YOUR OTP IS--";
        $mail->setFrom("tes123teyd0t@gmail.com");
        $mail->Body = $message;
        $mail->addAddress($email);
      
        $mail->send();

        return;
    } 
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
 
function sendmailinform($email,$message){
    $mail = new PHPMailer;
    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail-> Port = "587";

        $mail->Username = "testeyd0t@gmail.com";
        $mail->Password = "Marcuscai96!";
        $mail->Subject = "test111";
        $mail->setFrom("tes123teyd0t@gmail.com");
        $mail->Body = $message;
        $mail->addAddress($email); // send to this email
        $mail->send();
        echo "sucess send";
        return;
    } 
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} 
?> 
