<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require ('includes/dbconnect2.php');


$catid = ($_GET['catid']);

$resultState = mysql_query("SELECT * FROM `citydb` where country='$catid' group by state order by state");
while ($rState = mysql_fetch_array($resultState)) {
	$nameState = ($rState['state']);
	echo"<option value='$nameState' "; if ($catid == $nameState) { echo"selected"; } echo">$nameState</option>";
} 
?>
 