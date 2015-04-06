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
	$adid = ($_POST['adid']);
	$domain = $_POST['domain'];
	$caption = ($_POST['caption']);
	
	if (empty($_POST['domain'])) {
		$domain = "No Link";
	}

	mysql_query("UPDATE `ads` SET `domain`='$domain', `caption`='$caption' WHERE `id` = '$adid' ");
	
	//require ('imagesxml.php');
	
	header("Location: adminhome.php");
	
	exit;

} else {

$error = ($_GET['error']);
$adid = ($_GET['adid']);
$result = mysql_query("SELECT * FROM `ads` WHERE `id`= '$adid'");
$r = mysql_fetch_array($result);
$domain = ($r['domain']);
$photo = ($r['photo']);
$totalclicks = ($r['totalclicks']);
$currentclicks = ($r['currentclicks']);
$spot = ($r['spot']);
$caption = ($r['caption']);
echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"ad.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must upload an image.
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
	<td class=\"editpageleft\">Link:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"domain\" value=\"$domain\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the page users will be directed to when they click the ad. Leave blank if you don't want the slide to be clickable.
	</td>
	</tr>
	

	<tr>
	<td class=\"editpageleft\">Caption:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"caption\" value=\"$caption\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the caption for the image.
	</td>
	</tr>

	
	<tr>
	<td class=\"editpageleft\">Image:</td>
	<td class=\"editpageright\">
	<img src=\"../ADS/$photo\" width='300px'><br /><a href=\"adnewimage.php?adid=$adid\">Replace Image</a>
	</td>
	<td class=\"editpagehints\">
	This is the image that is displayed for the slide.<br />Dimensions: $slidewidth X $slideheight
	</td>
	</tr>

	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type='hidden' name='adid' value=\"$adid\" />
	<input type=\"submit\" name=\"submit\" value=\"Edit Slide\" />
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




