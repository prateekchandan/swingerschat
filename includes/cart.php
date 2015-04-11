<div class="headercart">
<?php
$file = $_SERVER['PHP_SELF'];
$file = explode('/', $file);
$file = $file[count($file) - 1]; 

$subtotal = 0.00;
$items = 0;
if ((isset($_SESSION['memberloggedin'])) && ($file != "logout.php")) {
	$memberid = ($_SESSION['memberloggedin']);
	$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
	while ($r = mysql_fetch_array($result)) {
		$productid = ($r['productid']);
		$quantity = ($r['quantity']);
		$result2 = mysql_query("SELECT price FROM `products` WHERE `id`='$productid'");
		$r2 = mysql_fetch_array($result2);
		$price = ($r2['price']);
		$price = ($price * $quantity);
		$items += $quantity;
		$subtotal += $price;
	}
} else {
	$ip=getenv("REMOTE_ADDR");
	$result = mysql_query("SELECT * FROM `cart` WHERE `ip`='$ip'");
	while ($r = mysql_fetch_array($result)) {
		$productid = ($r['productid']);
		$quantity = ($r['quantity']);
		$result2 = mysql_query("SELECT price FROM `products` WHERE `id`='$productid'");
		$r2 = mysql_fetch_array($result2);
		$price = ($r2['price']);
		$price = ($price * $quantity);
		$items += $quantity;
		$subtotal += $price;
	}
}
$subtotal = number_format($subtotal, 2);
echo"<a href='storeviewcart.php'>$items items $$subtotal</a>";
?>
</div>