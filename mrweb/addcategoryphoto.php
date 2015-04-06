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
	$categoryid = ($_POST['categoryid']);
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
	$target = "../categories/$pic";
	
	if (($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/jpeg") 
	|| ($_FILES["pic"]["type"] == "image/pjpeg") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		mysql_query("UPDATE `store_categories` SET `photo`='$pic' WHERE `id` = '$categoryid' ");
		
		move_uploaded_file($_FILES['pic']['tmp_name'], $target);
		
		
		
	
		
		header("Location: editstorecategory.php?id=$categoryid");
		exit;
	} else {
		header("Location: addcategoryphoto.php?categoryid=$categoryid&message=1");
		exit;
	}
} else {

$message = ($_GET['message']);
$categoryid = ($_GET['categoryid']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery

echo"
<tr>
<td class=\"editpageleft\">Add New Photo:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
	echo"<tr><td align='center' colspan='6'>";
	echo"<form enctype='multipart/form-data' action=\"addcategoryphoto.php\" method='post'>
		<input name='pic' type='file' />
		<input type='hidden' name='categoryid' value=\"$categoryid\" />
		<input type='submit' name='submit' value='Upload New Photo' />
		</form>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($message == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
echo"</td><td class=\"editpagehints\">
This is the image for the category.
</td></tr></table";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




