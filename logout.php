<?php 
include('./functions/session_handles.php'); 
include('./functions/database_functions.php');

unset($_SESSION['email']);
unset($_SESSION['is_admin']);
$session->stop();
$session->destroy($session_id);
header('Location: index.php');
?>