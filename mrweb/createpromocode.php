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
	$code = ($_POST['code']);
	$name = ($_POST['name']);
	$discount = ($_POST['discount']);
	
	if (empty($_POST['code'])) {
		header("Location: createpromocode.php?error=1");
		exit;
	}

	$sql="INSERT INTO promocodes (code, name, discount) VALUES('$code','$name','$discount')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: store.php");
	exit;

} else {

$error = ($_GET['error']);
echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"createpromocode.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must fill in both fields.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}
	
	if ($error == 2) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must enter a domain name.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}

	echo"
	<tr>
	<td class=\"editpageleft\">Promo Code:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"code\" value=\"$code\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This will be the actual code users enter.
	</td>
	</tr>";
	
	/*
	echo"
	<tr>
	<td class=\"editpageleft\">Salesman Name:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This will be the person who issues this promo code.
	</td>
	</tr>";
	*/
	
	echo"
	<tr>
	<td class=\"editpageleft\">Disount %:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"discount\" value=\"$discount\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the percent that will be taken off the total price.<br />Only include the number.
	</td>
	</tr>


	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type=\"submit\" name=\"submit\" value=\"Add New Promo Code\" />
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




