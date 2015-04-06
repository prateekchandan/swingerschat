<?php
require ('includes/dbconnect.php');

$commentid = ($_GET['commentid']);

$query = "DELETE FROM `messages` WHERE id = $commentid";
$results = mysql_query($query);

header("Location: socialmessages.php");
exit;

?>