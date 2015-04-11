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
	$category = ($_POST['category']);
	$subcategory = ($_POST['subcategory']);
	$brand = ($_POST['brand']);
	$productid = ($_POST['productid']);
	
	$sql="INSERT INTO `products` (category, subcategory, ghost, quantity) VALUES('$category','$subcategory','$productid','500')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
		
	header("Location: editproduct3.php?id=$productid");
	exit;
	
} else {

$error = ($_GET['error']);
$productid = ($_GET['productid']);


echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

	
echo"<form enctype='multipart/form-data' action=\"ghostcategory.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">*Category:</td>
<td class=\"editpageright\">";
echo'<select name="category">';
$result = mysql_query('SELECT * FROM `store_categories` ORDER BY `pageorder` ASC');
while ($r = mysql_fetch_array($result)) {
	$categoryname = ($r['name']);
	$categoryid = ($r['id']);
	if ($category == $categoryname) {
		echo"<option value='$categoryid' selected='selected'>$categoryname</option>";
	} else {
		echo"<option value='$categoryid'>$categoryname</option>";
	}
}
echo'</select>';
echo"</td><td class=\"editpagehints\">
This is the category the product will be under.
</td></tr>";


echo"
<tr>
<td class=\"editpageleft\">Sub-Category:</td>
<td class=\"editpageright\">";
echo'<select name="subcategory">';
//echo"<option value=''>No Sub-Category</option>";
$result = mysql_query('SELECT * FROM `store_subcategories` ORDER BY `pageorder` ASC');
while ($r = mysql_fetch_array($result)) {
	$categoryname = ($r['name']);
	$categoryid = ($r['id']);
	if ($subcategory == $categoryid) {
		echo"<option value='$categoryid' selected='selected'>$categoryname</option>";
	} else {
		echo"<option value='$categoryid'>$categoryname</option>";
	}

}
echo'</select>';
echo"</td><td class=\"editpagehints\">
This is the sub-category the product will be under.
</td></tr>";

/*
echo"
<tr>
<td class=\"editpageleft\">*Brand:</td>
<td class=\"editpageright\">";
echo'<select name="brand">';
$result = mysql_query('SELECT * FROM `store_brands` ORDER BY `name` ASC');
while ($r = mysql_fetch_array($result)) {
	$categoryname = ($r['name']);
	$categoryid = ($r['id']);
	if ($category == $categoryname) {
		echo"<option value='$categoryid' selected='selected'>$categoryname</option>";
	} else {
		echo"<option value='$categoryid'>$categoryname</option>";
	}
}
echo'</select>';
echo"</td><td class=\"editpagehints\">
This is the brand the product will be under.
</td></tr>";
 */


echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"productid\" value=\"$productid\" />
<input type=\"submit\" name=\"submit\" value=\"Add New Category\" />
<a href=\"editproduct3.php?id=$productid\">Cancel</a>
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




