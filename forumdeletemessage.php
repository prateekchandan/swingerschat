<?php
require ('includes/dbconnect.php');

$tablename = ($_GET['tablename']);
$messageid = ($_GET['messageid']);
$categoryid = ($_GET['categoryid']);
$postid = ($_GET['postid']);


$query = "DELETE FROM $tablename WHERE id = $messageid";
$results = mysql_query($query);

header("Location: forum3.php?categoryid=$categoryid&postid=$postid");
exit;

?>