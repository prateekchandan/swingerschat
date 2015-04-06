<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable" >

<br />
<br />
<?php
if (isset ($_POST['submit'])) {
	$category = ($_POST['category']);
	$subcategory = ($_POST['subcategory']);
	$name = ($_POST['name']);
	$description = ($_POST['description']);
	$price = ($_POST['price']);
	$quantity = ($_POST['quantity']);
	$featured = ($_POST['featured']);
	$productid = ($_POST['productid']);
	$part = ($_POST['part']);
	$option1 = ($_POST['option1']);
	$option2 = ($_POST['option2']);
	$option3 = ($_POST['option3']);
	$option4 = ($_POST['option4']);
	$option5 = ($_POST['option5']);
	$option6 = ($_POST['option6']);
	$option7 = ($_POST['option7']);
	$option8 = ($_POST['option8']);
	$option9 = ($_POST['option9']);
	$option10 = ($_POST['option10']);
	$option11 = ($_POST['option11']);
	$option12 = ($_POST['option12']);
	$option13 = ($_POST['option13']);
	$option14 = ($_POST['option14']);
	$option15 = ($_POST['option15']);
	$option16 = ($_POST['option16']);
	$option17 = ($_POST['option17']);
	$option18 = ($_POST['option18']);
	$option19 = ($_POST['option19']);
	$option20 = ($_POST['option20']);
	$option21 = ($_POST['option21']);
	$option22 = ($_POST['option22']);
	$option23 = ($_POST['option23']);
	$option24 = ($_POST['option24']);
	$option25 = ($_POST['option25']);
	$option26 = ($_POST['option26']);
	$option27 = ($_POST['option27']);
	$option28 = ($_POST['option28']);
	$option29 = ($_POST['option29']);
	$option30 = ($_POST['option30']);
	$ounces = ($_POST['ounces']);
	
	if (empty($_POST['category'])) {
		header("Location: editproduct3.php?error=1&id=$productid");
		exit;
	}
	if (empty($_POST['name'])) {
		header("Location: editproduct3.php?error=1&id=$productid");
		exit;
	}
	if (empty($_POST['price'])) {
		header("Location: editproduct3.php?error=1&id=$productid");
		exit;
	}

	mysql_query("UPDATE `products` SET `category`='$category', `subcategory`='$subcategory', `name`='$name', `description`='$description', `price`='$price', `quantity`='$quantity', `featured`='$featured', `ounces`='$ounces', `option1`='$option1', `option2`='$option2', `option3`='$option3', `option4`='$option4', `option5`='$option5', `option6`='$option6', `option7`='$option7', `option8`='$option8', `option9`='$option9', `option10`='$option10', `option11`='$option11', `option12`='$option12', `option13`='$option13', `option14`='$option14', `option15`='$option15', `option16`='$option16', `option17`='$option17', `option18`='$option18', `option19`='$option19', `option20`='$option20', `option21`='$option21', `option22`='$option22', `option23`='$option23', `option24`='$option24', `option25`='$option25', `option26`='$option26', `option27`='$option27', `option28`='$option28', `option29`='$option29', `option30`='$option30' WHERE `id` = '$productid' ");
	
	header("Location: editproduct3.php?error=2&id=$productid");
	exit;

	
} else {

$error = ($_GET['error']);
$productid = ($_GET['id']);
$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
$r2 = mysql_fetch_array($result2);
$category = ($r2['category']);
$subcategory = ($r2['subcategory']);
$name = stripslashes($r2['name']);
$description = ($r2['description']);
$price = ($r2['price']);
$quantity = ($r2['quantity']);
$featured = ($r2['featured']);
$pic1 = ($r2['pic1']);
$cad = ($r2['cad']);
$part = ($r2['partnumber']);
$option1 = ($r2['option1']);
$option2 = ($r2['option2']);
$option3 = ($r2['option3']);
$option4 = ($r2['option4']);
$option5 = ($r2['option5']);
$option6 = ($r2['option6']);
$option7 = ($r2['option7']);
$option8 = ($r2['option8']);
$option9 = ($r2['option9']);
$option10 = ($r2['option10']);
$option11 = ($r2['option11']);
$option12 = ($r2['option12']);
$option13 = ($r2['option13']);
$option14 = ($r2['option14']);
$option15 = ($r2['option15']);
$option16 = ($r2['option16']);
$option17 = ($r2['option17']);
$option18 = ($r2['option18']);
$option19 = ($r2['option19']);
$option20 = ($r2['option20']);
$option21 = ($r2['option21']);
$option22 = ($r2['option22']);
$option23 = ($r2['option23']);
$option24 = ($r2['option24']);
$option25 = ($r2['option25']);
$option26 = ($r2['option26']);
$option27 = ($r2['option27']);
$option28 = ($r2['option28']);
$option29 = ($r2['option29']);
$option30 = ($r2['option30']);
$ounces = ($r2['ounces']);



echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

if ($error == 1) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
<td class=\"editpageright\">You must fill in all *required fields.
</td>
<td class=\"editpagehints\">
</td>
</tr>";
}

