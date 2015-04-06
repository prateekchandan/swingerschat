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
	$adminid = ($_POST['adminid']);
	$username = ($_POST['username']);
	$password = ($_POST['password']);
	$password2 = ($_POST['password2']);
	$displayname = ($_POST['displayname']);
	$email = ($_POST['email']);
	$phone = ($_POST['phone']);
	$returns = ($_POST['returns']);
	$exchanges = ($_POST['exchanges']);
	$special = ($_POST['special']);
	$policies = ($_POST['policy']);
	$eta = ($_POST['eta']);
	$domestic = ($_POST['domestic']);
	$international = ($_POST['international']);
	$po = ($_POST['po']);
	$faq = ($_POST['faq']);
	$benefits = ($_POST['benefits']);
	$requirements = ($_POST['requirements']);
	$myaccount = ($_POST['myaccount']);
	$recent = ($_POST['recent']);
	
	if (empty($_POST['username'])) {
		header("Location: editadmin.php?error=1");
		exit;
	}
	if (empty($_POST['password'])) {
		header("Location: editadmin.php?error=1");
		exit;
	}
	if (empty($_POST['password2'])) {
		header("Location: editadmin.php?error=1");
		exit;
	}
	if (empty($_POST['displayname'])) {
		header("Location: editadmin.php?error=1");
		exit;
	}
	if (empty($_POST['email'])) {
		header("Location: editadmin.php?error=1");
		exit;
	}
	if (($_POST['password']) != ($_POST['password2'])) {
		header("Location: editadmin.php?error=2");
		exit;
	}
	
	mysql_query("UPDATE `members` SET `username`='$username', `password`='$password', `displayname`='$displayname', `email`='$email', `shippingcountry`='$phone', `shippingcity`='$returns', `shippingstate`='$exchanges', `shippingzip`='$special', `shippingaddress`='$policies', `country`='$eta', `address`='$domestic', `address2`='$international', `city`='$po', `state`='$faq' WHERE `id` = '$adminid' ");
	
	header("Location: adminhome.php?message=7");
	exit;

} else {

$error = ($_GET['error']);
$result = mysql_query("SELECT * FROM `members` WHERE `admin`= '1'");
$r = mysql_fetch_array($result);
$adminid = ($r['id']);
$username = ($r['username']);
$password = ($r['password']);
$displayname = ($r['displayname']);
$email = ($r['email']);
$phone = ($r['shippingcountry']);
$returns = ($r['shippingcity']);
$exchanges = ($r['shippingstate']);
$special = ($r['shippingzip']);
$policies = ($r['shippingaddress']);
$eta = ($r['country']);
$domestic = ($r['address']);
$international = ($r['address2']);
$po = ($r['city']);
$faq = ($r['state']);
$benefits = ($r['description']);
$requirements = ($r['gender']);
$myaccount = ($r['relationship']);
$recent = ($r['college']);

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"editadmin.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must fill in all fields.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}
	
	if ($error == 2) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">Your passwords did not match.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}
	
	echo"
	<tr>
	<td class=\"editpageleft\">*Username:</td>
	<td class=\"editpageright\">
	<input type='text' name='username' value=\"$username\" />
	</td>
	<td class=\"editpagehints\">
	This is the name you use to login.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">*Password:</td>
	<td class=\"editpageright\">
	<input type='text' name='password' value=\"$password\" />
	</td>
	<td class=\"editpagehints\">
	This is the password you use to login.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">*Confirm Password:</td>
	<td class=\"editpageright\">
	<input type='text' name='password2' value=\"$password\" />
	</td>
	<td class=\"editpagehints\">
	This is the password you use to login.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">*Display Name:</td>
	<td class=\"editpageright\">
	<input type='text' name='displayname' value=\"$displayname\" />
	</td>
	<td class=\"editpagehints\">
	This is the name users will see if you comment in the blog, forum, etc.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">*E-mail:</td>
	<td class=\"editpageright\">
	<input type='text' name='email' value=\"$email\" />
	</td>
	<td class=\"editpagehints\">
	This is the e-mail that site e-mails will be sent to and from.
	</td>
	</tr>";
	
	/*
	
	<tr>
	<td class=\"editpageleft\">Left Column:</td>
	<td class=\"editpageright\">
	<textarea id=\"special1\" name=\"special\">$special</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('special1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will appear in the left column of the site.
	</td>
	</tr>";
	
	
	
	echo"
	<tr>
	<td class=\"editpageleft\">Customer Service Links:</td>
	<td class=\"editpageright\">
	<textarea id=\"policy1\" name=\"policy\">$policies</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('policy1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the area that will display on the left hand side of your policies page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Returns:</td>
	<td class=\"editpageright\">
	<textarea id=\"returns1\" name=\"returns\">$returns</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('returns1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the returns section on the product page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Exchanges:</td>
	<td class=\"editpageright\">
	<textarea id=\"exchanges1\" name=\"exchanges\">$exchanges</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('exchanges1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the exchanges section on the product page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">FAQ's:</td>
	<td class=\"editpageright\">
	<textarea id=\"faq1\" name=\"faq\">$faq</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('faq1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the faq section on the returns and exchanges page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">ETA:</td>
	<td class=\"editpageright\">
	<textarea id=\"eta1\" name=\"eta\">$eta</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('eta1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the ETA section of the Shipping page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Domestic Shipping:</td>
	<td class=\"editpageright\">
	<textarea id=\"domestic1\" name=\"domestic\">$domestic</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('domestic1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the Domestic Shipping section of the Shipping page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">International Shipping:</td>
	<td class=\"editpageright\">
	<textarea id=\"international1\" name=\"international\">$international</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('international1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the International Shipping section of the Shipping page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">PO Box Shipping:</td>
	<td class=\"editpageright\">
	<textarea id=\"po1\" name=\"po\">$po</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('po1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the PO Box Shipping section of the Shipping page.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Registration Benefits:</td>
	<td class=\"editpageright\">
	<textarea id=\"benefits1\" name=\"benefits\">$benefits</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('benefits1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the Registration Benefits section of the My Account Information.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Registration Requirements:</td>
	<td class=\"editpageright\">
	<textarea id=\"requirements1\" name=\"requirements\">$requirements</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('requirements1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the Requirements section of the My Account Information.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Managing My Account:</td>
	<td class=\"editpageright\">
	<textarea id=\"myaccount1\" name=\"myaccount\">$myaccount</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('myaccount1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the My Account section of the My Account Information.
	</td>
	</tr>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Recently Viewed Items:</td>
	<td class=\"editpageright\">
	<textarea id=\"recent1\" name=\"recent\">$recent</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('recent1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the text that will display under the Recently Viewed Items section of the My Account Information.
	</td>
	</tr>";
	
	/*
	echo"
	<tr>
	<td class=\"editpageleft\">AD Space:</td>
	<td class=\"editpageright\">
	<textarea id=\"ad1\" name=\"ad\">$ad</textarea>
		<script language=\"javascript1.2\">
		generate_wysiwyg('ad1');
		</script>
	</td>
	<td class=\"editpagehints\">
	This is the ad space on the right hand side of your pages.
	</td>
	</tr>";
	*/

	echo"
	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type='hidden' name='adminid' value=\"$adminid\" />
	<input type=\"submit\" name=\"submit\" value=\"SAVE CHANGES\" />
	<a href=\"adminhome.php?message=3\">Discard Changes</a>
	<br /><br />
	</form>
	</td>
	</tr>
    </table>";
}
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




