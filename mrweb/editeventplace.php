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
	$address = ($_POST['address']);
	$city = ($_POST['city']);
	$state = ($_POST['state']);
	$zip = ($_POST['zip']);
	$phone = ($_POST['phone']);
	$id = ($_POST['id']);
	$pic1 = ($_POST['pic1']);
	$text = ($_POST['text']);
	
	$returnvalues = "&name=$name&address=$address&city=$city&state=$state&zip=$zip&phone=$phone&pic1=$pic1&text=$text";
	
	if ( (empty($_POST['name'])) || (empty($_POST['address'])) || (empty($_POST['city'])) || (empty($_POST['state'])) || (empty($_POST['zip'])) ) {
		header("Location: editeventplace.php?error=1 $returnvalues");
		exit;
	}

	mysql_query("UPDATE `events_places` SET `name`='$name', `address`='$address', `city`='$city', `state`='$state', `zip`='$zip', `phone`='$phone', `text`='$text' WHERE `id` = '$id' ");
		
	header("Location: editeventplace.php?error=2 $returnvalues");
	exit;

	
} else {


$id = ($_GET['id']);

if (isset($_GET['error'])) {
	$error = ($_GET['error']);
	$name = ($_GET['name']);
	$address = ($_GET['address']);
	$city = ($_GET['city']);
	$state = ($_GET['state']);
	$zip = ($_GET['zip']);
	$phone = ($_GET['phone']);
	$id = ($_GET['id']);
	$pic1 = ($_GET['pic1']);
	$text = ($_GET['text']);
} else {
	$result = mysql_query("SELECT * FROM `events_places` WHERE `id` = '$id'");
	$r = mysql_fetch_array($result);
	$name = ($r['name']);
	$address = ($r['address']);
	$city = ($r['city']);
	$state = ($r['state']);
	$zip = ($r['zip']);
	$phone = ($r['phone']);
	$pic1 = ($r['photo']);
	$text = ($r['text']);
}

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

if ($error == 2) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#0aaa0a;'>Success:</td>
<td class=\"editpageright\">You successfully updated this place.
</td>
<td class=\"editpagehints\">
</td>
</tr>";
}
	
echo"<form enctype='multipart/form-data' action=\"editeventplace.php\" method='post'>";

