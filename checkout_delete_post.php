<?php
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
redirectIfAdmin();


if (!empty($_GET['id'])){
  // Get Validation
  $error_msg = ""; 
  $del_ok = true;
  $var_id = numValidate($_GET['id'], $error_msg, $del_ok);
  // Get Validation
    if($del_ok){
      echo $var_id;
      deleteItemFromCart($var_id);
      header("Location:checkout.php");
    } else {
      echo $error_msg;
    }

}

?>