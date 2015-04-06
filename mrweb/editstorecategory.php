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
	$name2 = ($_POST['name2']);
	$text1 = ($_POST['text1']);
	
	if (empty($_POST['name'])) {
		header("Location: editstorecategory.php?error=1&id=$categoryid");
		exit;
	}
	
	mysql_query("UPDATE `store_categories` SET `name`= '$name', `name2`='$name2', `text`= '$text1' WHERE `id` = '$categoryid' ");

	header("Location: store.php");
	exit;
	
} else {
$error = ($_GET['error']);
$categoryid = ($_GET['id']);

$result = mysql_query("SELECT * FROM store_categories WHERE id = $categoryid");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$name2 = ($r['name2']);
$pic1 = ($r['photo']);
$pic2 = ($r['mainimage']);
$text1 = ($r['text']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"editstorecategory.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
	<td class=\"editpageright\">You must have a name for this category.
	</td>
	<td class=\"editpagehints\">
	</td>
	</tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Category Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the category.
</td></tr>";

/*
echo"
<tr>
<td class=\"editpageleft\">Category Name Description:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name2\" value=\"$name2\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the desription of the category.
</td></tr>";


if ($pic2 != "noimage.jpg") {
	echo"
	<tr>
	<td class=\"editpageleft\">Main Category Image:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<img src='../categories_main/$pic2' width='100px' />";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href='deletemaincategoryphoto.php?categoryid=$categoryid&pic2=$pic2'>REMOVE PICTURE</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the main image for this category. <br /> Dimensions: 772px X 111px
	</td></tr>";
} else {
	echo"
	<tr>
	<td class=\"editpageleft\">Main Category Image:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"No image uploaded.   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href=\"addmaincategoryphoto.php?categoryid=$categoryid\">Add New Photo</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the main image for this category.<br /> Dimensions: 772px X 111px
	</td></tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Text Section 1:</td>
<td class=\"editpageright\">
<textarea id=\"text01\" name=\"text1\">$text1</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('text01');
</script>
</td>
<td class=\"editpagehints\">
This text will appear in the main content section for this category.
</td>
</tr>";
*/
echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"id\" value=\"$categoryid\" />
<input type=\"submit\" name=\"submit\" value=\"Edit Category\" />
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




