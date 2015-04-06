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
	$categoryid = ($_POST['id']);
	$name = ($_POST['name']);
	
	if (empty($_POST['name'])) {
		header("Location: editstoresubcategory.php?error=1&id=$categoryid");
		exit;
	}
	
	mysql_query("UPDATE `store_subcategories` SET `name`= '$name' WHERE `id` = '$categoryid' ");

	header("Location: store.php");
	exit;
	
} else {
$error = ($_GET['error']);
$categoryid = ($_GET['id']);

$result = mysql_query("SELECT * FROM store_subcategories WHERE id = $categoryid");
$r = mysql_fetch_array($result);
$name = ($r['name']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"editstoresubcategory.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
	<td class=\"editpageright\">You must have a name for this sub-category.
	</td>
	<td class=\"editpagehints\">
	</td>
	</tr>";
}

echo"
<tr>
<td class=\"editpageleft\">*Sub-Category Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the sub-category.
</td></tr>";



echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"id\" value=\"$categoryid\" />
<input type=\"submit\" name=\"submit\" value=\"Edit Sub-Category\" />
<a href=\"store.php\">Cancel</a>
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




