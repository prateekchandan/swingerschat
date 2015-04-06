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
	$type = ($_POST['type']);
	$plain = ($_POST['plain']);
	
	mysql_query("UPDATE `$tablename` SET `name`= '$name', `type`='$type', `plaintext`='$plain' WHERE `id` = '$fieldid' ");

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
$type = ($r['type']);
$plain = ($r['plaintext']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"editfield.php\" method='post'>";

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

echo"
<tr>
<td class=\"editpageleft\">Name of Field:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" />";
echo"</td><td class=\"editpagehints\">
This is the name of the field to be added.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Type of Field:</td>
<td class=\"editpageright\">";
echo"<select name='type'>";
echo"<option value='text'"; if ($type == "text") {echo"selected='selected'"; } echo">Text (regular field)</option>";
echo"<option value='textarea' "; if ($type == "textarea") {echo"selected='selected'"; } echo">Text Area (large comment area)</option>";
echo"<option value='plaintext' "; if ($type == "plaintext") {echo"selected='selected'"; } echo">Plain Text (no user input)</option>";
echo"</select>";
echo"</td><td class=\"editpagehints\">
This is the type of field to be added.
</td></tr>";


echo"
<tr>
<td class=\"editpageleft\">Plain Text:</td>
<td class=\"editpageright\">
<textarea id=\"plain\" name=\"plain\">$plain</textarea>
<script type='text/javascript'>
			CKEDITOR.replace( 'plain' );
			</script>
</td><td class=\"editpagehints\">
This is if you chose to have plain text.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"hidden\" name=\"fieldid\" value=\"$fieldid\" />
<input type=\"submit\" name=\"submit\" value=\"Edit Form Field\" />
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




