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

//MEMBERS ONLY CHECK
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


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='text7'>
	<div class='div7'>
	<?php
	$first = $_POST['first'];
	$last = $_POST['last'];
	$phone = $_POST['phone'];
	$same = $_POST['same'];
	$billingcountry = $_POST['billingcountry'];
	$billingaddress = $_POST['billingaddress'];
	$billingaddress2 = $_POST['billingaddress2'];
	$billingcity = $_POST['billingcity'];
	$billingstate = $_POST['billingstate'];
	$billingzip = $_POST['billingzip'];
	$shippingcountry = $_POST['shippingcountry'];
	$shippingaddress = $_POST['shippingaddress'];
	$shippingaddress2 = $_POST['shippingaddress2'];
	$shippingcity = $_POST['shippingcity'];
	$shippingstate = $_POST['shippingstate'];
	$shippingzip = $_POST['shippingzip'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$username = $_POST['username'];
	
	$returnvalues = "&first=$first&last=$last&phone=$phone&billingcountry=$billingcountry&billingaddress=$billingaddress&billingaddress2=$billingaddress2&billingcity=$billingcity&billingstate=$billingstate&billingzip=$billingzip&shippingcountry=$shippingcountry&shippingaddress=$shippingaddress&shippingaddress2=$shippingaddress2&shippingcity=$shippingcity&shippingstate=$shippingstate&shippingzip=$shippingzip&email=$email&username=$username&same=$same";
	
	if (empty ($_POST['first'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	if (empty ($_POST['last'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	
	if (empty ($_POST['phone'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	if (empty ($_POST['billingcountry'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	if (empty ($_POST['billingaddress'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	if (empty ($_POST['billingcity'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	if (empty ($_POST['billingstate'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	if (empty ($_POST['billingzip'])) {
		header("Location: storecheckout.php?error=1 $returnvalues");
		exit;
	}
	
	if ($same == "0") {
		if (empty ($_POST['shippingcountry'])) {
			header("Location: storecheckout.php?error=1 $returnvalues");
			exit;
		}
		if (empty ($_POST['shippingaddress'])) {
			header("Location: storecheckout.php?error=1 $returnvalues");
			exit;
		}
		if (empty ($_POST['shippingcity'])) {
			header("Location: storecheckout.php?error=1 $returnvalues");
			exit;
		}
		if (empty ($_POST['shippingstate'])) {
			header("Location: storecheckout.php?error=1 $returnvalues");
			exit;
		}
		if (empty ($_POST['shippingzip'])) {
			header("Location: storecheckout.php?error=1 $returnvalues");
			exit;
		}
	}
	
	if (isset($_SESSION['memberloggedin'])) {
		$memberid = ($_SESSION['memberloggedin']);
		
		if ($same == "0") {
			mysql_query("UPDATE `members` SET `first`= '$first', `last`= '$last',`phone`= '$phone', `country`='$billingcountry', `address`='$billingaddress', `address2`='$billingaddress2', `city`= '$billingcity', `state`= '$billingstate', `zip`= '$billingzip', `shippingcountry`= '$shippingcountry', `shippingaddress`= '$shippingaddress', `shippingaddress2`= '$shippingaddress2', `shippingcity`= '$shippingcity', `shippingstate`= '$shippingstate', `shippingzip`= '$shippingzip' WHERE `id` = '$memberid' ");
		} else {
			mysql_query("UPDATE `members` SET `first`= '$first', `last`= '$last',`phone`= '$phone', `country`='$billingcountry', `address`='$billingaddress', `address2`='$billingaddress2', `city`= '$billingcity', `state`= '$billingstate', `zip`= '$billingzip', `shippingcountry`= '$billingcountry', `shippingaddress`= '$billingaddress', `shippingaddress2`= '$billingaddress2', `shippingcity`= '$billingcity', `shippingstate`= '$billingstate', `shippingzip`= '$billingzip' WHERE `id` = '$memberid' ");
		}
	} else if (isset($_SESSION['guestloggedin'])) {
		$memberid = ($_SESSION['guestloggedin']);
		if (!empty ($_POST['email'])) {
			$_SESSION['memberloggedin'] = "$memberid";
			unset($_SESSION['guestloggedin']);
			$password = rand_string( 8 );
			
			$sitelogo = $baseurl . "images/logo.png";
			$RecipientEmail = $email;
			$RecipientName = $username;
			$SenderEmail = $adminemail; 
			$SenderName = $sitename;
			$cc = "";
			$bcc = "";
			$subject = "You are now a member of $sitename";
			$message = "<div style='width:500px;'>
			
			<span style='color:#276db8; font-size:22px;'>Congratulations! Your Membership is now active.</span> <br /><br />
			
			The following is important information. Please save in a safe place.<br />
			
			Your e-mail is: $email <br />
			
			Your password is: $password <br /><br />
			
			We are excited to have you as our new member!<br /><br />
			
			Best wishes from,<br />
			$sitename Staff!<br /><br />
			
			NOTE: This email was automatically generated from $sitename<br />
			($baseurl).<br /><br />
			</div>";
			
			$attachments = "";
			$priority = ""; //low, high or blank
			$type = ""; //leave blank for HTML or type plain for text
			
			$sent = Email($RecipientEmail, $RecipientName, $SenderEmail, $SenderName, $cc, $bcc, $subject, $message, $attachments, $priority, $type);
		
		} else {
			$password = "noaccount";
		}
		
		if ($same == "0") {
			mysql_query("UPDATE `members` SET `first`= '$first', `last`= '$last',`phone`= '$phone', `country`='$billingcountry', `address`='$billingaddress', `address2`='$billingaddress2', `city`= '$billingcity', `state`= '$billingstate', `zip`= '$billingzip', `shippingcountry`= '$shippingcountry', `shippingaddress`= '$shippingaddress', `shippingaddress2`= '$shippingaddress2', `shippingcity`= '$shippingcity', `shippingstate`= '$shippingstate', `shippingzip`= '$shippingzip', `password`='$password' WHERE `id` = '$memberid' ");
		} else {
			mysql_query("UPDATE `members` SET `first`= '$first', `last`= '$last',`phone`= '$phone', `country`='$billingcountry', `address`='$billingaddress', `address2`='$billingaddress2', `city`= '$billingcity', `state`= '$billingstate', `zip`= '$billingzip', `shippingcountry`= '$billingcountry', `shippingaddress`= '$billingaddress', `shippingaddress2`= '$billingaddress2', `shippingcity`= '$billingcity', `shippingstate`= '$billingstate', `shippingzip`= '$billingzip', `password`='$password' WHERE `id` = '$memberid' ");
		}
		
		
			
			
	} else {
		if (empty ($_POST['email'])) {
			$email = "noaccount";
		} else {
			$result = mysql_query("SELECT * FROM `members` WHERE `email` = '$email'");
			$rows = mysql_num_rows($result);
			if ($rows > 0) {
				header("Location: storecheckout.php?error=3 $returnvalues");
				exit;
			}
		}
		
		$password = rand_string( 8 );
		
		if ($same == "0") {
			$sql="INSERT INTO members (username, first, last, email, phone, country, address, address2, city, state, zip, shippingcountry, shippingaddress, shippingaddress2, shippingcity, shippingstate, shippingzip, password) VALUES ('$username','$first','$last','$email','$phone','$billingcountry','$billingaddress','$billingaddress2','$billingcity','$billingstate','$billingzip','$shippingcountry','$shippingaddress','$shippingaddress2','$shippingcity','$shippingstate','$shippingzip','$password')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: ' . mysql_error());
			}
		} else {
			$sql="INSERT INTO members (username, first, last, email, phone, country, address, address2, city, state, zip, shippingcountry, shippingaddress, shippingaddress2, shippingcity, shippingstate, shippingzip, password) VALUES ('$username','$first','$last','$email','$phone','$billingcountry','$billingaddress','$billingaddress2','$billingcity','$billingstate','$billingzip','$billingcountry','$billingaddress','$billingaddress2','$billingcity','$billingstate','$billingzip','$password')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: ' . mysql_error());
			}
		}
		$result = mysql_query("SELECT `id` FROM `members` ORDER BY `id` DESC");
		$r = mysql_fetch_array($result);
		$memberid = ($r['id']);
		
		
		//mkdir("members/$newtable");
		
		if (!empty ($_POST['email'])) {
			$_SESSION['memberloggedin'] = "$memberid";
		} else {
			$_SESSION['guestloggedin'] = "$memberid";
		}
		
		$sitelogo = $baseurl . "images/logo.png";
		$RecipientEmail = $email;
		$RecipientName = $username;
		$SenderEmail = $adminemail; 
		$SenderName = $sitename;
		$cc = "";
		$bcc = "";
		$subject = "You are now a member of $sitename";
		$message = "<div style='width:500px;'>
		
		<span style='color:#276db8; font-size:22px;'>Congratulations! Your Membership is now active.</span> <br /><br />
		
		The following is important information. Please save in a safe place.<br />
		
		Your e-mail is: $email <br />
		
		Your password is: $password <br /><br />
		
		We are excited to have you as our new member!<br /><br />
		
		Best wishes from,<br />
		$sitename Staff!<br /><br />
		
		NOTE: This email was automatically generated from $sitename<br />
		($baseurl).<br /><br />
		</div>";
		
		$attachments = "";
		$priority = ""; //low, high or blank
		$type = ""; //leave blank for HTML or type plain for text
		
		$sent = Email($RecipientEmail, $RecipientName, $SenderEmail, $SenderName, $cc, $bcc, $subject, $message, $attachments, $priority, $type);
			
		
		
	}
	
	$ip=getenv("REMOTE_ADDR");
	$result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
	while ($r = mysql_fetch_array($result)) {
		$id = ($r['id']);
		$quantity = ($r['quantity']);
		$productid = ($r['productid']);
		$option1 = ($r['option1']);
		$option2 = ($r['option2']);
		$option3 = ($r['option3']);
		$option4 = ($r['option4']);
		
		mysql_query("UPDATE `cart` SET `memberid`= '$memberid', `ip`='' WHERE `id` = '$id' ");
	
	}
	
	//Do shipping section
	if ($same != "0") {
		$shippingcountry = $billingcountry;
		$shippingzip = $billingzip;	
	}
	$ounces = 0;
	$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
	while ($r = mysql_fetch_array($result)) {
		$productid = ($r['productid']);
		$quantity = ($r['quantity']);
		$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
		$r2 = mysql_fetch_array($result2);
		$productweight = ($r2['ounces']);
		$ounces += ($quantity * $productweight);
	}
	$ounces += 1;

	$shippingtype = $_POST['shippingtype'];
	if (empty ($_POST['shippingtype'])) {
		unset($_SESSION['shippingprice']);
		unset($_SESSION['shippingtype']);
		header("Location: storecheckout.php?error=5 $returnvalues");
		exit;
	}
	if ($shippingtype == "FIRST CLASS") {
		$postagetype = 0;
		$shippingprice = USPSParcelRate($shippingtype, $ounces, $shippingzip, $postagetype, $shippingcountry);
	}
	if ($shippingtype == "PRIORITY") {
		$postagetype = 1;
		$priorityprice = USPSParcelRate($shippingtype, $ounces, $shippingzip, $postagetype, $shippingcountry);
	
		$shippingprice = number_format($priorityprice, 2);
	}
	if ($shippingtype == "INTERNATIONAL") {
		$postagetype = 2;
		$intprice = USPSParcelRate($shippingtype, $ounces, $shippingzip, $postagetype, $shippingcountry);
		$shippingprice = number_format($intprice, 2);
	}
	
	
	$_SESSION['shippingprice'] = $shippingprice;

	
	
	//Create Order
	$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
	$r = mysql_fetch_array($result);
	$shippingcountry = $r['shippingcountry'];
	$shippingaddress = $r['shippingaddress'];
	$shippingaddress2 = $r['shippingaddress2'];
	$shippingcity = $r['shippingcity'];
	$shippingstate = $r['shippingstate'];
	$shippingzip = $r['shippingzip'];
	
	$tax = ($_SESSION['ordertax']);
	
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
	
	$total = 0;
	$result1 = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
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
		$total += ($price * $quantity);
		if ($qty < $quantity) {
			$revcart = 1;
			$quantity = $qty;
			if ($qty < 1) {
				$query22 = "DELETE FROM cart WHERE id = '".$id."'";
				$results22 = mysql_query($query22);
			} else {
				mysql_query("UPDATE `cart` SET `quantity`= '$qty' WHERE `id` = '$id' ");
			}
			
		}
		$category = ($r2['category']);
		$productname = ($r2['name']);
		$price2 = 0;
		if (($option1 != "")) {
			//Get Option Extra Charges
			$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
			$r7 = mysql_fetch_array($result7);
			$extracharge = ($r7['price']);
			$chargedisplay = "";
			if (($extracharge != "") && ($extracharge != 0)) {
				$chargedisplay .= " - $" . $extracharge . " extra";
				$optionprice = ($extracharge * $quantity);
				$price2 += $optionprice;
			}
			echo"<br /><div class='viewcartoptions'>$option1name: $option1 $chargedisplay</div>";
		}
		if ($option2 != "") {
			//Get Option Extra Charges
			$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
			$r7 = mysql_fetch_array($result7);
			$extracharge = ($r7['price']);
			$chargedisplay = "";
			if (($extracharge != "") && ($extracharge != 0)) {
				$chargedisplay .= " - $" . $extracharge . " extra";
				$optionprice = ($extracharge * $quantity);
				$price2 += $optionprice;
			}
			echo"<br /><div class='viewcartoptions'>$option2name: $option2 $chargedisplay</div>";
		}
		if ($option3 != "") {
			//Get Option Extra Charges
			$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
			$r7 = mysql_fetch_array($result7);
			$extracharge = ($r7['price']);
			$chargedisplay = "";
			if (($extracharge != "") && ($extracharge != 0)) {
				$chargedisplay .= " - $" . $extracharge . " extra";
				$optionprice = ($extracharge * $quantity);
				$price2 += $optionprice;
			}
			echo"<br /><div class='viewcartoptions'>$option3name: $option3 $chargedisplay</div>";
		}
		if ($option4 != "") {
			//Get Option Extra Charges
			$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
			$r7 = mysql_fetch_array($result7);
			$extracharge = ($r7['price']);
			$chargedisplay = "";
			if (($extracharge != "") && ($extracharge != 0)) {
				$chargedisplay .= " - $" . $extracharge . " extra";
				$optionprice = ($extracharge * $quantity);
				$price2 += $optionprice;
			}
			echo"<br /><div class='viewcartoptions'>$option4name: $option4 $chargedisplay</div>";
		}
		
		$total += $price2;
		
		//mysql_query("UPDATE `products` SET `quantity`= '$qty' WHERE `id` = '$productid' ");
	
		
		$sql2="INSERT INTO `ordertable` (productid, country, address, address2, city, state, zip, quantity, option1, option2, option3, option4, price, promocode, discount, promo, orderid) VALUES ('$productid','$shippingcountry','$shippingaddress','$shippingaddress2','$shippingcity','$shippingstate','$shippingzip','$quantity','$option1','$option2','$option3','$option4','$price','$promocode3','$promocode','$promocode2','$orderid')";
	
		if (!mysql_query($sql2,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		//$query22 = "DELETE FROM $tablename WHERE id = '".$id."'";
		//$results22 = mysql_query($query22);
		
	}
	
	//UPDATE TAX
	//Do Tax Section
	$tax = 0;

	if ($shippingstate == 'CA') {
		$tax = ($total * .0825);
		$tax = round($tax, 2);
		$tax = number_format($tax, 2,'.','');
	}
	$_SESSION['ordertax'] = $tax;
	mysql_query("UPDATE `orders` SET `tax`= '$tax' WHERE `id` = '$orderid' ");
	
	header("Location: storecheckout.php?ready=2&same=$same&revcart=$revcart");
	exit();
	?>
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
