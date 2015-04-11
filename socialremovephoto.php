<?php
require ('includes/dbconnect.php');

$memberid = ($_SESSION['memberloggedin']);
$tablename = "MemberGallery_" . $memberid;
$foldername = "member_" . $memberid;
$filename = ($_GET['filename']);
$photoid = ($_GET['photoid']);

$query = "DELETE FROM $tablename WHERE id = $photoid";
$results = mysql_query($query);
unlink("members/$foldername/$filename");
unlink("members/$foldername/thumbs/$filename");

$newtable = "$tablename" . "_" . $photoid;
$query ="DROP TABLE $newtable";
$results = mysql_query($query);

header("Location: socialgallery.php");
exit;

?>