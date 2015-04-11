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
	$vid = ($_POST['vid']);
	
	$returnvalues = "&title=$title";
	
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
	
	$date = time();
	
	// Do picture
	function findexts ($filename)
	{
	$filename = strtolower($filename) ;
	$exts = split("[/\\.]", $filename) ;
	$n = count($exts)-1;
	$exts = $exts[$n];
	return $exts;
	}
	
	//This applies the function to our file
	$ext = findexts ($_FILES['pic']['name']) ; 
	
	$pic = $date . "." . $ext;
	$target = "../articlepictures/$pic";
	$phototrue = 0;
	if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
	|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		/*
		$result = mysql_query('SELECT * FROM members WHERE id = "'.$memberid.'"');
		$r = mysql_fetch_array($result);
		$photo = ($r['photo']);
		unlink("members/$photo");
		*/
		
		$filesize = filesize($_FILES['pic']['tmp_name']);
		$mb = 1048576;
		$eightmb = ($mb * 8);
		if ($filesize < $eightmb) {
			move_uploaded_file($_FILES['pic']['tmp_name'], $target);
			
			$sql="INSERT INTO blog (title, text, memberid, date, video, picture, approved) VALUES('$title','$text','$memberid','$date','$vid','$pic','1')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: 51');
			}
			$phototrue = 1;
		} else {
			$sql="INSERT INTO blog (title, text, memberid, date, video, approved) VALUES('$title','$text','$memberid','$date','$vid','1')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: 52');
			}
			$phototrue = 2;
		}
		
	} else {
	
		$sql="INSERT INTO blog (title, text, memberid, date, video, approved) VALUES('$title','$text','$memberid','$date','$vid','1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: 53');
		}
	}
	
	header("Location: adminhome.php");
	exit;

} else {

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"addblogentry.php\" method=\"post\">
	
	<tr>
	<td class=\"editpageleft\">Entry Title:</td>
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
	<textarea id=\"text\" name=\"text\"></textarea>
	<script type='text/javascript'>
	CKEDITOR.replace( 'text' );
	</script>
	</td>
	<td class=\"editpagehints\">
	This is the actual content that will make up the blog entry.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Upload Picture</td>
	<td class=\"editpageright\">
	<input name='pic' type='file' /> <br /><span style='font-size:10px;'>(Max File Size: 8 MB)</span>
	</td>
	<td class=\"editpagehints\">
	This is where you can add a picture to the post.
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
	<td class=\"editpageleft\"></td>
	<td class=\"editpageright\" align=\"left\" valign=\"top\">
	<input type=\"submit\" name=\"submit\" value=\"Post Blog Entry\" />
	<input type=\"reset\" name=\"reset\" value=\"Reset\" />
	<br /><br />
	</form>
	</td>
	<td class=\"editpagehints\">
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




