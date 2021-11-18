<?php
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
redirectIfNotAdmin();

if (!empty($_GET['id'])){
    // Get Validation
    $error_msg = ""; 
    $del_ok = true;
    $var_id = numValidate($_GET['id'], $error_msg, $del_ok);
    // Get Validation
    if($del_ok){
      deleteUser($_SESSION['email'],$var_id);
      header("Location:merchant_user.php");
    } else {
      echo $error_msg;
    }

} else {
  header("Location:merchant_user.php");
}

?>