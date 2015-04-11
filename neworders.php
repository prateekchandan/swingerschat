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
	$option4 = ($r['option4']);
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
	$price2 = number_format($price2, 2);
	$total += $price2;
	$qty = ($r2['quantity']);
	$qty = ($qty - $quantity);
	$category = ($r2['category']);
	$productname = ($r2['name']);
	$packagedetails .= "$productname X $quantity  (Price: $$price) <br />";
	if ($option1 != "") {
		$packagedetails .= "COLOR: $option1 <br />";
	}
	if ($option2 != "") {
		$packagedetails .= "SIZE: $option2 <br />";
	}
	if ($option3 != "") {
		$packagedetails .= "FONT: $option3 <br />";
	}
	if ($option4 != "") {
		$packagedetails .= "INK COLOR: $option4 <br />";
	}
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
if ($paid == '1') {
	if ($shipped == '0') {
		echo"<a href=\"shipped.php?orderid=$orderid&email=$email\">Click here when item's have been shipped.</a>";
	} else {
		echo"Item shipped.";
	}	
} else {
	echo"Payment has not cleared.";
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




