<?php
require ('includes/dbconnect.php');

$photoid = ($_GET['photoid']);
$tablename = ($_GET['tablename']);
$newtable = ($_GET['newtable']);
$filename = ($_GET['filename']);
$foldername = ($_GET['foldername']);
$caption = ($_GET['caption']);
$memberid = ($_GET['memberid']);
$commentid = ($_GET['commentid']);

$query = "DELETE FROM $newtable WHERE id = $commentid";
$results = mysql_query($query);

header("Location: socialpiccomments.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid");
exit;

?>