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
	$date = time();
	
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
	$target = "../ADS/$pic";
	
	if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
	|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png"))
	{
		$result = mysql_query("SELECT * FROM `ads` WHERE `id` = '$adid'");
        $r = mysql_fetch_array($result);
		$photo = ($r['photo']);
		
		unlink("../ADS/$photo");
		
		mysql_query("UPDATE `ads` SET `photo`='$pic' WHERE `id` = '$adid'");
		
		move_uploaded_file($_FILES['pic']['tmp_name'], $target);
		
		//require ('imagesxml.php');
		
		header("Location: ad.php?adid=$adid");
		exit;
	} else {
		header("Location: adnewimage.php?error=1&adid=$adid");
		exit;
	}
} else {
$adid = ($_GET['adid']);
$error = ($_GET['error']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery

echo"
<tr>
<td class=\"editpageleft\">Image:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
	echo"<tr><td align='center' colspan='6'>";
	echo"<form enctype='multipart/form-data' action=\"adnewimage.php\" method='post'>
		<input name='pic' type='file' />
		<input type='hidden' name='adid' value=\"$adid\" />
		<input type='submit' name='submit' value='Upload New Image' />
		</form>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($error == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Replace your current image with a new one.<br />Dimensions: $slidewidth px X $slideheight px
</td></tr></table";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




