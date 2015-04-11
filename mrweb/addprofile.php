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
	$name = ($_POST['name']);
	$bio = ($_POST['bio']);
	
	$result = mysql_query("SELECT * FROM $tablename");
	$fieldorder = mysql_num_rows($result);
	$fieldorder += 1;
	
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
	$ext = findexts ($_FILES['pic1']['name']) ; 
	
	$pic1 = $date . "." . $ext;
	$target = "../profilepics/$pic1";
	
	if (($_FILES["pic1"]["type"] == "image/gif") || ($_FILES["pic1"]["type"] == "image/jpeg") 
	|| ($_FILES["pic1"]["type"] == "image/pjpeg") || ($_FILES["pic1"]["type"] == "image/jpg") || ($_FILES["pic1"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		$sql="INSERT INTO $tablename (name, bio, fieldorder, pic) VALUES('$name','$bio','$fieldorder','$pic1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		move_uploaded_file($_FILES['pic1']['tmp_name'], $target);
		
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
		
		
		
		$save = "../profilepics/thumbs/$pic1"; //This is the new file you saving
		
		if ($_FILES["pic1"]["type"] == "image/gif") {
			$image = imagecreatefromgif($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagegif($thumb, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/jpeg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagejpeg($thumb, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/jpg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagejpeg($thumb, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/png") {
			$image = imagecreatefrompng($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagepng($thumb, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/x-png") {
			$image = imagecreatefrompng($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagepng($thumb, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/pjpeg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbSize, $thumbSize, $cropWidth, $cropHeight);
			imagepng($thumb, $save, 100) ; 
		}

	} else {
		$pic1 = "noimage.jpg";
		$sql="INSERT INTO $tablename (name, bio, fieldorder, pic) VALUES('$name','$bio','$fieldorder','$pic1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	header("Location: editpage.php?pageid=$pageid");
	exit;
	
} else {

$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

echo"<form enctype='multipart/form-data' action=\"addprofile.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the person or object in the profile.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Bio:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"profilebio\" name=\"bio\">$bio</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('profilebio');
</script>";
echo"</td><td class=\"editpagehints\">
This is the bio or description for the profile.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Profile Image:</td>
<td class=\"editpageright\">";
echo"<input type='file' name=\"pic1\" />";
echo"</td><td class=\"editpagehints\">
This is the image for this profile.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
<input type=\"submit\" name=\"submit\" value=\"Add Profile\" />
<a href=\"editpage.php?pageid=$pageid\">Cancel</a>
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




