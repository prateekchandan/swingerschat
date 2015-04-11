<?php
//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
    header('Location: login.php');
    exit();
}
$memberid = ($_SESSION['memberloggedin']);

//FIND OUT IF APPROVED & ACCOUNT COMPLETED IN SETUP PGASE
$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid' ");
$r = mysql_fetch_array($result);
$membersetup = ($r['setup']);
$memberapproved = ($r['approved']);

if (($membersetup == 0) || ($memberapproved == 0)) {
	header('Location: members.php');
	exit();
}
?>