if ($error == 2) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#00FF00;'>Success:</td>
<td class=\"editpageright\">You have successfully edited this product!
</td>
<td class=\"editpagehints\">
</td>
</tr>";
}
	
echo"<form enctype='multipart/form-data' action=\"editproduct3.php\" method='post'>";

if ($pic1 != "noimage.jpg") {
	echo"
	<tr>
	<td class=\"editpageleft\">Main Product Image:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<a href=\"../productpics/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='../productpics/thumbs/$pic1' width='75px' height='75px'/></a>";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href='deletemainproductphoto.php?productid=$productid&pic1=$pic1'>REMOVE PICTURE</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the main image for this product.
	</td></tr>";
} else {
	echo"
	<tr>
	<td class=\"editpageleft\">Main Product Image:</td>
	<td class=\"editpageright\">";
		echo"<table cellpadding='0' cellspacing='1'>";
		echo"<tr>";
		echo"<td align='left' valign='middle'>";
		echo"<img src='../productpics/noimage.jpg' width='125px'/>";
		echo"</td><td align='left' valign='middle'>";
		echo"<a href=\"addmainproductphoto.php?productid=$productid\">Add New Photo</a>";
		echo"</td></tr></table>";
	echo"</td><td class=\"editpagehints\">
	This is the main image for this product.
	</td></tr>";
}

$tablename = "ProductGallery_" . $productid;
/*
echo"
<tr>
<td class=\"editpageleft\">Edit Product Gallery:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\"><tr>";
	$count = 0;
	$result = mysql_query("SELECT * FROM `$tablename`");
	while ($r = mysql_fetch_array($result)) {
		$photoid = ($r['id']);
		$filename = ($r['filename']);
		$caption = ($r['caption']);

		echo "<td class='gallerycell'><a href=\"../productpics/$tablename/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"../productpics/$tablename/thumbs/$filename\" class='galleryimage'/></a><br /><a href=\"deleteproductphoto.php?tablename=$tablename&photoid=$photoid&filename=$filename&productid=$productid\">Delete</a></td>";
		
		$count += 1;
		if ($count > 5) {
			echo"</tr><tr>";
			$count = 0;
		}
	}
	while ($count < 6) {
		echo"<td class='gallerycell' align=\"center\" width=\"50px\"></td>";
		$count += 1;
	}
	echo"</tr>";
	echo"<tr><td align='center' colspan='6'>";
	echo"<br /><a href=\"addproductphoto.php?tablename=$tablename&productid=$productid\">Add New Photo</a>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($error == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
echo"
</td>
<td class=\"editpagehints\">
Edit the images which display in this product's photo gallery.
</td>
</tr>";
 */
echo"
<tr>
<td class=\"editpageleft\">*Category:</td>
<td class=\"editpageright\">";
echo'<select name="category">';
$result = mysql_query('SELECT * FROM `store_categories` ORDER BY `pageorder` ASC');
while ($r = mysql_fetch_array($result)) {
	$categoryname = ($r['name']);
	$categoryid = ($r['id']);
	if ($category == $categoryid) {
		echo"<option value='$categoryid' selected='selected'>$categoryname</option>";
	} else {
		echo"<option value='$categoryid'>$categoryname</option>";
	}
}
echo'</select>';
echo"</td><td class=\"editpagehints\">
This is the category the product will be under.
</td></tr>";

