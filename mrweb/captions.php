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
	$pageid = ($_POST['pageid']);
	$tablename = ($_POST['tablename']);
	$photoid = ($_POST['photoid']);
	$text1= ($_POST['text1']);
	
	mysql_query("UPDATE `$tablename` SET `caption`='$text1' WHERE `id` = '$photoid' ");

	header("Location: editpage.php?pageid=$pageid");
	exit;
	
} else {

	$photoid = ($_GET['photoid']);
	$tablename = ($_GET['tablename']);
	$pageid = ($_GET['pageid']);
	$result = mysql_query("SELECT * FROM `$tablename` WHERE `id` = '$photoid'");
	$r = mysql_fetch_array($result);
	$text1 = ($r['caption']);
	
	echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
	//Edit Photo Gallery
	echo"<form enctype='multipart/form-data' action='captions.php' method='post'>";
	
	echo"
	<tr>
	<td class=\"editpageleft\">Edit Caption:</td>
	<td class=\"editpageright\">";
		echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
		echo"<tr><td align='center' colspan='6'>
			<textarea id=\"text1\" name=\"text1\">$text1</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'text1' );
			</script>";
		echo"</td></tr>";
		echo"</table>";
	echo"</td><td class=\"editpagehints\">
	Edit the caption for this photo.
	</td></tr>
	
	
	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type='hidden' name='tablename' value=\"$tablename\" />
	<input type='hidden' name='photoid' value=\"$photoid\" />
	<input type='hidden' name='pageid' value=\"$pageid\" />
	<input type=\"submit\" name=\"submit\" value=\"Edit Caption\" />
	<a href=\"editpage.php?pageid=$pageid\">Back</a>
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




