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
	$domain = $_POST['domain'];
	$caption = ($_POST['caption']);
	
	if (empty($_POST['domain'])) {
		$domain = "No Link";
	}

	
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

		$sql="INSERT INTO ads (domain, photo, caption) VALUES('$domain','$pic','$caption')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		move_uploaded_file($_FILES['pic']['tmp_name'], $target);
		
		//require ('imagesxml.php');
		

		header("Location: adminhome.php");
		exit;
	} else {
		header("Location: addad.php?error=1");
		exit;
	}

	
	header("Location: adminhome.php");
	exit;

} else {

$error = ($_GET['error']);
echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"addad.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must upload an image.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}
	
	if ($error == 2) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must enter a domain name.
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}

	echo"
	<tr>
	<td class=\"editpageleft\">Link:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"domain\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the page users will be directed to when they click the slide. Leave blank if you it is not clickable.
	</td>
	</tr>
	
	<tr>
	<td class=\"editpageleft\">Caption:</td>
	<td class=\"editpageright\">
	<input type=\"text\" name=\"caption\" value=\"$caption\" size=\"75\" maxlength=\"70\"/>
	</td>
	<td class=\"editpagehints\">
	This is the caption for the image.
	</td>
	</tr>

	
	<tr>
	<td class=\"editpageleft\">Image:</td>
	<td class=\"editpageright\">
	<input name='pic' type='file' />
	</td>
	<td class=\"editpagehints\">
	This is the image that will be displayed for the slide.<br />Dimensions: $slidewidth X $slideheight
	</td>
	</tr>

	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type=\"submit\" name=\"submit\" value=\"Add Advertisement\" />
	<input type=\"reset\" name=\"reset\" value=\"Reset\" />
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




