<?php
require ('includes/dbconnect.php');

$memberid =($_SESSION['memberloggedin']);
$userid = ($_GET['userid']);

$sql="INSERT INTO `friends` (memberid, friendid) VALUES('$memberid','$userid')";
if (!mysql_query($sql,$dbc)) {
	die('Error: ' . mysql_error());
}
/*
$sql="INSERT INTO `friends` (memberid, friendid) VALUES('$userid','$memberid')";
if (!mysql_query($sql,$dbc)) {
	die('Error: ' . mysql_error());
}
*/
header("Location: profile.php?userid=$userid");
exit;

?>