<?php
require ('includes/dbconnect.php');

$ip=getenv("REMOTE_ADDR");
if (isset($_GET['productid'])) {
	$productid = ($_GET['productid']);
} else {
	$productid = ($_POST['productid']);	
}
$option1 = ($_POST['option1']);
$option2 = ($_POST['option2']);
$option3 = ($_POST['option3']);


if ((!isset($_SESSION['memberloggedin'])) && (!isset($_SESSION['guestloggedin']))) {
	$result1 = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
	$rows1 = mysql_num_rows($result1);
	if ($rows1 > 0) {
		$result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip' AND `productid` = '$productid' AND `option1` = '$option1' AND `option2` = '$option2' AND `option3` = '$option3'");
		$rows = mysql_num_rows($result);
		$r = mysql_fetch_array($result);
		$id = ($r['id']);
		$quantity = ($r['quantity']);
		$quantity += 1;
		
		$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
		$r = mysql_fetch_array($result);
		$qty = ($r['quantity']);
		
		if ($quantity > $qty) {
			$quantity = $qty;
			$message = 1;
		}
		
		if ($rows > 0) {
			$sql1="UPDATE `cart` SET `quantity` = '$quantity' WHERE `id` = '$id' ";
			$result=mysql_query($sql1);
		} else {
		
			$sql3="INSERT INTO cart (ip, productid, quantity, option1, option2, option3) VALUES('$ip','$productid','1','$option1','$option2','$option3')";
			if (!mysql_query($sql3,$dbc)) {
				die('Error: ' . mysql_error());
			}
		}
	} else {
		$sql3="INSERT INTO cart (ip, productid, quantity, option1, option2, option3) VALUES('$ip','$productid','1','$option1','$option2','$option3')";
		if (!mysql_query($sql3,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
} else {
	if (isset($_SESSION['memberloggedin'])) {
		$memberid = ($_SESSION['memberloggedin']);
	} else if (isset($_SESSION['guestloggedin'])) {
		$memberid = ($_SESSION['guestloggedin']);
	}
	
	$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid' AND `productid` = '$productid' AND `option1` = '$option1' AND `option2` = '$option2' AND `option3` = '$option3'");
	$rows = mysql_num_rows($result);
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
	$quantity = ($r['quantity']);
	$quantity += 1;
	
	$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r = mysql_fetch_array($result);
	$qty = ($r['quantity']);
	
	if ($quantity > $qty) {
		$quantity = $qty;
		$message = 1;
	}
	
	if ($rows > 0) {
		$sql1="UPDATE `cart` SET `quantity` = '$quantity' WHERE `id` = '$id' ";
		$result=mysql_query($sql1);
	} else {
		$sql3="INSERT INTO `cart` (memberid, productid, quantity, option1, option2, option3) VALUES ('$memberid','$productid','1','$option1','$option2','$option3')";
		if (!mysql_query($sql3,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
}


header ("Location: storeviewcart.php?message=$message");
exit();


ob_end_flush();
?>

