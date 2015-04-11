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
	$emailid= ($_POST['emailid']);
	$first = ($_POST['first']);
	$last = ($_POST['last']);
	$email = trim($_POST['email']);
	$origemail = ($_POST['origemail']);
	
	if (empty($_POST['email'])) {
		header("Location: newslettereditmember.php?emailid=$emailid&error=1");
		exit;
	}
	
	$result = mysql_query("SELECT * FROM `newsletter` WHERE `email`= '$email'");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		if ($email != $origemail) {
			header("Location: newslettereditmember.php?emailid=$emailid&error=2");
			exit;
		}
	}
	
	mysql_query("UPDATE `newsletter` SET `first` = '$first', `last` = '$last', `email` = '$email' WHERE `id` = '$emailid' ");
	
	if ($email != origemail) {
		$result = mysql_query("SELECT * FROM `newsletter_lists`");
		while ($r = mysql_fetch_array($result)) {
			$list_id = ($r['id']);
			$tablename = "newsletter_list_" . $list_id;
			$result2 = mysql_query("SELECT * FROM `$tablename` WHERE `email` = '$origemail'");
			while ($r2 = mysql_fetch_array($result2)) {
				$listID = ($r2['id']);
				mysql_query("UPDATE `$tablename` SET `email` = '$email' WHERE `id` = '$listID' ");
			}
		}
	}

	header("Location: newsletter.php");
	exit;
	
} else {

$emailid = ($_GET['emailid']);
$error = ($_GET['error']);
$result = mysql_query("SELECT * FROM `newsletter` WHERE `id` = '$emailid'");
$r = mysql_fetch_array($result);	
$first = ($r['first']);
$last = ($r['last']);
$email = ($r['email']);



echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"newslettereditmember.php\" method='post'>";

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


echo"
<tr>
<td class=\"editpageleft\">First:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"first\" value=\"$first\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the first name of the member.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Last:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"last\" value=\"$last\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the last name of the member.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">E-mail Address:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"email\" value=\"$email\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the e-mail address your newsletter will be sent to.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type='hidden' name='emailid' value='$emailid' />
<input type='hidden' name='origemail' value='$email' />
<input type=\"submit\" name=\"submit\" value=\"Edit Member\" />
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




