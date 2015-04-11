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
	$dropdownpageid = ($_POST['dropdownpageid']);
	
	$result = mysql_query("SELECT * FROM $tablename");
	$dropdownpageorder = mysql_num_rows($result);
	$dropdownpageorder += 1;
	
	$result = mysql_query("SELECT * FROM `pages` WHERE id = '$dropdownpageid'");
	$r = mysql_fetch_array($result);
	$dropdownpagetype = ($r['type']);
	
	$sql="INSERT INTO $tablename (pageid, type, pageorder) VALUES('$dropdownpageid','$dropdownpagetype','$dropdownpageorder')";
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
echo"<form enctype='multipart/form-data' action=\"adddropdownpage.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">Select Page:</td>
<td class=\"editpageright\">";
echo"<select name='dropdownpageid'>";
$result = mysql_query("SELECT * FROM `pages` WHERE `type` != 'Dropdown Menu'");
while ($r = mysql_fetch_array($result)) {
	$dropdownpageid = ($r['id']);
	$dropdownpagename = ($r['name']);
	echo"<option value=\"$dropdownpageid\">$dropdownpagename</option>";
}
echo"</select>";
echo"</td><td class=\"editpagehints\">
This is the page you want to add to your dropdown menu.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"submit\" name=\"submit\" value=\"Add Dropdown Menu Item\" />
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




