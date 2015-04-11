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
	$name = ($_POST['service']);
	$category = ($_POST['category']);
	
	
	mysql_query("UPDATE `$tablename` SET `name`= '$name', `category`='$category', `price`='$price' WHERE `id` = '$fieldid' ");

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
$category = ($r['category']);
$price = ($r['price']);

$categorytable = "ServiceCategories_" . $pageid;

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"editservice.php\" method='post'>";

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
<td class=\"editpageleft\">Service Category:</td>
<td class=\"editpageright\">";
echo"<select name='category'>";
$result = mysql_query("SELECT * FROM `$categorytable` ORDER BY `fieldorder` ASC");
while ($r = mysql_fetch_array($result)) {
	$catid = ($r['id']);
	$categoryname = ($r['name']);
	if ($fieldid == $catid) {
		echo"<option value=\"$catid\" selected='selected'>$categoryname</option>";	
	} else {
		echo"<option value=\"$catid\">$categoryname</option>";	
	}
}
echo"</select>";
echo"</td><td class=\"editpagehints\">
This is the category your service will fall under.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Service:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"service\" name=\"service\">$name</textarea>
<script type='text/javascript'>
			CKEDITOR.replace( 'service' );
			</script>";
echo"</td><td class=\"editpagehints\">
This is the name or description of the service you want to add.
</td></tr>";
/*
echo"
<tr>
<td class=\"editpageleft\">Price:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"serviceprice\" name=\"price\">$price</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('serviceprice');
</script>";
echo"</td><td class=\"editpagehints\">
This is the price of the service you are listing.
</td></tr>";
*/
echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"hidden\" name=\"fieldid\" value=\"$fieldid\" />
<input type=\"submit\" name=\"submit\" value=\"SAVE CHANGES\" />
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




