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
	$text = ($_POST['text']);
	$title = ($_POST['title']);
	$blogid = ($_POST['blogid']);
	$vid = ($_POST['vid']);
	/*
	if (empty($_POST['text'])) {
		header("Location: editblogentry.php?error=1&blogid=$blogid");
		exit;
	}
	
	if (empty($_POST['title'])) {
		header("Location: editblogentry.php?error=1&blogid=$blogid");
		exit;
	}
	*/
	
	mysql_query("UPDATE `blog` SET `title`='$title', `text`='$text', `video` = '$vid'  WHERE `id` = '$blogid' ");
	
	header("Location: adminhome.php?message=5");
	exit;

} else {
$blogid = ($_GET['blogid']);
$error = ($_GET['error']);
$result = mysql_query("SELECT * FROM `blog` WHERE `id` = '$blogid'");
$r = mysql_fetch_array($result);
$title = ($r['title']);
$text = ($r['text']);
$pic1 = ($r['picture']);
$vid = ($r['video']);

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"editblogentry.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must fill in all * fields.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}
	
	if ($pic1 != "noimage.jpg") {
		echo"
		<tr>
		<td class=\"editpageleft\">Main Image:</td>
		<td class=\"editpageright\">";
			echo"<table cellpadding='0' cellspacing='1'>";
			echo"<tr>";
			echo"<td align='left' valign='middle'>";
			echo"<a href=\"../articlepictures/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='../articlepictures/$pic1' width='75px' height='75px'/></a>";
			echo"</td><td align='left' valign='middle'>";
			echo"<a href='deletemainblogphoto.php?blogid=$blogid&pic1=$pic1'>REMOVE PICTURE</a>";
			echo"</td></tr></table>";
		echo"</td><td class=\"editpagehints\">
		This is the main image for this blog post.
		</td></tr>";
	} else {
		echo"
		<tr>
		<td class=\"editpageleft\">Main Image:</td>
		<td class=\"editpageright\">";
			echo"<table cellpadding='0' cellspacing='1'>";
			echo"<tr>";
			echo"<td align='left' valign='middle'>";
			echo"<img src='../articlepictures/noimage.jpg' width='125px'/>";
			echo"</td><td align='left' valign='middle'>";
			echo"<a href=\"addmainblogphoto.php?blogid=$blogid\">Add New Photo</a>";
			echo"</td></tr></table>";
		echo"</td><td class=\"editpagehints\">
		This is the main image for this blog post.
		</td></tr>";
	}
	
	echo"
	<tr>
	<td class=\"editpageleft\">* Entry Title:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This will display as the title of the blog entry.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Blog Entry:</td>
	<td class=\"editpageright\">
	<textarea id=\"text\" name=\"text\">$text</textarea>
	<script type='text/javascript'>
	CKEDITOR.replace( 'text' );
	</script>
	</td>
	<td class=\"editpagehints\">
	This is the actual content that will make up the blog entry.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">YouTube Video:</td>
	<td class=\"editpageright\">
	<textarea name='vid' cols='40' rows='5'>$vid</textarea>
	</td>
	<td class=\"editpagehints\">
	You can paste youtube video code here.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Edit Comments:</td>
	<td class=\"editpageright\">
	<a href=\"editblogcomments.php?blogid=$blogid\">Edit Blog Comments</a>
	</td>
	<td class=\"editpagehints\">
	This will allow you to delete comments from the blog.
	</td>
	</tr>

	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type='hidden' name='blogid' value=\"$blogid\" />
	<input type=\"submit\" name=\"submit\" value=\"SAVE CHANGES\" />
	<input type=\"reset\" name=\"reset\" value=\"Reset\" />
	<a href=\"adminhome.php?message=3\">Discard Changes</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a href='deleteblogentry.php?blogid=$blogid' onclick=\"return confirm('Are you sure you want to delete this blog entry?');\">Delete Entry</a>
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




