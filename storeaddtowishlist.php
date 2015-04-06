<?php
require ('includes/dbconnect.php');

//LOGGED IN CHECK
if (!isset($_SESSION['memberloggedin'])) {
	header ('Location: login.php?error=3');
	exit();
}

$memberid = $_SESSION['memberloggedin'];
$productid = ($_GET['productid']);


$sql3="INSERT INTO wishlist (memberid, productid) VALUES('$memberid','$productid')";
if (!mysql_query($sql3,$dbc)) {
	die('Error: ' . mysql_error());
}


header ("Location: wishlist.php");
exit();


ob_end_flush();
?>

