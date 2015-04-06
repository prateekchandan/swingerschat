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
$pagetype = ($r['type']);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);
$membersonly = ($r['membersonly']);

if (isset($_GET['pagetype'])) {
	$pagetype = ($_GET['pagetype']);
}

//MEMBERS ONLY CHECK
$membersonly = 1;
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}

require ('includes/head.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>
<!--Container-->
    <div class="container">

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
require('includes/membersnav.php'); 


$total = 0;
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

//Calculate Promo Code
if ($discount == "shipping") {
	$discountamount = $shipamount;
} else {
	$discountamount = $discount;
}


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
	$option5 = ($r['option5']);
	$quantity = ($r['quantity']);
	$country = ($r['country']);
	$address = ($r['address']);
	$city = ($r['city']);
	$state = ($r['state']);
	$zip = ($r['zip']);
	$promocode = ($r['promocode']);
	$discount = ($r['discount']);
	$promo = ($r['promo']);
	$shippingprice = ($r['shippingprice']);
	$shippingtype = ($r['shippingtype']);
	$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r2 = mysql_fetch_array($result2);
	$price = ($r2['price']);
	$price2 = ($price * $quantity);
	$qty = ($r2['quantity']);
	
	$qty = ($qty - $quantity);
	$category = ($r2['category']);
	$productname = ($r2['name']);
	$ordertax = ($r['ordertax']);
	
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
		$name .= "-" . $option2name . ": " . $option2 . $chargedisplay . "<br />";
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
		$name .= "-" . $option3name . ": " . $option3 . $chargedisplay . "<br />";
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
		$name .= "-" . $option4name . ": " . $option4 . $chargedisplay . "<br />";
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
		$name .= "-" . $option5name . ": " . $option5 . $chargedisplay . "<br />";
	}
	
	$price2 = number_format($price2, 2);
	$total += $price2;
	$packagedetails .= "(Price: $$price2) <br /><br />";
}



echo"
<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"650px\" class='cart'>

<tr>
<td class='blogleft'>Order #:</td>
<td>
$orderid
</td>
</tr>

<tr>
<td class='blogleft'>First Name:</td>
<td>
$first
</td>
</tr>

<tr>
<td class='blogleft'>Last Name:</td>
<td>
$last
</td>
</tr>

<tr>
<td class='blogleft'>Username:</td>
<td>
$username
</td>
</tr>

<tr>
<td class='blogleft'>E-mail:</td>
<td>
$email
</td>
</tr>

<tr>
<td class='blogleft'>Package Details:</td>
<td>
$packagedetails
</td>
</tr>";

if ($discountamount > 0) {
	echo"
	<tr>
	<td class='blogleft'>Promo Discount:</td>
	<td>
	$$discountamount
	</td>
	</tr>";
}

echo"
<tr>
<td class='blogleft'>Shipping Info:</td>
<td>
$country<br />$address<br />$city, $state. $zip
</td>
</tr>

<tr>
<td class='blogleft'>Shipping Type:</td>
<td>
$shiptype
</td>
</tr>

<tr>
<td class='blogleft'>Shipping Price:</td>
<td>
$$shipamount
</td>
</tr>

<tr>
<td class='blogleft'>Tax:</td>
<td>
$$tax
</td>
</tr>";

if ($discountamount > 0) {
	//$discount = ($discount * .01);
	//$discount2 = ($total * $discount);
	$total = ($total - $discountamount);
	$total += $tax;
	$total += $shipamount;
	$total = number_format($total, 2);
	echo"
	<tr>
	<td class='blogleft'>Total Payment:</td>
	<td>
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
	<td class='blogleft'>Total Payment:</td>
	<td>
	$$total
	</td>
	</tr>";
}

echo"

<tr>
<td class='blogleft'>Status:</td>
<td>";
if ($paid == '1') {
	if ($shipped == '0') {
		echo"Preparing to be shipped.";
	} else {
		echo"Item shipped.";
	}	
} else {
	echo"Payment has not cleared.";
}


echo"
</td>
</tr>
</table>";


?>
        
        <div class="clr"></div>
        <div class="spacer"></div>
        
    </div>
    <div class="containerBttm"></div>
   
<div class="clr"></div>
</div>
<?php require('includes/footer.php'); ?>
</body>
</html>

<?php
ob_end_flush();
?>
