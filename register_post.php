<?php
require_once('./functions/session_handles.php');
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');

// validation variables
$uname = $email = $pw = "";
$error_msg = "";
$reg_ok = true;

if(!empty($_POST["name"]) || !empty($_POST["email"]) || !empty($_POST["pw"])){ // else register attempt
    // start sendnin OTP
    
        //username validation
    $uname = usernameValidate($_POST["name"],$error_msg,$reg_ok);

        //code block for email validation
    $email = emailValidate($_POST["email"],$error_msg,$reg_ok);

        //code block for password validation
    $pw = passRegValidate($_POST["pw"],$_POST["repw"],$error_msg,$reg_ok);

        // @@@@@@@  End Main Validation Code
// @@@@@@@  Start Main Database Code

        if($reg_ok){ // check if input validation is passed, then attempt to access db.
            $signup_results= signupWithEmailAndPassword($uname, $email, $pw);
            
        }else {
            $_POST["reg_ok"] = 'another value';
        }
        // @@@@@@@  End Main Database Code
    }
    
    ?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>EYD0T</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" /> 

        <body>
            <?php  include "homepage/header-inc-2.php"; ?>
            <?php
            if($reg_ok){
            echo '<div class="jumbotron-fluid pt-5 pb-5">
            <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Successful Registration</h2>
            <div class="row"> 
            <hr class="my-2 col-10">
            </div>
            <p class="lead text-center">Login Now</b></p>
            </div>';
            } else {
                echo '<div class="jumbotron-fluid pt-5 pb-5">
            <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Registration Failed</h2>
            <div class="row"> 
            <hr class="my-2 col-10">
            </div>

            <p class="lead text-center">Registration Invalid, Erros Occurred<br>' . $error_msg . '</b></p>
            </div>';
            }
            ?>
        </body>
        <?php include "homepage/footer-inc.php"; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        </html>
