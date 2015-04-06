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
	$optiontable = ($_POST['optiontable']);
	$name = ($_POST['name']);
	
	if (empty($_POST['name'])) {
		header("Location: addproductoption.php?error=1&optiontable=$optiontable");
		exit;
	}

	$sql="INSERT INTO $optiontable (name) VALUES('$name')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: store.php");
	exit;

} else {

$error = ($_GET['error']);
$optiontable = ($_GET['optiontable']);
echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"addproductoption.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must add a name.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";

	}

	echo"
	<tr>
	<td class=\"editpageleft\">Option:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the name of the option. <br />Example: Blue
	</td>
	</tr>


	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type='hidden' name='optiontable' value='$optiontable' />
	<input type=\"submit\" name=\"submit\" value=\"Add New Option\" />
	<input type=\"reset\" name=\"reset\" value=\"Reset\" />
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




