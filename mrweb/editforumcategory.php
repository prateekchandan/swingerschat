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
	$name2 = ($_POST['name2']);
	$id = ($_POST['id']);
	$adminonly = ($_POST['adminonly']);
	if ($adminonly != 1) {
		$adminonly = 0;
	}
	/*
	$result = mysql_query('SELECT * FROM F_Categories WHERE name = "'.$name2.'"');
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		header("Location: editforumcategory.php?error=1&name=$name&id=$id");
		exit;
	}
	*/
	
	mysql_query("UPDATE `F_Categories` SET `name`= '$name2', `adminonly`='$adminonly' WHERE `id` = '$id' ");

	header("Location: forum.php?message=2");
	exit;
	
} else {

$id = ($_GET['id']);
$error = ($_GET['error']);

$result = mysql_query("SELECT * FROM `F_Categories` WHERE `id` = '$id'");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$adminonly = ($r['adminonly']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"editforumcategory.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"There is already a category with that name.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Forum Admin Only?</td>
<td class=\"editpageright\">
<input type=\"checkbox\" name=\"adminonly\" value=\"1\" "; if ($adminonly == 1) { echo"checked='checked'"; }  echo"/>
</td><td class=\"editpagehints\">
Check this if it only Forum Administrators can post in this section.
</td></tr>";
		
		
echo"
<tr>
<td class=\"editpageleft\">Category Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name2\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the category.
</td></tr>";


echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type='hidden' name='name' value=\"$name\" />
<input type='hidden' name='id' value=\"$id\" />
<input type=\"submit\" name=\"submit\" value=\"Edit Category\" />
<a href=\"forum.php\">Cancel</a>
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




