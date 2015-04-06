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
	$name = ($_POST['name']);
	
	if (empty($_POST['name'])) {
		header("Location: addstoresubcategory?error=1");
		exit;
	}
	
	$result = mysql_query("SELECT * FROM `store_subcategories`");
	$pageorder = mysql_num_rows($result);
	$pageorder += 1;
	

	
	$sql="INSERT INTO `store_subcategories` (name, pageorder) VALUES('$name','$pageorder')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}


	header("Location: store.php");
	exit;
	
} else {


echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"addstoresubcategory.php\" method='post'>";

if ($error == 1) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
<td class=\"editpageright\">You must fill in all *required fields.
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
<input type=\"submit\" name=\"submit\" value=\"Add Sub-Category\" />
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




