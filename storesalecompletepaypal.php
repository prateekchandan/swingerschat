<?php
require ('includes/dbconnect.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='text5'>
    <div class='div4'>
<?php
$memberid = ($_SESSION['memberloggedin']);
$promocode = ($_SESSION['promocode']);
$promocode2 = ($_SESSION['promocode2']);
$promocode3 = ($_SESSION['promocode3']);
$ordertax = ($_SESSION['ordertax']);
$shippingprice = ($_SESSION['shippingprice']);
$shippingtype = ($_SESSION['shippingtype']);
$tablename = "member_" . $memberid;


$auth_token = "r6hQVdZ_GDZnfHALzbEXU_3AXnrjmatfQcqA_uhsFj7zAn20L2YgiYoWm7C";


// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];
$req .= "&tx=$tx_token&at=$auth_token";

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
	fputs ($fp, $header . $req);
	// read the body data 
	$res = '';
	$headerdone = false;
	while (!feof($fp)) {
		$line = fgets ($fp, 1024);
		if (strcmp($line, "\r\n") == 0) {
			// read the header
			$headerdone = true;
		} else if ($headerdone) {
			// header has been read. now read the contents
			$res .= $line;
		}
	}

	// parse the data
	$lines = explode("\n", $res);
	$keyarray = array();
	if (strcmp ($lines[0], "SUCCESS") == 0) {
		for ($i=1; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$keyarray[urldecode($key)] = urldecode($val);
		}
		// check the payment_status is Completed
		// check that txn_id has not been previously processed
		// check that receiver_email is your Primary PayPal email
		// check that payment_amount/payment_currency are correct
		// process payment
		$firstname = $keyarray['first_name'];
		$lastname = $keyarray['last_name'];
		$itemname = $keyarray['item_name'];
		$amount = $keyarray['payment_gross'];
		$eml = $keyarray['payer_email'];
		$itemid = $keyarray['item_number'];
		$discount = $keyarray['discount_rate_cart'];


		$active = 0;
?>
		




<?php

$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r = mysql_fetch_array($result);
$email = ($r['email']);
$name = ($r['first']);

echo"<br /><br /><center><strong>Thank you, you have been sent a confirmation e-mail.</strong></center>";

$result5 = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r5 = mysql_fetch_array($result5);
$email = ($r5['email']);
$password = ($r5['password']);
$first = stripslashes($r5['first']);
$last = ($r5['last']);
$shippingcountry = ($r5['shippingcountry']);
$shippingaddress = ($r5['address']);
$shippingaddress2 = ($r5['address2']);
$shippingcity = ($r5['city']);
$shippingstate= ($r5['state']);
$shippingzip = ($r5['zip']);

$date = date('m');
$date .= "/";
$date .= date('d');
$date .= "/";
$date .= date('Y');
$date .= " ";
$date .= date('g');
$date .= ":";
$date .= date('i');
$date .= date('a');

$sql20="INSERT INTO `orders` (memberid, date) VALUES ('$memberid','$date')";

if (!mysql_query($sql20,$dbc)) {
	die('Error: ' . mysql_error());
}

$result = mysql_query("SELECT `id` FROM `orders` ORDER BY `id` DESC");
$r = mysql_fetch_array($result);
$orderid = ($r['id']);
$ordertable = "order_" . $memberid . "_" . $orderid;



$sql50 = "CREATE TABLE $ordertable (id int AUTO_INCREMENT, productid int, country varchar(200), address varchar(200), address2 varchar(200), city varchar(200), state varchar(5), zip int, quantity int, option1 varchar(200), option2 varchar(200), option3 varchar(500), price varchar(100), shippingprice varchar(100), shippingtype varchar(100), ordertax varchar(100), shipped int, promocode varchar(100), discount int, promo varchar(200), PRIMARY KEY (id))";

if (!mysql_query($sql50,$dbc)) {
	die('Error: ' . mysql_error());
}

$result1 = mysql_query("SELECT * FROM `$tablename`");
while ($r1 = mysql_fetch_array($result1)) {
	$id = ($r1['id']);
	$productid = ($r1['productid']);
	$quantity = ($r1['quantity']);
	$option1 = ($r1['option1']);
	$option2 = ($r1['option2']);
	$option3 = ($r1['option3']);
	$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r2 = mysql_fetch_array($result2);
	$price = ($r2['price']);
	$qty = ($r2['quantity']);
	$qty = ($qty - $quantity);
	$category = ($r2['category']);
	$productname = ($r2['name']);
	$packagedetails .= "$productname X $quantity  (Price: $price) \n";
	if ($option1 != "") {
		$packagedetails .= "COLOR: $option1\n";
	}
	if ($option2 != "") {
		$packagedetails .= "SIZE: $option2\n";
	}
	if ($option3 != "") {
		$packagedetails .= "FONT: $option3\n";
	}
	
	mysql_query("UPDATE `products` SET `quantity`= '$qty' WHERE `id` = '$productid' ");

	
	$sql2="INSERT INTO `$ordertable` (productid, country, address, address2, city, state, zip, quantity, option1, option2, option3, price, shippingprice, shippingtype, ordertax, shipped, promocode, discount, promo) VALUES ('$productid','$shippingcountry','$shippingaddress','$shippingaddress2','$shippingcity','$shippingstate','$shippingzip','$quantity','$option1','$option2','$option3','$price','$shippingprice','$shippingtype','$ordertax','0','$promocode3','$promocode','$promocode2')";

	if (!mysql_query($sql2,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	$query22 = "DELETE FROM $tablename WHERE id = '".$id."'";
	$results22 = mysql_query($query22);
	
}

mail ("$email", "Purchase Complete","

Order Confirmation Email
----------------------------------------------------------------------
Following is the information regarding your order purchased on $date

Transaction ID #: $orderid
Package details: 
$packagedetails

Shipping Address:
$shippingaddress
$shippingcity , $shippingstate , $shippingzip

","From: $adminemail");



mail ("$adminemail", "Purchase Complete","
Purchase Complete, 

A new purchase has been completed in your store.

","From: $adminemail");
	

?>



<?php

	} else if (strcmp ($lines[0], "FAIL") == 0) {
	
		echo"<center>The transaction did not go through successfully.<br /> Please <a href=\"storeviewcart.php\">go back</a> and try again. <br />
<br />
Contact us if you continue to have problems. Thank you.<center>";
	}
	
}
	
fclose ($fp);

?>	    

    </div>
    </td>
    </tr>
	</table>
</td>
</tr>
</table>

<?php
require ('includes/footer.php');
?>



</body>
</html>

<?php
ob_end_flush();
?>
