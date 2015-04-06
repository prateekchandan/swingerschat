<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
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
$result = mysql_query("SELECT * FROM `product_option5`");
$r = mysql_fetch_array($result);
$option5name = strtoupper($r['name']);
?>

<?php
$orderid = ($_GET['orderid']);
$result = mysql_query("SELECT * FROM `orders` WHERE `id` = $orderid");
$r = mysql_fetch_array($result);
$memberid = ($r['memberid']);
$date = ($r['date']);
$shipped = ($r['shipped']);
$paid = ($r['paid']);
$shipamount = ($r['shipamount']);
$shiptype = ($r['shiptype']);
$tax = ($r['tax']);
$discount = ($r['promo1']);

$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r = mysql_fetch_array($result);
$first = ($r['first']);
$last = ($r['last']);
$username = ($r['username']);
$email = ($r['email']);
$phone = ($r['phone']);

$result = mysql_query("SELECT * FROM `ordertable` WHERE `orderid` = '$orderid'");
while ($r = mysql_fetch_array($result)) {
	$id = ($r['id']);
	$productid = ($r['productid']);
	$option1 = ($r['option1']);
	$option2 = ($r['option2']);
	$option3 = ($r['option3']);
	$quantity = ($r['quantity']);
	$country = ($r['country']);
	$address = ($r['address']);
	$address2 = ($r['address2']);
	$city = ($r['city']);
	$state = ($r['state']);
	$zip = ($r['zip']);
	$price = ($r['price']);
	$promocode = ($r['promocode']);
	$discount = ($r['discount']);
	$promo = ($r['promo']);
	$shippingprice = ($r['shippingprice']);
	$shippingtype = ($r['shippingtype']);
	$ordertax = ($r['ordertax']);
	$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r2 = mysql_fetch_array($result2);
	$price = ($r2['price']);
	$price2 = ($price * $quantity);
	
	$qty = ($r2['quantity']);
	$qty = ($qty - $quantity);
	$category = ($r2['category']);
	$productname = ($r2['name']);
	
	$packagedetails .= "$productname X $quantity <br />";
	
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
		$packagedetails .= "-" . $option1name . ": " . $option1 . $chargedisplay . "<br />";
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
		$packagedetails .= "-" . $option2name . ": " . $option2 . $chargedisplay . "<br />";
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
		$packagedetails .= "-" . $option3name . ": " . $option3 . $chargedisplay . "<br />";
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
		$packagedetails .= "-" . $option4name . ": " . $option4 . $chargedisplay . "<br />";
	}
	if ($option5 != "") {
		//Get Option Extra Charges
		$result7 = mysql_query("SELECT * FROM `product_option5_list` WHERE `name`='$option5'");
		$r7 = mysql_fetch_array($result7);
		$extracharge = ($r7['price']);
		$chargedisplay = "";
		if (($extracharge != "") && ($extracharge != 0)) {
			$chargedisplay .= " - $" . $extracharge . " extra";
			$price2 += ($extracharge * $quantity);
		}
		$packagedetails .= "-" . $option5name . ": " . $option5 . $chargedisplay . "<br />";
	}
	
	$price2 = number_format($price2, 2);
	$total += $price2;
	$packagedetails .= "(Price: $$price2) <br /><br />";
	
}

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"
<tr>
<td class=\"editpageleft\">Username:</td>
<td class=\"editpageright\">";
echo"$username";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Name:</td>
<td class=\"editpageright\">";
echo"$first $last";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">E-mail:</td>
<td class=\"editpageright\">";
echo"$email";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Phone:</td>
<td class=\"editpageright\">";
echo"$phone";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Order Details:</td>
<td class=\"editpageright\">";
echo"$packagedetails";
echo"</td><td class=\"editpagehints\">
</td></tr>";



if ($discount > 0) {
	echo"
	<tr>
	<td class='editpageleft'>Promo Discount:</td>
	<td class=\"editpageright\">
	$discount%
	</td>
	</tr>";
}



echo"
<tr>
<td class=\"editpageleft\">Shipping Info:</td>
<td class=\"editpageright\">";
echo"$country<br />$address<br />$address2<br />$city, $state. $zip";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping Type:</td>
<td class=\"editpageright\">";
echo"$shiptype ";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping Price:</td>
<td class=\"editpageright\">";
echo"$$shipamount ";
echo"</td><td class=\"editpagehints\">
</td></tr>";



echo"
<tr>
<td class=\"editpageleft\">Tax Paid:</td>
<td class=\"editpageright\">";
echo"$$tax ";
echo"</td><td class=\"editpagehints\">
</td></tr>";

if ($discount > 0) {
	$discount = ($discount * .01);
	$discount2 = ($total * $discount);
	$total = ($total - $discount2);
	$total += $tax;
	$total += $shipamount;
	$total = number_format($total, 2);
	echo"
	<tr>
	<td class='editpageleft'>Total Payment:</td>
	<td class=\"editpageright\">
	$$total
	</td>
	</tr>";
} else {
	$total = ($total - $discount2);
	$total += $tax;
	$total += $shipamount;
	$total = number_format($total, 2);
	echo"
	<tr>
	<td class='editpageleft'>Total Payment:</td>
	<td class=\"editpageright\">
	$$total
	</td>
	</tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Status:</td>
<td class=\"editpageright\">";
if ($shipped == '0') {
	echo"<a href=\"shipped.php?orderid=$orderid&email=$email\">Click here when item's have been shipped.</a>";
} else {
	echo"Item Shipped.";
}
echo"</td><td class=\"editpagehints\">
</td></tr>";


echo"
<tr>
<td></td>
<td align='left'>";
echo"<a href='store.php'><-- Go Back.</a>";
echo"</td><td>
</td></tr>";

echo"
</table>";


?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




