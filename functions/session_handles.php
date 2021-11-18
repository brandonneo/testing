<?php 

require_once('zebra_session.php'); 

//Connect to database.
$counter = 0;

$dbcreds = fopen("/etc/passwd-db", "r");
if ($dbcreds) {
	while (($line = fgets($dbcreds)) !== false) {
		// process the line read
		if($counter==0){
			$line=str_replace("\n","",$line);
			$DB_HOST_OR_IP = $line;

		}elseif($counter==1){
			$line=str_replace("\n","",$line);
			$DB_LOGIN_USERNAME = $line;

		}elseif($counter==2){
			$line=str_replace("\n","",$line);
			$DB_LOGIN_PASSWORD = $line;

		}elseif($counter==3){
			$line=str_replace("\n","",$line);
			$DB_DATABASE_NAME = $line;				
		}
		$counter++;
	}

	fclose($dbcreds);
} 

//Connect to Database
$link = mysqli_connect($DB_HOST_OR_IP, $DB_LOGIN_USERNAME, $DB_LOGIN_PASSWORD, $DB_DATABASE_NAME);
if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

$session = new Zebra_Session($link, 'AgGCa22L6MdK', '120');
	//print_r($session->get_settings());
session_regenerate_id(true);
$session->gc()
	//echo  $_SESSION['email'] ;

?>