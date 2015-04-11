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
	$fieldid = ($_POST['fieldid']);
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
	$target = "../profilepics/$pic";
	
	if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
	|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		mysql_query("UPDATE `$tablename` SET `pic`='$pic' WHERE `id` = '$fieldid' ");
		
		move_uploaded_file($_FILES['pic']['tmp_name'], $target);
		
		
		//Create Cropped Thumbnail
		//getting the image dimensions
		list($width, $height) = getimagesize($target);
		
		//saving the image into memory (for manipulation with GD Library)
		$myImage = imagecreatefromjpeg($target);
		
		//setting the crop size
		if($width > $height) $biggestSide = $width;
		else $biggestSide = $height;
		
		//The crop size will be half that of the largest side
		$cropPercent = .5;
		$cropWidth   = $biggestSide*$cropPercent;
		$cropHeight  = $biggestSide*$cropPercent;
		
		//getting the top left coordinate
		$c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/2);
		
		// Creating the thumbnail
		$thumbSize = 110;
		$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
		
		
		
		$save = "../profilepics/thumbs/$pic"; //This is the new file you saving
		
		if ($_FILES["pic"]["type"] == "image/gif") {
			$image = imagecreatefromgif($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagegif($thumb, $save, 100) ; 
		}
		if ($_FILES["pic"]["type"] == "image/jpeg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagejpeg($thumb, $save, 100) ; 
		}
		if ($_FILES["pic"]["type"] == "image/jpg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagejpeg($thumb, $save, 100) ; 
		}
		if ($_FILES["pic"]["type"] == "image/png") {
			$image = imagecreatefrompng($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagepng($thumb, $save, 100) ; 
		}
		if ($_FILES["pic"]["type"] == "image/x-png") {
			$image = imagecreatefrompng($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagepng($thumb, $save, 100) ; 
		}
		if ($_FILES["pic"]["type"] == "image/pjpeg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagepng($thumb, $save, 100) ; 
		}
		
		header("Location: editprofile.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid");
		exit;
	} else {
		header("Location: addprofilephoto.php?pageid=$pageid&message=1&tablename=$tablename&fieldid=$fieldid");
		exit;
	}
} else {

$message = ($_GET['message']);
$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);
$fieldid = ($_GET['fieldid']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery

echo"
<tr>
<td class=\"editpageleft\">Add New Photo:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
	echo"<tr><td align='center' colspan='6'>";
	echo"<form enctype='multipart/form-data' action=\"addprofilephoto.php\" method='post'>
		<input name='pic' type='file' />
		<input type='hidden' name='pageid' value=\"$pageid\" />
		<input type='hidden' name='tablename' value=\"$tablename\" />
		<input type='hidden' name='fieldid' value=\"$fieldid\" />
		<input type='submit' name='submit' value='Upload New Photo' />
		</form>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($message == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
	echo"<br /><a href=\"editprofile.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\">Cancel</a>";
echo"</td><td class=\"editpagehints\">
This is the image for this profile.
</td></tr></table";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




