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
if (isset ($_POST['submit'])) {
	$memberid = ($_POST['memberid']);
	$approved = ($_POST['approved']);
	if ($approved != 1) { $approved = 0; }
	
	mysql_query("UPDATE `members` SET `approved`='$approved' WHERE `id` = '$memberid' ");
	
	header("Location: members.php?memberid=$memberid&success=1");
	exit;
	
} else {

$memberid = ($_GET['memberid']);

$result = mysql_query("SELECT * FROM members WHERE id = $memberid");
$r = mysql_fetch_array($result);
$first = ($r['first']);
$last = ($r['last']);
$username = ($r['username']);
$email = ($r['email']);
$phone = ($r['phone']);
$billingcountry = ($r['country']);
$billingaddress = ($r['address']);
$billingaddress2 = ($r['address2']);
$billingcity = ($r['city']);
$billingstate = ($r['state']);
$billingzip = ($r['zip']);
$shippingcountry = ($r['shippingcountry']);
$shippingaddress = ($r['shippingaddress']);
$shippingaddress2 = ($r['shippingaddress2']);
$shippingcity = ($r['shippingcity']);
$shippingstate = ($r['shippingstate']);
$shippingzip = ($r['shippingzip']);
$approved = ($r['approved']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

$success = ($_GET['success']);
if ($success == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#08cf16;'>Success:</td>
	<td class=\"editpageright\">";
	echo"You have successfully updated this account.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Approved:</td>
<td class=\"editpageright\">";
echo"<form enctype=\"multipart/form-data\" action=\"members.php\" method=\"post\">";
echo"<input type='checkbox' name='approved' value='1'"; if ($approved == 1) { echo"checked='checked'"; } echo"/>";
echo"<input type='hidden' name='memberid' value='$memberid' />";
echo"&nbsp;&nbsp;&nbsp;&nbsp;";
echo"<input type='submit' name='submit' value='Update' />";
echo"</form>";
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
<td class=\"editpageleft\">Username:</td>
<td class=\"editpageright\">";
echo"$username";
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
<td class=\"editpageleft\">Billing Country:</td>
<td class=\"editpageright\">";
echo"$billingcountry";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Billing Address:</td>
<td class=\"editpageright\">";
echo"$billingaddress";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Billing Address 2:</td>
<td class=\"editpageright\">";
echo"$billingaddress2";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Billing City:</td>
<td class=\"editpageright\">";
echo"$billingcity";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Billing State:</td>
<td class=\"editpageright\">";
echo"$billingstate";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Billing Zip:</td>
<td class=\"editpageright\">";
echo"$billingzip";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping Country:</td>
<td class=\"editpageright\">";
echo"$shippingcountry";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping Address:</td>
<td class=\"editpageright\">";
echo"$shippingaddress";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping Address 2:</td>
<td class=\"editpageright\">";
echo"$shippingaddress2";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping City:</td>
<td class=\"editpageright\">";
echo"$shippingcity";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping State:</td>
<td class=\"editpageright\">";
echo"$shippingstate";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Shipping Zip:</td>
<td class=\"editpageright\">";
echo"$shippingzip";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td></td>
<td align='left'>";
echo"<a href='adminhome.php'><-- Back to homepage.</a>";
echo"</td><td>
</td></tr>";

echo"
</table>";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




