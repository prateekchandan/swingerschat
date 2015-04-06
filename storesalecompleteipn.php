<?php
require ('includes/dbconnect2.php');
?>


<table>
<tr>
<td class="bodytable1">

        
<?php
//Get Option Titles
$result = mysql_query("SELECT * FROM `product_option1`");
$r = mysql_fetch_array($result);
$option1name = strtoupper($r['name']);
$result = mysql_query("SELECT * FROM `product_option2`");
$r = mysql_fetch_array($result);
$option2name = strtoupper($r['name']);
$result = mysql_query("SELECT * FROM `product_option3`");
$r = mysql_fetch_array($result);
$option3name = strtoupper($r['name']);
$result = mysql_query("SELECT * FROM `product_option4`");
$r = mysql_fetch_array($result);
$option4name = strtoupper($r['name']);
	
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

// assign posted variables to local variables
$txn_id = $_POST['txn_id'];
$memberid = $_POST['custom'];

$result5 = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r5 = mysql_fetch_array($result5);
$email = ($r5['email']);
$shippingcountry = ($r5['shippingcountry']);
$shippingaddress = ($r5['shippingaddress']);
$shippingaddress2 = ($r5['shippingaddress2']);
$shippingcity = ($r5['shippingcity']);
$shippingstate= ($r5['shippingstate']);
$shippingzip = ($r5['shippingzip']);

$result = mysql_query("SELECT * FROM `orders` WHERE `txn` = '$txn_id' AND `memberid` = '$memberid'");
$rows = mysql_num_rows($result);
if ($rows < 1) {
	mysql_query("UPDATE `orders` SET `txn`= '$txn_id' WHERE `memberid` = '$memberid' AND `txn` = '0' ");

	mail ("$email", "$sitename - Purchase Complete","Thank you for your purchase! \n\nYou will receive another email as soon as your order is done processing.","From: $adminemail");

	
}

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment

//Complete purchase and mark as paid



mysql_query("UPDATE `orders` SET `paid`= '1' WHERE `txn` = '$txn_id' ");

$result = mysql_query("SELECT * FROM `orders` WHERE `txn` = '$txn_id' AND `memberid` = '$memberid'");
$r = mysql_fetch_array($result);
$orderid = ($r['id']);
$tax = ($r['tax']);
$shipamount = ($r['shipamount']);

$total = 0;
$result1 = mysql_query("SELECT * FROM `ordertable` WHERE `orderid` = '$orderid'");
while ($r1 = mysql_fetch_array($result1)) {
	$id = ($r1['id']);
	$productid = ($r1['productid']);
	$quantity = ($r1['quantity']);
	$ordertax = ($r1['tax']);
	$shippingprice = ($r1['shippingprice']);
	$shippingtype = ($r1['shippingtype']);
	$option1 = ($r1['option1']);
	$option2 = ($r1['option2']);
	$option3 = ($r1['option3']);
	$option4 = ($r1['option4']);

	$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r2 = mysql_fetch_array($result2);
	$qty = ($r2['quantity']);
	$qty = ($qty - $quantity);
	$productname = ($r2['name']);
	$price = ($r2['price']);
	$price2 = ($price * $quantity);
	
	$packagedetails .= "$productname X $quantity \n";
	
	if (($option1 != "")) {
		//Get Option Extra Charges
		$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
		$r7 = mysql_fetch_array($result7);
		$extracharge = ($r7['price']);
		$chargedisplay = "";
		if (($extracharge != "") && ($extracharge != 0)) {
			$chargedisplay .= " - $" . $extracharge . " extra";
			$price2 += ($extracharge * $quantity);
		}
		$packagedetails .= "-" . $option1name . ": " . $option1 . $chargedisplay . "\n";
	}
	if ($option2 != "") {
		//Get Option Extra Charges
		$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
		$r7 = mysql_fetch_array($result7);
		$extracharge = ($r7['price']);
		$chargedisplay = "";
		if (($extracharge != "") && ($extracharge != 0)) {
			$chargedisplay .= " - $" . $extracharge . " extra";
			$price2 += ($extracharge * $quantity);
		}
		$packagedetails .= "-" . $option2name . ": " . $option2 . $chargedisplay . "\n";
	}
	if ($option3 != "") {
		//Get Option Extra Charges
		$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
		$r7 = mysql_fetch_array($result7);
		$extracharge = ($r7['price']);
		$chargedisplay = "";
		if (($extracharge != "") && ($extracharge != 0)) {
			$chargedisplay .= " - $" . $extracharge . " extra";
			$price2 += ($extracharge * $quantity);
		}
		$packagedetails .= "-" . $option3name . ": " . $option3 . $chargedisplay . "\n";
	}
	if ($option4 != "") {
		//Get Option Extra Charges
		$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
		$r7 = mysql_fetch_array($result7);
		$extracharge = ($r7['price']);
		$chargedisplay = "";
		if (($extracharge != "") && ($extracharge != 0)) {
			$chargedisplay .= " - $" . $extracharge . " extra";
			$price2 += ($extracharge * $quantity);
		}
		$packagedetails .= "-" . $option4name . ": " . $option4 . $chargedisplay . "\n";
	}
	
	$price2 = number_format($price2, 2);
	$total += $price2;
	$packagedetails .= "(Price: $$price2) \n\n";
	
	
	$query22 = "DELETE FROM cart WHERE memberid = '".$memberid."'";
	$results22 = mysql_query($query22);

	mysql_query("UPDATE `products` SET `quantity`= '$qty' WHERE `id` = '$productid' ");	
}

$total += $shipamount;
$total += $tax;

mail ("$email", "$sitename - Payment Complete","

Your payment has been received!
You will receive one last email when your order has been shipped.

Here are your order details:

$packagedetails

Shipping: $shipamount
Tax: $tax
Total: $$total

Shipping Address:
$shippingaddress 
$shippingaddress2 
$shippingcity, $shippingstate. $shippingzip

Thank you!

","From: $adminemail");


mail ("$adminemail", "Purchase Complete","
Purchase Complete, 

A new purchase has been completed in your store.

","From: $adminemail");



}
else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
}
}
fclose ($fp);
}
?>
</td>
</tr>
</table>
</body>
</html>

