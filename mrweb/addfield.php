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
	$name = ($_POST['name']);
	$plain = ($_POST['plain']);
	$type = ($_POST['type']);
	
	$result = mysql_query("SELECT * FROM $tablename");
	$fieldorder = mysql_num_rows($result);
	$fieldorder += 1;
	
	$sql="INSERT INTO $tablename (name, type, plaintext, fieldorder) VALUES('$name','$type','$plain','$fieldorder')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	if ($type == "checkbox") {
		$result = mysql_query("SELECT * FROM $tablename ORDER BY id DESC");
		$r = mysql_fetch_array($result);
		$fieldid = ($r['id']);
		$tablename2 = $tablename . "_" . $fieldid;
		$sql = "CREATE TABLE $tablename2 (id int AUTO_INCREMENT, name text, fieldid int, fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	if ($type == "dropdown") {
		$result = mysql_query("SELECT * FROM $tablename ORDER BY id DESC");
		$r = mysql_fetch_array($result);
		$fieldid = ($r['id']);
		$tablename2 = $tablename . "_" . $fieldid;
		$sql = "CREATE TABLE $tablename2 (id int AUTO_INCREMENT, name text, fieldid int, fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	if ($type == "radio") {
		$result = mysql_query("SELECT * FROM $tablename ORDER BY id DESC");
		$r = mysql_fetch_array($result);
		$fieldid = ($r['id']);
		$tablename2 = $tablename . "_" . $fieldid;
		$sql = "CREATE TABLE $tablename2 (id int AUTO_INCREMENT, name text, fieldid int, fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}

	header("Location: editpage.php?pageid=$pageid");
	exit;
	
} else {

$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"addfield.php\" method='post'>";
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
echo"<option value='text'>Text (regular field)</option>";
echo"<option value='textarea'>Text Area (large comment area)</option>";
echo"<option value='checkbox'>Checkboxes</option>";
echo"<option value='radio'>Radio Buttons</option>";
echo"<option value='dropdown'>Dropdown Menu</option>";
echo"<option value='plaintext'>Plain Text (no user input)</option>";
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
<input type=\"submit\" name=\"submit\" value=\"Add Form Field\" />
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




