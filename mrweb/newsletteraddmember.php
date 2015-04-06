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
	$first = ($_POST['first']);
	$last = ($_POST['last']);
	$email = trim($_POST['email']);
	
	if (empty($_POST['email'])) {
		header("Location: newsletteraddmember.php?emailid=$emailid&error=1");
		exit;
	}
	
	$result = mysql_query("SELECT * FROM `newsletter` WHERE `email`= '$email'");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		header("Location: newsletteraddmember.php?error=2");
		exit;
		
	}
	
	if (!eregi ( '[a-z||0-9]@[a-z||0-9].[a-z]', $email ) ) {
		header("Location: newsletteraddmember.php?emailid=$emailid&error=3");
		exit;
	}
	

	
	$sql="INSERT INTO newsletter (first, last, email, status) VALUES('$first','$last','$email','1')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: newsletter.php");
	exit;
	
} else {

$error = ($_GET['error']);



echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"newsletteraddmember.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"You must enter an e-mail address";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";

}

if ($error == 2) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"There is already a member with that e-mail address.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";

}

if ($error ==3) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"The e-mail address is not in the correct format.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";

}

echo"
<tr>
<td class=\"editpageleft\">First:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"first\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the first name of the member.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Last:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"last\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the last name of the member.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">E-mail Address:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"email\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the e-mail address your newsletter will be sent to.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"submit\" name=\"submit\" value=\"Add New Member\" />
<a href=\"newsletter.php\">Cancel</a>
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




