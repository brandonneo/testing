<?php
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
redirectIfAdmin();
// validation variables
$var_promo = "";
$error_msg = "";
$checkout_ok = true;

$email= $_SESSION['email'];
$user = getUserID($email);
$var_promo = numValidate($_POST['promo'], $error_msg, $checkout_ok);
$pointToUse = $var_promo;
if ($checkout_ok){
  $totalPoints = getUserPoints($user[0]["userID"]);

  if ($pointToUse <= $totalPoints[0]["points"]){
    $discount = $pointToUse / 10;
  }
  else{
    $discount = 0;
  }
  $_SESSION['disc'] = $discount;
  header("Location:checkout.php");
} else {
  echo $error_msg;
}
?>