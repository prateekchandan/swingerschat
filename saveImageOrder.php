<?php
require ('../includes/dbconnect2.php');

define('DB_HOST', "$dbhost");
define('DB_NAME', "$dbname");
define('DB_USER', "$dbuser");
define('DB_PASS', "$dbpass");  

class database {
	var $connection;
	
	function database() {
		$this->connection = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
		mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());
	}

	
}
$db = new database;
session_start();
$gallerytable = $_SESSION['gallerytable'];
parse_str($_POST['data']);

for ($i = 0; $i < count($sortlist); $i++) {
	$sql = mysql_query("UPDATE `$gallerytable` SET `picorder` = '$i' WHERE `id` = '$sortlist[$i]'") or die(mysql_error());
	if ($sql) print 'Updating order went well'.$i;
}
sleep(1);
?>
