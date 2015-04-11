<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require ('includes/dbconnect2.php');
$productid = ($_GET['productid']);
$optionvalue = ($_GET['optionvalue']);


$result = mysql_query("SELECT * FROM `product_option1_list` WHERE `name` = '$optionvalue'");
$r = mysql_fetch_array($result);
$optionid = ($r['id']);

$result = mysql_query("SELECT * FROM `product_option1_pics` WHERE `productid` = '$productid' AND `optionid`='$optionid'");
$r = mysql_fetch_array($result);
$pic = ($r['pic']);
			
if ($pic != "") {
        echo"<a href=\"productpics/$pic\" class=\"highslide\" onclick=\"return hs.expand(this)\" style='z-index:8000;'><img src='productpics/$pic' width='200px' style='z-index:8000;' /></a>"; 
} else {
        echo"<img src='productpics/noimage.jpg' width='200px' height='200px' />";
}
?>

