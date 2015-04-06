<?php
require ('includes/dbconnect.php');

$id = ($_GET['id']);
$url = ($_GET['url']);

if (isset($_SESSION['memberloggedin'])) {
	$memberid = ($_SESSION['memberloggedin']);
	$query = "DELETE FROM `cart` WHERE `id` = '$id'";
	$results = mysql_query($query);
} else {
	$query = "DELETE FROM `cart` WHERE `id` = '$id'";
	$results = mysql_query($query);
}

header ("Location: $url");
exit();

ob_end_flush();
?>

