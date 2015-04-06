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
	$pageid = ($_POST['pageid']);
	$tablename = ($_POST['tablename']);
	$fieldid = ($_POST['fieldid']);
	$name = ($_POST['name']);
	$bio = ($_POST['bio']);
	
	if (empty($_POST['name'])) {
		header("Location: editservicecategory.php?error=1&pageid=$pageid&tablename=$tablename&fieldid=$fieldid");
		exit;
	}
	
	mysql_query("UPDATE `$tablename` SET `name`= '$name', `bio`='$bio' WHERE `id` = '$fieldid' ");

	header("Location: editpage.php?pageid=$pageid");
	exit;
	
} else {
$error = ($_GET['error']);
$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);
$fieldid = ($_GET['fieldid']);

$result = mysql_query("SELECT * FROM $tablename WHERE id = $fieldid");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$bio = ($r['bio']);
$pic = ($r['pic']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"editprofile.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
	<td class=\"editpageright\">You must have a name for the field.
	</td>
	<td class=\"editpagehints\">
	</td>
	</tr>";
}

if ($pic != "noimage.jpg") {
	echo"
	<tr>
	<td class=\"editpageleft\">Profile Image:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<a href=\"../profilepics/$pic\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='../profilepics/thumbs/$pic' width='75px' height='75px'/></a>";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href='deleteprofilephoto.php?fieldid=$fieldid&tablename=$tablename&pageid=$pageid&pic=$pic'>REMOVE PICTURE</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the image for this profile.
	</td></tr>";
} else {
	echo"
	<tr>
	<td class=\"editpageleft\">Profile Image:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<img src='../profilepics/noimage.jpg' width='125px'/>";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href=\"addprofilephoto.php?fieldid=$fieldid&tablename=$tablename&pageid=$pageid\">Add New Photo</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the image for this profile.
	</td></tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the person or object in the profile.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Bio:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"profilebio\" name=\"bio\">$bio</textarea>
<script language=\"javascript1.2\">
make_wyzz('profilebio');
</script>";
echo"</td><td class=\"editpagehints\">
This is the bio or description for the profile.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"hidden\" name=\"fieldid\" value=\"$fieldid\" />
<input type=\"submit\" name=\"submit\" value=\"Edit Profile\" />
<a href=\"editpage.php?pageid=$pageid\">Cancel</a>
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




