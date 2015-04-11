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
	$blogid = ($_POST['blogid']);
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
	$target = "../articlepictures/$pic";
	
	if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
	|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		mysql_query("UPDATE `blog` SET `picture`='$pic' WHERE `id` = '$blogid' ");
		
		move_uploaded_file($_FILES['pic']['tmp_name'], $target);
		
		
		//Make main image a max of 1000px

		if ($width > 1000) {
			$divider = ($width / 1000);
			$newwidth = 1000;
			$newheight = ($height / $divider);
			$save = "../articlepictures/$pic";
			$tn = imagecreatetruecolor($newwidth, $newheight) ; 
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			if ($_FILES["pic"]["type"] == "image/gif") {
				$image = imagecreatefromgif($target) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				imagegif($tn, $save, 100) ; 
			}
			if ($_FILES["pic"]["type"] == "image/jpeg") {
				$image = imagecreatefromjpeg($target) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				imagejpeg($tn, $save, 100) ; 
			}
			if ($_FILES["pic"]["type"] == "image/jpg") {
				$image = imagecreatefromjpeg($target) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				imagejpeg($tn, $save, 100) ; 
			}
			if ($_FILES["pic"]["type"] == "image/png") {
				$image = imagecreatefrompng($target) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				imagepng($tn, $save, 100) ; 
			}
			if ($_FILES["pic"]["type"] == "image/x-png") {
				$image = imagecreatefrompng($target) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				imagepng($tn, $save, 100) ; 
			}
			if ($_FILES["pic"]["type"] == "image/pjpeg") {
				$image = imagecreatefromjpeg($target) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				imagepng($tn, $save, 100) ; 
			}
		}
	
		
		header("Location: editblogentry.php?blogid=$blogid");
		exit;
	} else {
		header("Location: editblogentry.php?blogid=$blogid&message=1");
		exit;
	}
} else {

$message = ($_GET['message']);
$blogid = ($_GET['blogid']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery

echo"
<tr>
<td class=\"editpageleft\">Add New Photo:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
	echo"<tr><td align='center' colspan='6'>";
	echo"<form enctype='multipart/form-data' action=\"addmainblogphoto.php\" method='post'>
		<input name='pic' type='file' />
		<input type='hidden' name='blogid' value=\"$blogid\" />
		<input type='submit' name='submit' value='Upload New Photo' />
		</form>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($message == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
echo"</td><td class=\"editpagehints\">
This is the product's main image.
</td></tr></table";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




