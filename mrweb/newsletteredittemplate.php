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
	$name = ($_POST['name']);
	$frommail = trim($_POST['frommail']);
	$subject = ($_POST['subject']);
	$message = ($_POST['message']);
	$template_id = ($_POST['id']);
	$message2 = ($_POST['message2']);
	$textmail = ($_POST['textmail']);
	$htmlmail = ($_POST['htmlmail']);
	
	if (empty($_POST['name'])) {
		header("Location: newsletteredittemplate.php?error=1&id=$template_id");
		exit;
	}
	
	if (empty($_POST['frommail'])) {
		header("Location: newsletteredittemplate.php?error=1&id=$template_id");
		exit;
	}
	
	if (empty($_POST['subject'])) {
		header("Location: newsletteredittemplate.php?error=1&id=$template_id");
		exit;
	}
	
	if (!eregi ( '[a-z||0-9]@[a-z||0-9].[a-z]', $frommail ) ) {
		header("Location: newsletteredittemplate.php?error=3&id=$template_id");
		exit;
	}
	

	mysql_query("UPDATE `newsletter_templates` SET `name` = '$name', `frommail` = '$frommail', `subject` = '$subject', `message` = '$message', `message2`='$message2', `textmail`='$textmail', `htmlmail`='$htmlmail' WHERE `id` = '$template_id' ");

	header("Location: newsletter.php");
	exit;
	
} else {

$error = ($_GET['error']);
$template_id = ($_GET['id']);

$result = mysql_query("SELECT * FROM `newsletter_templates` WHERE `id` = '$template_id'");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$frommail = ($r['frommail']);
$subject = ($r['subject']);
$message = ($r['message']);
$message2 = ($r['message2']);
$textmail = ($r['textmail']);
$htmlmail = ($r['htmlmail']);


echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"newsletteredittemplate.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"All fields are required.";
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
<td class=\"editpageleft\">Template Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the template.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">From: <br /><span style='font-size:10px;'>(email address)</span></td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"frommail\" value=\"$frommail\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is email address e-mails will say they are sent from. Please have this be in the following format: name@yourdomain.com <br /><br/>For example: gmail, yahoo , etc. accounts may cause problems.

</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Subject:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"subject\" value=\"$subject\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the subject of the e-mail that will be sent.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Toggle Text:</td>
<td class=\"editpageright\">";
echo"<input type=\"checkbox\" name=\"textmail\" value=\"1\" "; if ($textmail == 1) {echo"checked='checked'"; } echo"/>";
echo"</td><td class=\"editpagehints\">
This will choose whether you want to send a text version of the message. You can send both text and HTML versions so if the recipient does not have an HTML e-mail program, they can still view the text version.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\"> Text Message:</td>
<td class=\"editpageright\">
<textarea name=\"message\" cols='72' rows='10'>$message</textarea>
</td>
<td class=\"editpagehints\">
This is a message created with just text. This would be a normal looking e-mail.
</td>
</tr>";

echo"
<tr>
<td class=\"editpageleft\">Toggle HTML:</td>
<td class=\"editpageright\">";
echo"<input type=\"checkbox\" name=\"htmlmail\" value=\"1\" "; if ($htmlmail == 1) {echo"checked='checked'"; } echo"/>";
echo"</td><td class=\"editpagehints\">
This will choose whether you are sending an HTML version of the message. It is best to send a regular text message along with this HTML version in case the recipient can't receive the HTML version.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">HTML Message:</td>
<td class=\"editpageright\">
<textarea id=\"message02\" name=\"message2\">$message2</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('message02');
</script>
</td>
<td class=\"editpagehints\">
This is a message created with HTML. These messages can contain styles and images.
</td>
</tr>";


echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"id\" value=\"$template_id\" />
<input type=\"submit\" name=\"submit\" value=\"Save New Template\" />
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




