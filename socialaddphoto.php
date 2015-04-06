<?php
require ('includes/dbconnect.php');

$foldername = ($_POST['foldername']);
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
$target = "members/$foldername/$pic";

if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
{
	$sql="INSERT INTO `$tablename` (filename) VALUES('$pic')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	move_uploaded_file($_FILES['pic']['tmp_name'], $target);
	
	
	//create thumbnail
	$save = "members/$foldername/thumbs/$pic"; //This is the new file you saving
		
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
	$result = mysql_query("SELECT * FROM `$tablename` WHERE `filename` = '$pic'");
    $r = mysql_fetch_array($result);
    $photoid = ($r['id']);
	$newtable = "$tablename" . "_" . $photoid;
	$sql = "CREATE TABLE $newtable (id int AUTO_INCREMENT, memberid int, caption varchar(1000), PRIMARY KEY (id))";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	header("Location: socialgallery.php");
	exit;
} else {
	header("Location: socialgallery.php?error=5");
	exit;
}
?>