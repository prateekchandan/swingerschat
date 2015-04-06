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
	$target = "../$tablename/$pic";
	
	if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
	|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		$sql="INSERT INTO $tablename (filename) VALUES('$pic')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		move_uploaded_file($_FILES['pic']['tmp_name'], $target);
		
		
		//create thumbnail
		$save = "../$tablename/thumbs/$pic"; //This is the new file you saving
			
		list($width, $height) = getimagesize($target) ; 
		if ($width > $height) {
		  $divider = ($height/100);
		} else {
		  $divider = ($width/100); 
		}
		$newwidth = ($width/$divider);
		$newheight = ($height/$divider);	
		
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		
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
		
		//Make main image a max of 1000px
		if ($width > 1000) {
			$divider = ($width / 1000);
			$newwidth = 1000;
			$newheight = ($height / $divider);
			$save = "../$tablename/$pic";
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
		
		header("Location: editpage.php?pageid=$pageid");
		exit;
	} else {
		header("Location: addphoto.php?tablename=$tablename&pageid=$pageid&message=1");
		exit;
	}
} else {

$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery

echo"
<tr>
<td class=\"editpageleft\">Add New Photo:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
	echo"<tr><td align='center' colspan='6'>";
	echo"<form enctype='multipart/form-data' action=\"addphoto.php\" method='post'>
		<input name='pic' type='file' />
		<input type='hidden' name='tablename' value=\"$tablename\" />
		<input type='hidden' name='pageid' value=\"$pageid\" />
		<input type='submit' name='submit' value='Upload New Photo' />
		</form>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($message == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Add a new image to your photo gallery.
</td></tr></table";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




