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
	$category = ($_POST['category']);
	$month = ($_POST['month']);
	$day = ($_POST['day']);
	$year = ($_POST['year']);
	$amount = ($_POST['amount']);
	
	$month = str_pad($month, 2, 0, STR_PAD_LEFT);
	$day = str_pad($day, 2, 0, STR_PAD_LEFT);
	$date = $month;
	$date .= "/";
	$date .= $day;
	$date .= "/";
	$date .= $year;
	
	$sql="INSERT INTO `finance` (name, category, amount, date) VALUES ('$name','$category','$amount','$date')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	header("Location: finance.php?message=1");
	exit;

} else {

$date = date('m');
$date .= "/";
$date .= date('d');
$date .= "/";
$date .= date('Y');
$date .= " ";
$date .= date('g');
$date .= ":";
$date .= date('i');
$date .= date('a');

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"financepayment.php\" method=\"post\">";
	
	
	echo"
	<tr>
	<td class=\"editpageleft\">Payment Description:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the description of your payment.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Payment Amount:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"amount\" value=\"$amount\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the amount of the payment.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Payment Category:</td>
	<td class=\"editpageright\">
	<select name='category'>
	<option value='Advertising'>Advertising</option>
	<option value='Supplies'>Supplies</option>
	<option value='Postage'>Postage</option>
	<option value='Merchant Account'>Merchant Account</option>
	<option value='Website'>Website</option>
	<option value='Other'>Other</option>
	</select>
	</td>
	<td class=\"editpagehints\">
	This is the category of your payment.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Payment Date:</td>
	<td class=\"editpageright\">
	Month:
	<select name='month'>";
	$count = 01;
	while ($count < 13) {
		if (date('m') == $count) {
			echo"<option value='$count' selected='selected'>$count</option>";
		} else {
			echo"<option value='$count'>$count</option>";
		}
	$count += 1;
	}
	echo"
	</select>
	Day:
	<select name='day'>";
	$count = 01;
	while ($count < 32) {
		if (date('d') == $count) {
			echo"<option value='$count' selected='selected'>$count</option>";
		} else {
			echo"<option value='$count'>$count</option>";
		}
	$count += 1;
	}
	echo"
	</select>
	Year:
	<select name='year'>";
	$year1 = (date('Y') - 5);
	$count = 1;
	while ($count < 7) {
		if (date('Y') == $year1) {
			echo"<option value='$year1' selected='selected'>$year1</option>";
		} else {
			echo"<option value='$year1'>$year1</option>";
		}
	$count += 1;
	$year1 += 1;
	}
	echo"
	</select>
	</td>
	<td class=\"editpagehints\">
	This is the date the payment was made.
	</td>
	</tr>
	
	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type=\"submit\" name=\"submit\" value=\"Make Payment\" />
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




