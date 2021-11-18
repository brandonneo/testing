<?php
include './functions/SendMailFunction.php';
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');



   
    if (!empty($_POST["fullname"]) && !empty($_POST["email"])  && !empty($_POST["content"])){ 

        // @@@@@@@  Start Main Validation Code
    	$name = $email = $subject = $content = "";
    	$error_msg = "";
    	$contact_ok = true;
        
        // name validation
      //  $name = usernameValidate($_POST["fullname"],$error_msg,$contact_ok);
        // echo $contact_ok ? 'true1' : 'false1';

        // email validation
    	//$email = emailValidate($_POST["email"],$error_msg,$contact_ok);
      $email = $_POST["email"];
        // content validation
        //$content = alphaNumSpecValidate($_POST["content"], $error_msg, $contact_ok);
      $content =$_POST["content"];
        $subject = "Query from ".$name." - ".$email;
        // @@@@@@@  End Main Validation Code

        echo "We have recieved ur message! Have a nice day";
}

  

?>
