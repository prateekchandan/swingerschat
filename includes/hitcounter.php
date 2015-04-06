<?php
$ref = getenv('HTTP_REFERER');
$day = date('l');

$tablename = "HitCounter_" . $pageid;
$tablename2 = "HitCounterRef_" . $pageid;
$result = mysql_query("SELECT * FROM $tablename");
$r = mysql_fetch_array($result);
$today = ($r['today']);
$hits_today = ($r['hits_today']);
$hitcount = ($r['totalhits']);
$hitcount += 1;

if ($today == $day) {
	$hits_today += 1;
	
} else {
	$hits_today = 1;
	$today = $day;
}
	
$result = mysql_query("SELECT * FROM `$tablename2` WHERE `referrer` = '$ref'");
$rows = mysql_num_rows($result);

if ($rows > 0) {
	$r = mysql_fetch_array($result);
	$refhits = ($r['totalhits']);
	$refhits += 1;
	$query2 = mysql_query("UPDATE `$tablename2` SET `totalhits` = '$refhits' WHERE `referrer` = '$ref' ");
} else {

	$sql="INSERT INTO $tablename2 (referrer,totalhits) VALUES ('$ref','1')"; 
	if (!mysql_query($sql,$dbc)) {
 		die('Error: ' . mysql_error());
	}
}
	
$query1 = mysql_query("UPDATE `$tablename` SET `totalhits` ='$hitcount' , `hits_today` = '$hits_today' , `today` = '$day' ");
?>