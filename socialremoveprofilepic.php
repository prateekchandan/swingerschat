<?php
require ('includes/dbconnect.php');

$memberid =($_SESSION['memberloggedin']);

$foldername = ($_GET['foldername']);
$photo = ($_GET['photo']);

mysql_query("UPDATE `members` SET `photo`='noimage.jpg' WHERE `id` = '$memberid' ");
unlink("members/$foldername/$photo");
unlink("members/$foldername/thumbs/$photo");

header("Location: membersedit.php");
exit;

?>