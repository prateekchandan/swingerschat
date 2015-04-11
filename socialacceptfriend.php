<?php
require ('includes/dbconnect.php');

$friendshipid = ($_GET['friendshipid']);

mysql_query("UPDATE `friends` SET `status`='1' WHERE `id` = '$friendshipid' ");
header("Location: socialfriends.php");
exit;

?>