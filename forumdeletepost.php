<?php
require ('includes/dbconnect.php');

$tablename = ($_GET['tablename']);
$messageid = ($_GET['messageid']);
$categoryid = ($_GET['categoryid']);

$tablename2 = $tablename . "_" . $messageid;

$query = "DELETE FROM $tablename WHERE id = $messageid";
$results = mysql_query($query);

$query ="DROP TABLE $tablename2";
$results = mysql_query($query);

header("Location: forum2.php?categoryid=$categoryid");
exit;

?>