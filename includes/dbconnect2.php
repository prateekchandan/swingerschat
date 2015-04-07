<?php 
/*
$dbhost = "10.6.173.63 ";
$dbuser = "swingerschat";
$dbname = "swingerschat";
$dbpass = "cC1777771@";
*/
$dbhost = "localhost";
$dbuser = "root";
$dbname = "swingerschat";
$dbpass = "9431221178";

$dbc = mysql_connect("$dbhost","$dbuser","$dbpass"); 
if (!$dbc) { 
	die('Could not connect: ' . mysql_error()); 
} 
mysql_select_db("$dbname", $dbc);

$result = mysql_query('SELECT * FROM members WHERE admin = 1');
$r = mysql_fetch_array($result);
$adminemail = ($r['email']);

$baseurl = "http://www.mrwebpage.net/CUSTOM/ChadA/";
$htaccess = $_SERVER['DOCUMENT_ROOT'] .'/CUSTOM/ChadA/.htaccess';

$sitename = "Swingers Chat";

$slidewidth = 624;
$slideheight = 456;

ini_set('memory_limit', '128M');

?>