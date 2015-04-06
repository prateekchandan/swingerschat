<?php
require ('includes/dbconnect.php');

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
	$_SESSION['returnurl'] = "members.php?location=3";
	header ('Location: login.php?error=3');
	exit();
}
$photo = ($_POST['photo']);
$memberid =($_SESSION['memberloggedin']);
$date = time();

function findexts ($filename)
{
$filename = strtolower($filename) ;
$exts = split("[/\\.]", $filename) ;
$n = count($exts)-1;
$exts = $exts[$n];
return $exts;
}

if ($photo != "noimage.jpg") {
	unlink("members/$photo");
}

//This applies the function to our file
$ext = findexts ($_FILES['pic']['name']) ; 

$pic = $date . $memberid . "." . $ext;
$target = "members/$pic";

if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
{
	mysql_query("UPDATE `members` SET `photo`='$pic' WHERE `id` = '$memberid' ");
	move_uploaded_file($_FILES['pic']['tmp_name'], $target);
	
	//Make main image a max of 1000px
	if ($width > 1000) {
		$divider = ($width / 1000);
		$newwidth = 1000;
		$newheight = ($height / $divider);
		$save = "members/$pic";
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
	
	header("Location: members.php?location=3");
	exit;
} else {
	header("Location: members.php?location=3&error=6");
	exit;
}
?>