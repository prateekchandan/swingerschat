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
	
	$result = mysql_query("SELECT * FROM $tablename");
	$fieldorder = mysql_num_rows($result);
	$fieldorder += 1;
	
	$sql="INSERT INTO $tablename (name, fieldorder) VALUES('$name','$fieldorder')";
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
echo"<form enctype='multipart/form-data' action=\"addservicecategory.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">Name of Category:</td>
<td class=\"editpageright\">";
echo"<input type='text' name='name' value=\"$name\" size='70'/>";
echo"</td><td class=\"editpagehints\">
This is the name of the field to be added.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"submit\" name=\"submit\" value=\"Add Category\" />
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




