<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require ('includes/dbconnect2.php');


$catid = ($_GET['catid']);

$resultCity = mysql_query("SELECT * FROM `citydb` where state='$catid' group by city order by city");
	while ($rCity = mysql_fetch_array($resultCity)) {
	$nameCity = ($rCity['city']);
	echo"<option value='$nameCity' "; if ($catid == $nameCity) { echo"selected"; } echo">$nameCity</option>";
}
?>
 