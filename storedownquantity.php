<?php
require ('includes/dbconnect.php');

$ip=getenv("REMOTE_ADDR");
$productid = ($_GET['productid']);
$url = ($_GET['url']);
$tablename = ($_GET['tablename']);
$cartid = ($_GET['cartid']);
$quantity = ($_GET['quantity']);
$quantity -= 1;
$memberid = ($_SESSION['memberloggedin']);

if (!isset($_SESSION['memberloggedin'])) {
	if ($quantity < 1) {
		$query = "DELETE FROM `cart` WHERE `id` = '$cartid' AND `productid` = '$productid'";
		$results = mysql_query($query);
	} else {
		$sql1="UPDATE `cart` SET `quantity` = '$quantity' WHERE `id` = '$cartid' AND `productid` = '$productid'";
		$result=mysql_query($sql1);
	}
} else {
	if ($quantity < 1) {
		$query = "DELETE FROM `cart` WHERE `id` = '$cartid'";
		$results = mysql_query($query);
	} else {
		$sql1="UPDATE `cart` SET `quantity` = '$quantity' WHERE `memberid`='$memberid' AND `id` = '$cartid' ";
		$result=mysql_query($sql1);
	}
}


header("Location: $url");
exit;

ob_end_flush();
?>

