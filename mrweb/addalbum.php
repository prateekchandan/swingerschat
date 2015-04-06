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
	$tablename = ($_POST['tablename']);
	$pageid = ($_POST['pageid']);
	$galleryid = ($_POST['galleryid']);
	
	$result = mysql_query("SELECT * FROM $tablename");
	$fieldorder = mysql_num_rows($result);
	$fieldorder += 1;
	
	$sql="INSERT INTO $tablename (pageid, pageorder) VALUES('$galleryid','$fieldorder')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	header("Location: editpage.php?pageid=$pageid");
	exit;
	
} else {

$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"addalbum.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">Choose Gallery:</td>
<td class=\"editpageright\">";

echo"<select name='galleryid'>";
$result = mysql_query("SELECT * FROM `pages` WHERE `type` = 'Photo Gallery'");
while ($r = mysql_fetch_array($result)) {
	$galleryid = ($r['id']);
	$galleryname = ($r['name']);
	echo"<option value='$galleryid'>$galleryname</option>";
}
echo"</select>";
			
echo"</td><td class=\"editpagehints\">
This is the gallery you want to add.
</td></tr>";


echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"submit\" name=\"submit\" value=\"Add Gallery\" />
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




