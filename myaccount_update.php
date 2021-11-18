<?php
include('./functions/session_handles.php');
include('./functions/session_functions.php');
include('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
redirectIfAdmin();

if (!empty($_POST['email'])){
  echo $_SESSION['email'];
  echo $_POST['email'];
  $data = updateUserEmail($_SESSION['email'], $_POST['email']);
  if($data != -1){
    insertDetailsIntoSession($data[0]["userID"], getIsAdminById($data[0]["userID"]));
}
}else if (!empty($_POST['curr_pass']) && !empty($_POST['pass'])){
  $data = updateUserPassword($_SESSION['email'], hashCredential($_POST['curr_pass']), hashCredential($_POST['pass']));

} 
else {
  $data = 0;
  //header("Location:myaccount.php");
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
            if($data >= 1){
            echo '<section class="py-5" style="background-color: #8caf9f"><div class="jumbotron-fluid pt-5 pb-5">
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Successful Account Update</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>
                    </div></section';
            } else {
                echo '<section class="py-5" style="background-color: #ab8a90"><div class="jumbotron-fluid pt-5 pb-5" >
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Unsuccessful Account Update</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>

                    <p class="lead text-center">Account Invalid</b></p>
                    </div></section>';
            }
            ?>
        </body>
        <?php include "homepage/footer-inc.php"; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        </html>