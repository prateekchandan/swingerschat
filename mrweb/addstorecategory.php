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
	$name = ($_POST['name']);
	$name2 = ($_POST['name2']);
	$text1 = ($_POST['text1']);
	
	$result = mysql_query("SELECT * FROM `store_categories`");
	$pageorder = mysql_num_rows($result);
	$pageorder += 1;
	
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
	$ext = findexts ($_FILES['pic2']['name']) ; 
	
	
	$pic2 = $date . "." . $ext;
	$target2 = "../categories_main/$pic2";
	
	if (($_FILES["pic2"]["type"] == "image/gif") || ($_FILES["pic2"]["type"] == "image/jpeg") 
	|| ($_FILES["pic2"]["type"] == "image/pjpeg") || ($_FILES["pic2"]["type"] == "image/jpg") || ($_FILES["pic2"]["type"] == "image/png") || ($_FILES["pic2"]["type"] == "image/x-png"))
	{
	
		$sql="INSERT INTO `store_categories` (name, name2, pageorder, mainimage, text) VALUES('$name','$name2','$pageorder','$pic2','$text1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		move_uploaded_file($_FILES['pic2']['tmp_name'], $target2);
	} else {
		$pic2 = "noimage.jpg";
		
		$sql="INSERT INTO `store_categories` (name, name2, pageorder, mainimage, text) VALUES('$name','$name2','$pageorder','$pic2','$text1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}

	header("Location: store.php?message=1");
	exit;
	
} else {


echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"addstorecategory.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">Category Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
</td><td class=\"editpagehints\">
This is the name of the category.
</td></tr>";
/*
echo"
<tr>
<td class=\"editpageleft\">Category Name Description:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name2\" value=\"$name2\" size=\"75\" maxlength=\"70\"/>
</td><td class=\"editpagehints\">
This is the name of the category.
</td></tr>";


echo"
<tr>
<td class=\"editpageleft\">Main Category Image:</td>
<td class=\"editpageright\">";
echo"<input type='file' name=\"pic2\" />";
echo"</td><td class=\"editpagehints\">
This is the main image for the product pages of this category. <br /> Dimensions: 772px X 111px
</td></tr>";


echo"
<tr>
<td class=\"editpageleft\">Text Section 1:</td>
<td class=\"editpageright\">
<textarea id=\"text01\" name=\"text1\">$text1</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('text01');
</script>
</td>
<td class=\"editpagehints\">
This text will appear in the main content section for this category.
</td>
</tr>";

*/
echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"submit\" name=\"submit\" value=\"Add Category\" />
<a href=\"store.php\">Cancel</a>
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




