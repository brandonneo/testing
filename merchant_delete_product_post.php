<?php
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
redirectIfNotAdmin();

if (!empty($_GET['id'])){
  // Get Validation
  $error_msg = ""; 
  $del_ok = true;
  $var_id = numValidate($_GET['id'], $error_msg, $del_ok);
  // Get Validation
    if($del_ok){
      deleteProduct($_SESSION['email'], $var_id);
      $_SESSION['message'] = "Product Deleted";
      header("Location:merchant_product.php");
    } else {
      echo $error_msg;
    }

} else {
  header("Location:merchant_product.php");
}

?>