echo"
<tr>
<td class=\"editpageleft\">*Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"50\" />";
echo"</td><td class=\"editpagehints\">
This is the name of the product.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*Address:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"address\" value=\"$address\" size=\"50\" />";
echo"</td><td class=\"editpagehints\">
This is the street address for the place.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*City:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"city\" value=\"$city\" size=\"50\"/>";
echo"</td><td class=\"editpagehints\">
This is the city the place is in.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*State:</td>
<td class=\"editpageright\">";
?>
<select name="state" size="1" class="formfields" style="width: 49; height: 19">
<option value="AL" <?php if ($state == "AL") { echo"selected='selected'"; } ?> >AL</option>
<option value="AK" <?php if ($state == "AK") { echo"selected='selected'"; } ?> >AK</option>
<option value="AZ" <?php if ($state == "AZ") { echo"selected='selected'"; } ?> >AZ</option>
<option value="AR" <?php if ($state == "AR") { echo"selected='selected'"; } ?> >AR</option>
<option value="CA" <?php if ($state == "CA") { echo"selected='selected'"; } ?> >CA</option> 
<option value="CO" <?php if ($state == "CO") { echo"selected='selected'"; } ?> >CO</option> 
<option value="CT" <?php if ($state == "CT") { echo"selected='selected'"; } ?> >CT</option> 
<option value="DE" <?php if ($state == "DE") { echo"selected='selected'"; } ?> >DE</option> 
<option value="DC" <?php if ($state == "DC") { echo"selected='selected'"; } ?> >DC</option> 
<option value="FL" <?php if ($state == "FL") { echo"selected='selected'"; } ?> >FL</option> 
<option value="GA" <?php if ($state == "GA") { echo"selected='selected'"; } ?> >GA</option> 
<option value="HI" <?php if ($state == "HI") { echo"selected='selected'"; } ?> >HI</option> 
<option value="ID" <?php if ($state == "ID") { echo"selected='selected'"; } ?> >ID</option> 
<option value="IL" <?php if ($state == "IL") { echo"selected='selected'"; } ?> >IL</option> 
<option value="IN" <?php if ($state == "IN") { echo"selected='selected'"; } ?> >IN</option> 
<option value="IA" <?php if ($state == "IA") { echo"selected='selected'"; } ?> >IA</option> 
<option value="KS" <?php if ($state == "KS") { echo"selected='selected'"; } ?> >KS</option> 
<option value="KY" <?php if ($state == "KY") { echo"selected='selected'"; } ?> >KY</option> 
<option value="LA" <?php if ($state == "LA") { echo"selected='selected'"; } ?> >LA</option> 
<option value="ME" <?php if ($state == "ME") { echo"selected='selected'"; } ?> >ME</option> 
<option value="MD" <?php if ($state == "MD") { echo"selected='selected'"; } ?> >MD</option> 
<option value="MA" <?php if ($state == "MA") { echo"selected='selected'"; } ?> >MA</option> 
<option value="MI" <?php if ($state == "MI") { echo"selected='selected'"; } ?> >MI</option> 
<option value="MN" <?php if ($state == "MN") { echo"selected='selected'"; } ?> >MN</option> 
<option value="MS" <?php if ($state == "MS") { echo"selected='selected'"; } ?> >MS</option> 
<option value="MO" <?php if ($state == "MO") { echo"selected='selected'"; } ?> >MO</option> 
<option value="MT" <?php if ($state == "MT") { echo"selected='selected'"; } ?> >MT</option> 
<option value="NE" <?php if ($state == "NE") { echo"selected='selected'"; } ?> >NE</option> 
<option value="NV" <?php if ($state == "NV") { echo"selected='selected'"; } ?> >NV</option> 
<option value="NH" <?php if ($state == "NH") { echo"selected='selected'"; } ?> >NH</option> 
<option value="NJ" <?php if ($state == "NJ") { echo"selected='selected'"; } ?> >NJ</option> 
<option value="NM" <?php if ($state == "NM") { echo"selected='selected'"; } ?> >NM</option> 
<option value="NY" <?php if ($state == "NY") { echo"selected='selected'"; } ?> >NY</option> 
<option value="NC" <?php if ($state == "NC") { echo"selected='selected'"; } ?> >NC</option> 
<option value="ND" <?php if ($state == "ND") { echo"selected='selected'"; } ?> >ND</option> 
<option value="OH" <?php if ($state == "OH") { echo"selected='selected'"; } ?> >OH</option> 
<option value="OK" <?php if ($state == "OK") { echo"selected='selected'"; } ?> >OK</option> 
<option value="OR" <?php if ($state == "OR") { echo"selected='selected'"; } ?> >OR</option> 
<option value="PA" <?php if ($state == "PA") { echo"selected='selected'"; } ?> >PA</option> 
<option value="RI" <?php if ($state == "RI") { echo"selected='selected'"; } ?> >RI</option> 
<option value="SC" <?php if ($state == "SC") { echo"selected='selected'"; } ?> >SC</option> 
<option value="SD" <?php if ($state == "SD") { echo"selected='selected'"; } ?> >SD</option> 
<option value="TN" <?php if ($state == "TN") { echo"selected='selected'"; } ?> >TN</option> 
<option value="TX" <?php if ($state == "TX") { echo"selected='selected'"; } ?>>TX</option> 
<option value="UT" <?php if ($state == "UT") { echo"selected='selected'"; } ?> >UT</option> 
<option value="VT" <?php if ($state == "VT") { echo"selected='selected'"; } ?> >VT</option> 
<option value="VA" <?php if ($state == "VA") { echo"selected='selected'"; } ?> >VA</option> 
<option value="WA" <?php if ($state == "WA") { echo"selected='selected'"; } ?> >WA</option> 
<option value="WV" <?php if ($state == "WV") { echo"selected='selected'"; } ?> >WV</option> 
<option value="WI" <?php if ($state == "WI") { echo"selected='selected'"; } ?> >WI</option> 
<option value="WY" <?php if ($state == "WY") { echo"selected='selected'"; } ?> >WY</option>
</select>
<?php
echo"</td><td class=\"editpagehints\">
This is the state the place is in.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*Zip:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"zip\" value=\"$zip\" size=\"50\"/>";
echo"</td><td class=\"editpagehints\">
This is the zip code the place is in.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Phone:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"phone\" value=\"$phone\" size=\"50\"/>";
echo"</td><td class=\"editpagehints\">
This is the contact phone number for this place.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Description:</td>
<td class=\"editpageright\">
<textarea id=\"text01\" name=\"text\">$text</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('text01');
</script>
</td>
<td class=\"editpagehints\">
This is the description of the place.
</td>
</tr>";


if ($pic1 != "noimage.jpg") {
	echo"
	<tr>
	<td class=\"editpageleft\">Place Photo:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<a href=\"../eventplaces/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='../eventplaces/$pic1' width='75px' height='75px'/></a>";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href='deleteeventplaceimage.php?id=$id&pic1=$pic1'>REMOVE PICTURE</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the photo for this place.
	</td></tr>";
} else {
	echo"
	<tr>
	<td class=\"editpageleft\">Place Photo:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<img src='../eventplaces/noimage.jpg' width='125px'/>";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href=\"addeventplacephoto.php?id=$id\">Add New Photo</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the photo for this place.
	</td></tr>";
}

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type='hidden' name='id' value='$id' />
<input type='hidden' name='pic1' value='$pic1' />
<input type=\"submit\" name=\"submit\" value=\"SAVE CHANGES\" />
<a href=\"events.php\">Go Back to Events</a>
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




