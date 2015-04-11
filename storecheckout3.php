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
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" style='width:100%; margin:0px 13px 0px 13px;'>
    <tr>
	<td class='text1'>
    <?php require ('includes/search.php'); ?>
    </td>
    
    <td class='text2'>
    <div class='div6'>
    	<table align='left' cellpadding="0px" cellspacing="2px" border="0px" width="750px" class='cart'>
    	<tr>
        <td colspan="6" class='storebreadcrumbs' align="left">
        <a href='storecheckout.php'>Edit Personal Info</a> - <a href='storecheckout22.php'>Edit Shipping Info</a> - Review Your Order
        </td>
        </tr>
        
        <tr>
        <td align="left" valign="top" width="5%" class='cartheaders'>
        </td>
        <td align="left" valign="top" width="55%" class='cartheaders'>
        ITEM
        </td>
        <td align="right" valign="top" class='cartheaders'>
        </td>
        <td align="right" valign="top" class='cartheaders'>
        QTY
        </td>
        <td align="right" valign="top" width="15%" class='cartheaders'>
        PRICE
        </td>
        <td align="right" valign="top" width="15%" class='cartheaders'>
        SUB
        </td>
        </tr>
        
        <?php
		//Get Shipping Prices
		function USPSParcelRate($service, $ounces, $shippingzip, $postagetype) {  
		
		 
		// This script was written by Mark Sanborn at http://www.marksanborn.net  
		// If this script benefits you are your business please consider a donation  
		// You can donate at http://www.marksanborn.net/donate.    
		
		// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========  
		
		$userName = '235SUPER6761'; // Your USPS Username  
		$orig_zip = '78124'; // Zipcode you are shipping FROM  
		 
		// =============== DON'T CHANGE BELOW THIS LINE ===============  
		 
		$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";  
		$ch = curl_init();  
		 
		// set the target url  
		curl_setopt($ch, CURLOPT_URL,$url);  
		curl_setopt($ch, CURLOPT_HEADER, 1);  
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
		 
		// parameters to post  
		curl_setopt($ch, CURLOPT_POST, 1);  
		
		
		$shippingarea = "RATEV3RESPONSE";
		$rate = "RATE";
		$data = "API=RateV3&XML=<RateV3Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>$service</Service><FirstClassMailType>PARCEL</FirstClassMailType><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$shippingzip</ZipDestination><Pounds>0</Pounds><Ounces>$ounces</Ounces><Size>REGULAR</Size><Machinable>False</Machinable></Package></RateV3Request>";  
		
		
		 
		// send the POST values to USPS  
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);  
		 
		$result=curl_exec ($ch);  
		$data = strstr($result, '<?');  
		// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments  
		$xml_parser = xml_parser_create();  
		xml_parse_into_struct($xml_parser, $data, $vals, $index);  
		xml_parser_free($xml_parser);  
		$params = array();  
		$level = array();  
		foreach ($vals as $xml_elem) {  
			if ($xml_elem['type'] == 'open') {  
				if (array_key_exists('attributes',$xml_elem)) {  
					list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);  
				} else {  
				$level[$xml_elem['level']] = $xml_elem['tag'];  
				}  
			}  
			if ($xml_elem['type'] == 'complete') {  
			$start_level = 1;  
			$php_stmt = '$params';  
			while($start_level < $xml_elem['level']) {  
				$php_stmt .= '[$level['.$start_level.']]';  
				$start_level++;  
			}  
			$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';  
			eval($php_stmt);  
			}  
		}  
		curl_close($ch);  
		//echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags  
		return $params["$shippingarea"]['1ST']["$postagetype"]["$rate"];  
		}  
		//End USPS SHIPPING

		$url = $_SERVER['PHP_SELF'];
		
		$ccnumber = ($_SESSION['ccnumber']);
		$cctype = ($_SESSION['cctype']);
		$ccexpirationmonth = ($_SESSION['ccexpirationmonth']);
		$ccexpirationyear = ($_SESSION['ccexpirationyear']);
		$cccvv = ($_SESSION['cccvv']);
		
		$totalounces = 0;
		$memberid = ($_SESSION['memberloggedin']);
		$tablename = "member_" . $memberid;
		$result = mysql_query("SELECT * FROM `$tablename`");
		while ($r = mysql_fetch_array($result)) {
			$cartid = ($r['id']);
			$productid = ($r['productid']);
			$quantity = ($r['quantity']);
			$option1 = ($r['option1']);
			$option2 = ($r['option2']);
			$option3 = ($r['option3']);
			$option4 = ($r['option4']);
		
			
			$result2 = mysql_query('SELECT * FROM products WHERE id = "'.$productid.'"');
			$r2 = mysql_fetch_array($result2);
			$category = ($r2['category']);
			$name = ($r2['name']);
			$price = ($r2['price']);
			if ($option2 == "2X Large (add $2.00)") {
			$price += 2;	
		}
		if ($option2 == "3X Large (add $2.00)") {
			$price += 2;	
		}
		if ($option2 == "4X Large (add $2.00)") {
			$price += 2;	
		}
		if ($option2 == "5X Large (add $2.00)") {
			$price += 2;	
		}
			$ounces = ($r2['ounces']);
			$price2 = ($price * $quantity);
			$price = number_format($price, 2);
			$price2 = number_format($price2, 2);
			$total += $price2;
			$totalounces += ($ounces * $quantity);
			
			$packagedetails .= "$name X $quantity, ";
			?>
			<tr>
			<td align="center" valign="top" class="cartitem"><?php echo"<a href=\"storeremovefromcart.php?id=$cartid&url=$url\"><img src=\"mrweb/images/trashcan.jpg\" /></a>"; ?></td>
			<td align="left" valign="middle" class="cartitem">
            <?php 
			echo"$name"; 
			if (($option1 != "")) {
				echo"<br /><div class='viewcartoptions'>COLOR: $option1</div>";
			}
			if ($option2 != "") {
				echo"<br /><div class='viewcartoptions'>SIZE: $option2</div>";
			}
			if ($option3 != "") {
				echo"<br /><div class='viewcartoptions'>FONT: $option3</div>";
			}
			if ($option4 != "") {
				echo"<br /><div class='viewcartoptions'>INK COLOR: $option4</div>";
			}
			?>
			</td>
			<td align="left" valign="top" class="cartitem">
				<table align="right"  cellpadding="0" cellspacing="0" border="0">
				<tr>
				<td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storeupquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/plus.jpg" /></a></td>
				<td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storedownquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/minus.jpg" /></a></td>
				</tr>
				</table>
			</td>
			<td align="right" valign="middle" class="cartitem"><?php echo"$quantity"; ?></td>
			<td align="right" valign="middle" class="cartitem"><?php echo"$$price"; ?></td>
			<td align="right" valign="middle" class="cartitem"><?php echo"$$price2"; ?></td>
			</tr>
		<?php
		}
		$total = number_format($total, 2);
		$result5 = mysql_query('SELECT * FROM members WHERE id = "'.$memberid.'"');
		$r5 = mysql_fetch_array($result5);
		$first = stripslashes($r5['first']);
		$last = ($r5['last']);
		$billingcountry = ($r5['country']);
		$address = ($r5['address']);
		$address2 = ($r5['address2']);
		$city = ($r5['city']);
		$state= ($r5['state']);
		$zip = ($r5['zip']);
		$shippingcountry = ($r5['shippingcountry']);
		$shippingaddress = ($r5['shippingaddress']);
		$shippingaddress2 = ($r5['shippingaddress2']);
		$shippingcity = ($r5['shippingcity']);
		$shippingstate= ($r5['shippingstate']);
		$shippingzip = ($r5['shippingzip']);
		
		//Calculate Promo Code

		 if (isset($_SESSION['promocode'])) {
			$discount = ($_SESSION['promocode']);
			$discount2 = ($discount * .01);
			$discountamount = ($total * $discount2);
			$total -= $discountamount;
			$total = number_format($total, 2);
			$discountamount = number_format($discountamount, 2);
		} 

		
		// Calculate Tax
		$tax = 0;
		if (($shippingstate == 'TX') || ($shippingstate == 'texas') || ($shippingstate == 'Texas')) {
			$tax = ($total * .0825);
			$tax = round($tax, 2);
			$total = ($total + $tax);
			$tax = number_format($tax, 2);
			$total = number_format($total, 2);
		}
		$_SESSION['ordertax'] = "$tax";
		
		//Calculate Shipping
		$shippingtype = ($_SESSION['shippingtype']);
		if ($totalounces < 13) {
			if ($shippingtype == "FIRST CLASS") {
				$postagetype = 0;
			}
			if ($shippingtype == "PRIORITY") {
				$postagetype = 1;
			}
		} else {
			$shippingtype = "PRIORITY";
			$postagetype = 1;
		}
		$_SESSION['shippingtype'] = "$shippingtype";
		
		$totalounces += 1;
		$shippingprice = USPSParcelRate($shippingtype, $totalounces, $shippingzip, $postagetype);
		if (($shippingprice > 4.95) && ($totalounces < 35)) {
			$shippingprice = 4.95;
		}
		if (($shippingprice > 10.70) && ($totalounces < 165)) {
			$shippingprice = 10.70;
		}
		if (($shippingprice > 14.50) && ($totalounces < 245)) {
			$shippingprice = 14.50;
		}
		if ($totalounces > 320) {
			$shippingprice = 0;
		}
		
		$total += $shippingprice;
		$total = number_format($total, 2);
		
		$shippingprice = number_format($shippingprice, 2);
		$_SESSION['shippingprice'] = "$shippingprice";
		
		
		
		//Create Order
		$tablename = "member_" . $memberid;
		
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
		
		$result5 = mysql_query("SELECT * FROM `orders` WHERE `memberid` = '$memberid' AND `txn` = '0'");
		$r5 = mysql_fetch_array($result5);
		$rows5 = mysql_num_rows($result5);
		if ($rows5 > 0) {
			$orderid = ($r5['id']);
			$query = "DELETE FROM `orders` WHERE id = $orderid";
			$results = mysql_query($query);
			$query = "DELETE FROM `ordertable` WHERE orderid = $orderid";
			$results = mysql_query($query);
		}
		
		$sql20="INSERT INTO `orders` (memberid, date, shipped, paid, txn, tax, shipamount, shiptype) VALUES ('$memberid','$date','0','0','0','$tax','$shippingprice','$shippingtype')";
		if (!mysql_query($sql20,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		$result5 = mysql_query("SELECT * FROM `orders` WHERE `memberid` = '$memberid' ORDER BY `id` DESC");
		$r5 = mysql_fetch_array($result5);
		$orderid = ($r5['id']);
		
		$result1 = mysql_query("SELECT * FROM `$tablename`");
		while ($r1 = mysql_fetch_array($result1)) {
			$id = ($r1['id']);
			$productid = ($r1['productid']);
			$quantity = ($r1['quantity']);
			$option1 = ($r1['option1']);
			$option2 = ($r1['option2']);
			$option3 = ($r1['option3']);
			$option4 = ($r1['option4']);
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
			if ($option2 != "") {
				$packagedetails .= "INK COLOR: $option4\n";
			}
			
			//mysql_query("UPDATE `products` SET `quantity`= '$qty' WHERE `id` = '$productid' ");
		
			
			$sql2="INSERT INTO `ordertable` (productid, country, address, address2, city, state, zip, quantity, option1, option2, option3, option4, price, promocode, discount, promo, orderid) VALUES ('$productid','$shippingcountry','$shippingaddress','$shippingaddress2','$shippingcity','$shippingstate','$shippingzip','$quantity','$option1','$option2','$option3','$option4','$price','$promocode3','$promocode','$promocode2','$orderid')";
		
			if (!mysql_query($sql2,$dbc)) {
				die('Error: ' . mysql_error());
			}
			
			//$query22 = "DELETE FROM $tablename WHERE id = '".$id."'";
			//$results22 = mysql_query($query22);
			
		}
		?>
		?>
     	
        <tr>
        <td colspan="6" align="right" valign="top" class="cartitem"><br /></td>
		</tr>
        
        <?php
		/*
        
        <tr>
        <td colspan="2" align="right" valign="top"></td>
        <td align="right" valign="top" colspan='3'><?php if (isset($_SESSION['promocode'])) { echo"DISCOUNT:"; } else { echo"PROMO CODE:"; } ?></td>
        <td align="right" valign="top" class="cartitem">
		<?php
		 if (isset($_SESSION['promocode'])) {
			echo"$$discountamount";
		} else {
			echo"<form action='storeenterpromo.php' method='post'>";
			echo"<input type='text' name='promo' size='15' />";
			echo"<input type='image' src='http://www.supercrystals.net/images/addcode.png' border='0' name='submit' alt='ADD CODE'>";
			echo"</form>";
		}	
		 ?>
        </td>
		</tr>
		*/
		?>
        
        
        <tr>
        <td colspan="4" align="right" valign="top"></td>
        <td align="right" valign="top">TAX:</td>
        <td align="right" valign="top" class="cartitem"><?php echo"$$tax"; ?></td>
		</tr>
        <tr>
        <td colspan="4" align="right" valign="top"></td>
        <td align="right" valign="top">SHIPPING:</td>
        <td align="right" valign="top" class="cartitem"><?php if ($shippingprice == "0") { echo"FREE!"; } else { echo"$$shippingprice"; } ?></td>
		</tr>
        
        
        
        
        <tr>
        <td colspan="4" align="right" valign="top"></td>
        <td align="right" valign="top">TOTAL:</td>
        <td align="right" valign="top" class="cartitem"><?php echo"$$total"; ?></td>
		</tr>
        
       
        
        <tr>
        <td colspan="6" align="right" valign="top"><br /></td>
		</tr>
        <tr>
        <td colspan="6" align="right" valign="top">

        <div style="float:left; text-align:left; font-size:10px; margin:10px;">
        <strong>READ ME:</strong><br />
		When you click the purchase button, you will be directed to Paypal to complete your purchase. This is the safest way to complete a purchase because your information does not have to be sent over unsecured lines. Instead, you are transfered to Paypal where you enter your billing information. Once you have made your purcahse, please hit the button to return back to our site. The only information that is sent back to our site from paypal is the confirmation that you completed your payment. This ensures that only you and paypal will ever see your payment information. (Not even us). Once you return to our site, we will complete your order and begin processing. 
        </div>


<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="custom" value="<?php echo"$memberid"; ?>">
<input type='hidden' name='business' value='petuniabuttons@gmail.com'>
<?php
$itemcount = 1;
$tablename = "member_" . $memberid;
$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r = mysql_fetch_array($result);
$result = mysql_query("SELECT * FROM `$tablename`");
while ($r = mysql_fetch_array($result)) {
	$cartid = ($r['id']);
	$productid = ($r['productid']);
	$quantity = ($r['quantity']);
	$option1 = ($r['option1']);
	$option2 = ($r['option2']);
	$option3 = ($r['option3']);
	$option4 = ($r['option4']);
	
	$result2 = mysql_query('SELECT * FROM products WHERE id = "'.$productid.'"');
	$r2 = mysql_fetch_array($result2);
	$category = ($r2['category']);
	$name = ($r2['name']);
	$price = ($r2['price']);
	
	if ($option1 != "") {
		$name .= " ($option1)";
	}
	if ($option2 != "") {
		$name .= " ($option2)";
	}
	if ($option3 != "") {
		$name .= " ($option3)";
	}
	if ($option4 != "") {
		$name .= " ($option4)";
	}
	
	$price2 = ($price * $quantity);
	$price = number_format($price, 2);
	$price2 = number_format($price2, 2);
	$total += $price2;
	$itemname = "item_name_" . $itemcount;
	$itemnumber = "item_number_" . $itemcount;
	$itemamount = "amount_" . $itemcount;
	$itemquantity = "quantity_" . $itemcount;
?>
	<input type='hidden' name='<?php echo"$itemname"; ?>' value='<?php echo"$name"; ?>'>
	<input type='hidden' name='<?php echo"$itemnumber"; ?>' value='<?php echo"$itemcount"; ?>'>
    <input type='hidden' name='<?php echo"$itemamount"; ?>' value='<?php echo"$price"; ?>'>
    <input type='hidden' name='<?php echo"$itemquantity"; ?>' value='<?php echo"$quantity"; ?>'>
<?php
$itemcount += 1;
}
?>
<input type='hidden' name='discount_rate_cart' value='<?php echo"$discount"; ?>'>
<input type='hidden' name='tax_cart' value='<?php echo"$tax"; ?>'>
<input type='hidden' name='shipping_1' value='<?php echo"$shippingprice"; ?>'>
<input type='hidden' name='page_style' value='' />
<input type='hidden' name='first_name' value='<?php echo"$first"; ?>' />
<input type='hidden' name='last_name' value='<?php echo"$last"; ?>' />
<input type='hidden' name='country' value='<?php echo"$country"; ?>' />
<input type='hidden' name='address1' value='<?php echo"$address"; ?>' />
<input type='hidden' name='address2' value='<?php echo"$address2"; ?>' />
<input type='hidden' name='city' value='<?php echo"$city"; ?>' />
<input type='hidden' name='state' value='<?php echo"$state"; ?>' />
<input type='hidden' name='zip' value='<?php echo"$zip"; ?>' />
<input type='hidden' name='buyer_credit_promo_code' value=''>
<input type='hidden' name='buyer_credit_product_category' value=''>
<input type='hidden' name='buyer_credit_shipping_method' value=''>
<input type='hidden' name='buyer_credit_user_address_change' value=''>
<input type='hidden' name='number' value='<?php echo"$ccnumber"; ?>' />
<input type='hidden' name='type' value='<?php echo"$cctype"; ?>' />
<input type='hidden' name='expmonth' value='<?php echo"$ccexpirationmonth"; ?>' />
<input type='hidden' name='expyear' value='<?php echo"$ccexpirationyear"; ?>' />
<input type='hidden' name='cvv' value='<?php echo"$cccvv"; ?>' />
<input type='hidden' name='no_shipping' value='0'>
<input type='hidden' name='return' value='<?php echo"$baseurl/storesalecompletereturn.php"; ?>'>
<input type="hidden" name="cancel_return" value="<?php echo"$baseurl/storesalecompletecancel.php"; ?>">
<input type="hidden" name="notify_url" value="<?php echo"$baseurl/storesalecompleteipn.php"; ?>">
<input type='hidden' name='no_note' value='1'>
<input type='hidden' name='currency_code' value='USD'>
<input type='hidden' name='lc' value='US'>
<input type='hidden' name='bn' value='PP-BuyNowBF'>
<input type='image' src='images/purchase.png' border='0' name='submit' alt='Make payments with PayPal - its fast, free and secure!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>

<?php
/*
echo"
<form method=\"post\" action=\"http://www.supercrystals.net/storesalecomplete.php\">
<input type=\"hidden\" name=\"first\" value=\"$first\" />
<input type=\"hidden\" name=\"last\" value=\"$last\" />
<input type=\"hidden\" name=\"country\" value=\"$country\" />
<input type=\"hidden\" name=\"address\" value=\"$address\" />
<input type=\"hidden\" name=\"address2\" value=\"$address2\" />
<input type=\"hidden\" name=\"city\" value=\"$city\" />
<input type=\"hidden\" name=\"state\" value=\"$state\" />
<input type=\"hidden\" name=\"zip\" value=\"$zip\" />
<input type=\"hidden\" name=\"number\" value=\"$ccnumber\" />
<input type=\"hidden\" name=\"type\" value=\"$cctype\" />
<input type=\"hidden\" name=\"expmonth\" value=\"$ccexpirationmonth\" />
<input type=\"hidden\" name=\"expyear\" value=\"$ccexpirationyear\" />
<input type=\"hidden\" name=\"cvv\" value=\"$cccvv\" />
<input type=\"hidden\" name=\"total\" value=\"$total\" />
<button class=\"custombutton\" type=\"submit\"><img src=\"images/purchase.png\" alt=\"Make Payment\"  /></button>
</form>";

*/

?>

        </td>
		</tr>
        
        <tr>
        <td colspan="6" align="center" valign="top" class="borders" style="color:#FF0000; padding:10px;">
        <?php
		$message = ($_GET['message']);
		if ($message == 1) {
			echo"We have a limited amount of this product. <br />Please let us know which items you want more of.";
		}
		?>
        </td>
		</tr>
        </table>	
    </div>
    </td>
    </tr>
	</table>
</td>
</tr>
<?php
require ('includes/footer.php');
?>
</table>
</body>
</html>

<?php
ob_end_flush();
?>
