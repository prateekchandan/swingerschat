<?php
require ('includes/dbconnect.php');

$memberid = ($_GET['memberid']);
$tablename = ($_GET['tablename']);
$commentid = ($_GET['commentid']);

$query = "DELETE FROM $tablename WHERE id = $commentid";
$results = mysql_query($query);

header("Location: socialprofilecomments.php?memberid=$memberid");
exit;

?>