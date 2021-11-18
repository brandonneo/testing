<?php 
function insertDetailsIntoSession($user_email, $admin) {
	if (session_id() != "") {
		$_SESSION['email'] = $user_email; 
		$_SESSION['is_admin'] = $admin;
		$_SESSION['last_activity'] = time();
		$_SESSION['expire_time'] = 43200;
		$_SESSION['profile_pic'] = rand(1,3);
	return;
}}

function redirectIfNotAdmin() {
  if (!isset($_SESSION['is_admin'])) {
    header('Location: index.php');
  } else {
    if ($_SESSION['is_admin'] == 0) {
      header('Location: index.php');
    }
  }
}

function redirectIfAdmin() {
  if (isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] == 1) {
      header('Location: merchant_index.php');
    }
  }
}
?>