/*
echo"
<tr>
<td class=\"editpageleft\">Sub-Category:</td>
<td class=\"editpageright\">";
echo'<select name="subcategory">';
//echo"<option value=''>No Sub-Category</option>";
$result = mysql_query('SELECT * FROM `store_subcategories` ORDER BY `pageorder` ASC');
while ($r = mysql_fetch_array($result)) {
	$categoryname = ($r['name']);
	$categoryid = ($r['id']);
	if ($subcategory == $categoryid) {
		echo"<option value='$categoryid' selected='selected'>$categoryname</option>";
	} else {
		echo"<option value='$categoryid'>$categoryname</option>";
	}

}
echo'</select>';
echo"</td><td class=\"editpagehints\">
This is the sub-category the product will be under.
</td></tr>";

*/

echo"
<tr>
<td class=\"editpageleft\">*Product Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the product.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Description:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"productdescription\" name=\"description\">$description</textarea>
<script language=\"javascript1.2\">
generate_wysiwyg('productdescription');
</script>";
echo"</td><td class=\"editpagehints\">
This is the description of the product that will display on the product page.
</td></tr>";



echo"
<tr>
<td class=\"editpageleft\">*Price:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"price\" value=\"$price\" size=\"20\" maxlength=\"20\"/> Do Not Include $";
echo"</td><td class=\"editpagehints\">
This is the price of the product. Do not include a $.
</td></tr>";



echo"
<tr>
<td class=\"editpageleft\">Quantity:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"quantity\" value=\"$quantity\" size=\"20\" maxlength=\"20\"/>";
echo"</td><td class=\"editpagehints\">
This is the number of this product you have in stock.
</td></tr>";
/*
echo"
<tr>
<td class=\"editpageleft\">*Ounces:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"ounces\" value=\"$ounces\" size=\"20\" maxlength=\"20\"/>";
echo"</td><td class=\"editpagehints\">
This is the product's weight in ounces.
</td></tr>";


echo"
<tr>
<td class=\"editpageleft\">Featured:</td>
<td class=\"editpageright\">";
if ($featured == 1) {
	echo"<input type='checkbox' name=\"featured\" value=\"1\" checked='checked'/>";
} else {
	echo"<input type='checkbox' name=\"featured\" value=\"1\"/>";
}
echo"</td><td class=\"editpagehints\">
Featured products will be displayed on the first page of the online store.
</td></tr>";

$count = 1;
$result = mysql_query("SELECT * FROM `product_option1`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 1: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
			echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	$result = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `id` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option" . $count;
			$currentoption = ($r2["$spot"]);
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='1' "; if ($currentoption == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$option";
			echo"</td>";
			echo"</tr>";
			$count += 1;
		}
	} else {
		echo"<tr>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
		echo"<br /><br />There are no options...";
		echo"</td>";
		echo"</tr>";
	}
			echo"</table>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";


$count = 11;
$result = mysql_query("SELECT * FROM `product_option2`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 2: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
			echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	$result = mysql_query("SELECT * FROM `product_option2_list` ORDER BY `id` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option" . $count;
			$currentoption = ($r2["$spot"]);
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='1' "; if ($currentoption == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$option";
			echo"</td>";
			echo"</tr>";
			$count += 1;
		}
	} else {
		echo"<tr>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
		echo"<br /><br />There are no options...";
		echo"</td>";
		echo"</tr>";
	}
			echo"</table>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";


$count = 21;
$result = mysql_query("SELECT * FROM `product_option3`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 3: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
			echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	$result = mysql_query("SELECT * FROM `product_option3_list` ORDER BY `id` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option" . $count;
			$currentoption = ($r2["$spot"]);
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='1' "; if ($currentoption == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$option";
			echo"</td>";
			echo"</tr>";
			$count += 1;
		}
	} else {
		echo"<tr>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
		echo"<br /><br />There are no options...";
		echo"</td>";
		echo"</tr>";
	}
			echo"</table>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";

 */

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"hidden\" name=\"productid\" value=\"$productid\" />
<input type=\"submit\" name=\"submit\" value=\"SAVE\" />
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




