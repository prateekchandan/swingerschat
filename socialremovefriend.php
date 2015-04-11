<?php
require ('includes/dbconnect.php');

$friendshipid = ($_GET['friendshipid']);

$query = "DELETE FROM `friends` WHERE `id` = '$friendshipid'";
$results = mysql_query($query);

header("Location: socialfriends.php");
exit;

?>