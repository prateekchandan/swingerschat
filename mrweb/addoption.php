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
	$productid= ($_POST['productid']);
	$option = ($_POST['option']);

	
	$returnvalues = "&name=$name&productid=$productid&option=$option";
	
	if ( (empty($_POST['name'])) ) {
		header("Location: addoption.php?error=1 $returnvalues");
		exit;
	}
	
	$table = "product_option" . $option . "_list";

	$sql="INSERT INTO `$table` (name) VALUES('$name')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: editproduct3.php?id=$productid");
	exit;

} else {

$error = ($_GET['error']);
$option = ($_GET['option']);
$productid = ($_GET['productid']);


echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

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
	
echo"<form enctype='multipart/form-data' action=\"addoption.php\" method='post'>";

echo"
<tr>
<td class=\"editpageleft\">*Option:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"50\" />";
echo"</td><td class=\"editpagehints\">
This is the name of the option.
</td></tr>";


echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type='hidden' name='option' value='$option' />
<input type='hidden' name='productid' value='$productid' />
<input type=\"submit\" name=\"submit\" value=\"Add New Option\" />
<a href=\"editproduct3.php?id=$productid\">Go Back Without Saving</a>
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




