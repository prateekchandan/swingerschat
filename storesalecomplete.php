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




/** DoDirectPayment NVP example; last modified 08MAY23.
 *
 *  Process a credit card payment. 
*/

$environment = 'live';	// or 'beta-sandbox' or 'live'

/**
 * Send HTTP POST Request
 *
 * @param	string	The API method name
 * @param	string	The POST Message fields in &name=value pair format
 * @return	array	Parsed HTTP Response body
 */
function PPHttpPost($methodName_, $nvpStr_) {
	global $environment;

	// Set up your API credentials, PayPal end point, and API version.
	$API_UserName = urlencode('support_api1.supercrystals.net');
	$API_Password = urlencode('S5CVNJWR2NESNR6R');
	$API_Signature = urlencode('Aua5HbEVRnY0CWc.6IIXM9hyCmLhAXJvK9veEUuk7dHt.AVczFhQ2-jS');
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	if("sandbox" === $environment || "beta-sandbox" === $environment) {
		$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
	}
	$version = urlencode('51.0');

	// Set the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	// Turn off the server and peer verification (TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);

	// Set the API operation, version, and API signature in the request.
	$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

	// Set the request as a POST FIELD for curl.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

	// Get response from the server.
	$httpResponse = curl_exec($ch);

	if(!$httpResponse) {
		exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
	}

	// Extract the response details.
	$httpResponseAr = explode("&", $httpResponse);

	$httpParsedResponseAr = array();
	foreach ($httpResponseAr as $i => $value) {
		$tmpAr = explode("=", $value);
		if(sizeof($tmpAr) > 1) {
			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		}
	}

	if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
		exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
	}

	return $httpParsedResponseAr;
}

// Set request-specific fields.
$paymentType = urlencode('Sale');				// or 'Sale'
$firstName = urlencode($_POST['first']);
$lastName = urlencode($_POST['last']);
$creditCardType = urlencode($_POST['type']);
$creditCardNumber = urlencode($_POST['number']);
$expDateMonth = ($_POST['expmonth']);
// Month must be padded with leading zero
$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));

$expDateYear = urlencode($_POST['expyear']);
$cvv2Number = urlencode($_POST['cvv']);
$address1 = urlencode($_POST['address']);
$address2 = urlencode($_POST['address2']);
$city = urlencode($_POST['city']);
$state = urlencode($_POST['state']);
$zip = urlencode($_POST['zip']);
$country = urlencode('US');				// US or other valid country code
$amount = urlencode($_POST['total']);
$currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')


// Add request-specific fields to the request string.
$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
			"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
			"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";

// Execute the API operation; see the PPHttpPost function above.
$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);

if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {


$memberid = ($_SESSION['memberloggedin']);
$promocode = ($_SESSION['promocode']);
$promocode2 = ($_SESSION['promocode2']);
$promocode3 = ($_SESSION['promocode3']);
$ordertax = ($_SESSION['ordertax']);
$shippingprice = ($_SESSION['shippingprice']);
$shippingtype = ($_SESSION['shippingtype']);
$tablename = "member_" . $memberid;

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



$sql50 = "CREATE TABLE $ordertable (id int AUTO_INCREMENT, productid int, country varchar(200), address varchar(200), address2 varchar(200), city varchar(200), state varchar(5), zip int, quantity int, option1 varchar(200), option2 varchar(200), price varchar(100), shippingprice varchar(100), shippingtype varchar(100), ordertax varchar(100), shipped int, promocode varchar(100), discount int, promo varchar(200), PRIMARY KEY (id))";

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
	
	mysql_query("UPDATE `products` SET `quantity`= '$qty' WHERE `id` = '$productid' ");

	
	$sql2="INSERT INTO `$ordertable` (productid, country, address, address2, city, state, zip, quantity, option1, option2, price, shippingprice, shippingtype, ordertax, shipped, promocode, discount, promo) VALUES ('$productid','$shippingcountry','$shippingaddress','$shippingaddress2','$shippingcity','$shippingstate','$shippingzip','$quantity','$option1','$option2','$price','$shippingprice','$shippingtype','$ordertax','0','$promocode3','$promocode','$promocode2')";

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

<!-- Google Code for Water Crystal Purchase Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1061085287;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "6F50CJW_xQEQ58D7-QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1061085287/?label=6F50CJW_xQEQ58D7-QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<?php

} else {

	echo"<center>The transaction did not go through successfully.<br /> Please <a href=\"storeviewcart.php\">go back</a> and try again. <br />
<br />
Contact us if you continue to have problems. Thank you.<center>";
}
	


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
