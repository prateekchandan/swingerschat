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
	$productid = ($_POST['productid']);
	$optionid = ($_POST['optionid']);
	$tablename = ($_POST['tablename']);
	$name = ($_POST['name']);
	$price = ($_POST['price']);
	
	if (empty($_POST['name'])) {
		header("Location: editoptionname.php?productid=$productid&optionid=$optionid&tablename=$tablename");
		exit;
	}
	
	mysql_query("UPDATE `$tablename` SET `name`= '$name', `price`='$price' WHERE `id` = '$optionid' ");

	header("Location: editproduct3.php?id=$productid");
	exit;
	
} else {
$error = ($_GET['error']);
$productid = ($_GET['productid']);
$optionid = ($_GET['optionid']);
$tablename = ($_GET['tablename']);

$result = mysql_query("SELECT * FROM `$tablename` WHERE `id` = '$optionid'");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$price = ($r['price']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"editoptionname.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
	<td class=\"editpageright\">You must have a name for this option.
	</td>
	<td class=\"editpagehints\">
	</td>
	</tr>";
}

echo"
<tr>
<td class=\"editpageleft\">Option Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of this option.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Option Price:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"price\" value=\"$price\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the extra charge for this option. Do not include $ sign.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"productid\" value=\"$productid\" />
<input type=\"hidden\" name=\"optionid\" value=\"$optionid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"submit\" name=\"submit\" value=\"Save Changes\" />
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




