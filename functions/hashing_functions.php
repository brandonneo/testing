<?php 
function hashCredential($val) { 
	$creds = fopen("/etc/salt", "r");
	$counter = 0;
	if ($creds) {
		while (($line = fgets($creds)) !== false) {
			// process the line read
			if($counter==0){
				$line=str_replace("\n","",$line); 
			}
		}
		fclose($creds);
	} 
	return hash_hmac('sha256', $val, $line);
}

function validifyAgainstHashedCredential($password, $hashed_password) {
	return (hash_equals($password, $hashed_password));
}
?>