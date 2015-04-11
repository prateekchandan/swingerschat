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
	$name = ($_POST['service']);
	$category = ($_POST['category']);
	$price = ($_POST['price']);
	
	$result = mysql_query("SELECT * FROM `$tablename`");
	$fieldorder = mysql_num_rows($result);
	$fieldorder += 1;
	
	$sql="INSERT INTO $tablename (name, category, fieldorder, price) VALUES('$name','$category','$fieldorder','$price')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: editpage.php?pageid=$pageid");
	exit;
	
} else {

$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);
$categorytable = "ServiceCategories_" . $pageid;

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Add New Service
echo"<form enctype='multipart/form-data' action=\"addnewservice.php\" method='post'>";

echo"
<tr>
<td class=\"editpageleft\">Service Category:</td>
<td class=\"editpageright\">";
echo"<select name='category'>";
$result = mysql_query("SELECT * FROM `$categorytable` ORDER BY `fieldorder` ASC");
while ($r = mysql_fetch_array($result)) {
	$catid = ($r['id']);
	$category = ($r['name']);
	echo"<option value=\"$catid\">$category</option>";	
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
<textarea id=\"service\" name=\"service\">$service</textarea>
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
<input type=\"submit\" name=\"submit\" value=\"Add Service\" />
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




