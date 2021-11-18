<?php
require_once('./functions/session_handles.php');
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');

// validation variables
$email = $pw = "";
$error_msg = "";
$log_ok = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["loginemail"]) || !empty($_POST["loginPassword"])){ // if login attempt

        // @@@@@@@  Start Main Validation Code
    	$email = $pw = "";
    	$error_msg = "";
    	$log_ok = true;

        //code block for email validation
    	$email = emailValidate($_POST["loginemail"],$error_msg,$log_ok);

        //code block for password validation
    	$pw = passLogValidate($_POST["loginPassword"],$error_msg,$log_ok);

        // @@@@@@@  End Main Validation Code
 		// @@@@@@@  Start Main Database Code

            if($log_ok){ // check if input validation is passed, then attempt to access db.
               	
            	$login_result = loginWithEmailAndPassword($email, $pw);
                //direct to merchant index page if user is admin
            	if (getIsAdmin($email) == 1){
            		header("Location:merchant_index.php");
            	}
            	else{
            		header("Location:index.php");
            	}
            }
        // @@@@@@@  End Main Database Code

        }}
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
                if ($log_ok) {
                    echo '<div class="jumbotron-fluid pt-5 pb-5">
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Login Successful</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>

                    <p class="lead text-center">Welcome <b> '. $_POST['loginemail'] .'</b></p>
                    </div>';
                } else {
                    echo '<div class="jumbotron-fluid pt-5 pb-5">
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Login Failed</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>

                    <p class="lead text-center">Hey there the entered <b>Email or Password is invalid.  </b></p>
                    </div>';
                }
                ?>

                <?php include "homepage/footer-inc.php"; ?>

                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
                <script src="js/scripts.js"></script>

            </body>
            </html>
        ?>