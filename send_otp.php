<?php
include('./functions/session_handles.php');
include('./functions/session_functions.php');
include('./functions/database_functions.php');
include('./functions/otp_functions.php');

if (!empty($_POST['email'])){
  $data = checkUserEmail($_POST['email']);
  if ($data ==1){
    //send otp
  }
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
        
            <section class="py-5" style="background-color: #d9c99b"><div class="jumbotron-fluid pt-5 pb-5">
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Email OTP</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>
                    <p class="lead text-center">If you are a verified customer, you will receive an otp to your email.</b></p>
                    </div></section
            
            
        </body>
        <?php include "homepage/footer-inc.php"; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        </html>