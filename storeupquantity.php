<?php
require ('includes/dbconnect.php');

$ip=getenv("REMOTE_ADDR");
$productid = ($_GET['productid']);
$url = ($_GET['url']);
$tablename = ($_GET['tablename']);
$cartid = ($_GET['cartid']);
$quantity = ($_GET['quantity']);
$quantity += 1;
$memberid = ($_SESSION['memberloggedin']);

$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
$r = mysql_fetch_array($result);
$qty = ($r['quantity']);

if ($quantity > $qty) {
	$quantity = $qty;
	$message = 1;
}

if (!isset($_SESSION['memberloggedin'])) {	
	$sql1="UPDATE `cart` SET `quantity` = '$quantity' WHERE `id` = '$cartid' AND `productid` = '$productid'";
	$result=mysql_query($sql1);
} else {
	$sql1="UPDATE `cart` SET `quantity` = '$quantity' WHERE `memberid`='$memberid' AND `id` = '$cartid' ";
	$result=mysql_query($sql1);
}

header ("Location: $url?message=$message");
exit();

ob_end_flush();
?>

