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
$tablename = "member_" . $memberid;
$error = ($_GET['error']);

$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r = mysql_fetch_array($result);
$shippingcountry = ($r['shippingcountry']);
$shippingaddress = ($r['shippingaddress']);
$shippingaddress2 = ($r['shippingaddress2']);
$shippingcity = ($r['shippingcity']);
$shippingstate = ($r['shippingstate']);
$shippingzip = ($r['shippingzip']);

$ounces = 0;

$result = mysql_query("SELECT * FROM `$tablename`");
while ($r = mysql_fetch_array($result)) {
	$productid = ($r['productid']);
	$quantity = ($r['quantity']);
	$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r2 = mysql_fetch_array($result2);
	$productweight = ($r2['ounces']);
	$ounces += ($quantity * $productweight);
}




if (isset ($_POST['submit'])) {
	$shippingtype = $_POST['shippingtype'];
	$number = $_POST['number'];
	$type = $_POST['type'];
	$expirationmonth = $_POST['expirationmonth'];
	$expirationyear = $_POST['expirationyear'];
	$cvv = $_POST['cvv'];
	
	if (empty ($_POST['number'])) {
		header("Location: storecheckout2.php?error=1");
		exit;
	}
	if (empty ($_POST['type'])) {
		header("Location: storecheckout2.php?error=1");
		exit;
	}
	if (empty ($_POST['expirationmonth'])) {
		header("Location: storecheckout2.php?error=1");
		exit;
	}
	if (empty ($_POST['expirationyear'])) {
		header("Location: storecheckout2.php?error=1");
		exit;
	}
	if (empty ($_POST['cvv'])) {
		header("Location: storecheckout2.php?error=1");
		exit;
	}
	/*
	if ($shippingtype == "FIRST CLASS") {
		$postagetype = 0;
	}
	if ($shippingtype == "PRIORITY") {
		$postagetype = 1;
	}
	
	$shippingprice = USPSParcelRate($shippingtype, $ounces, $shippingzip, $postagetype);
	
	$_SESSION['shippingprice'] = "$shippingprice";
	$_SESSION['shippingtype'] = "$shippingtype";
	*/
	
	$_SESSION['ccnumber'] = "$number";
	$_SESSION['cctype'] = "$type";
	$_SESSION['ccexpirationmonth'] = "$expirationmonth";
	$_SESSION['ccexpirationyear'] = "$expirationyear";
	$_SESSION['cccvv'] = "$cvv";
	
	header("Location: storecheckout22.php");
	exit;


	
} else {




?>



	<form method="post" action="storecheckout2.php">
	
	<table align="left" cellspacing="0px" cellpadding="0px" class='checkout' width="100%">
    <tr>
	<td align="left" colspan="2" valign="top" class='checkoutheader'>
    <strong>PAYMENT INFORMATION:</strong> - <a href='storecheckout.php'>Edit Personal Info</a>
	</td>
	</tr>
    
	<?php
	if ($error == 1) {
	?>
	<tr>
    <td align="right" valign="top" style=" background-color:#FF0000; color:#FFFFFF; padding:5px;">Error:</td>
	<td align="left" valign="top" class="checkoutcellright">
	Please fill out all fields.
	</td>
	</tr>
	<?php
	}
	?>
    
    <tr>
	<td class="checkoutcellleft">
	</td>
	<td class="checkoutcellright" style='font-size:12px;'>
	This is for us to validate your credit card info - you will not be charged during this step. You will get one more chance to review your order before you make this purchase.
    <br /><br />
This info is only used for this one time purchase and then it will be deleted from our site for your security. 
	</td>
	</tr>

	
	<tr>
	<td class="checkoutcellleft">
	Credit Card Number:     
	</td>
	<td class="checkoutcellright">
	<input type="text" name="number" width="40px" maxlength="16" />
	</td>
	</tr>
    
    <tr> 
    <td class="checkoutcellleft">
     Credit Card Type:
    </td>
    <td class="checkoutcellright">
      <select name="type">
        <option value="Mastercard">Mastercard</option>
        <option value="Visa">Visa</option>
        <option value="Discover">Discover</option>
        <option value="American Express">American Express</option>
	   </select>
	<tr>
	<td class="checkoutcellleft">
	Expiration (MM/YYYY):     
	</td>
	<td class="checkoutcellright">
	<input type="text" name="expirationmonth" style="width:20px;" maxlength="2"/><input type="text" name="expirationyear" style="width:40px;" maxlength="4" />
	</td>
	</tr>
    
    <tr>
	<td class="checkoutcellleft">
	CVV Number<br />
    <em>Located on back of card</em>    
	</td>
	<td class="checkoutcellright">
	<input type="text" name="cvv" style="width:40px;" maxlength="4" />
	</td>
	</tr>


	<tr>
	<td align="center" valign="top" colspan="2" class='checkoutheader'>
	<input type="submit" name="submit" value="Continue" />

	</td>
	</tr>
    </table>
	
	</form>



	
<?php
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
