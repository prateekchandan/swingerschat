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
	$metatitle = ($_POST['metatitle']);
	$metadescription = ($_POST['metadescription']);
	$metakeywords = ($_POST['metakeywords']);
	$price = ($_POST['price']);
	$quantity = ($_POST['quantity']);
	$featured = ($_POST['featured']);
	$productid = ($_POST['productid']);
	$part = ($_POST['part']);
	$ounces = ($_POST['ounces']);
	$brand = ($_POST['brand']);
	$suggested1 = ($_POST['suggested1']);
	$suggested2 = ($_POST['suggested2']);
	$suggested3 = ($_POST['suggested3']);
	$suggested4 = ($_POST['suggested4']);
	
	//Get Options for #1
	$count = 1;
	$optionslist1 = "";
	$result = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$currentoption = 0; 
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option1" . $count;
			$currentoption = ($_POST["$spot"]);
			if ($currentoption == $id) {
				$optionslist1 .= "$currentoption" . ",";
			}
			$count += 1;
		}
		$optionslist1 = substr($optionslist1, 0, -1);
	}
	
	//Get Options for #2
	$count = 1;
	$optionslist2 = "";
	$result = mysql_query("SELECT * FROM `product_option2_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$currentoption = 0; 
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option2" . $count;
			$currentoption = ($_POST["$spot"]);
			if ($currentoption == $id) {
				$optionslist2 .= "$currentoption" . ",";
			}
			$count += 1;
		}
		$optionslist2 = substr($optionslist2, 0, -1);
	}
	
	//Get Options for #3
	$count = 1;
	$optionslist3 = "";
	$result = mysql_query("SELECT * FROM `product_option3_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$currentoption = 0; 
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option3" . $count;
			$currentoption = ($_POST["$spot"]);
			if ($currentoption == $id) {
				$optionslist3 .= "$currentoption" . ",";
			}
			$count += 1;
		}
		$optionslist3 = substr($optionslist3, 0, -1);
	}
	
	//Get Options for #4
	$count = 1;
	$optionslist4 = "";
	$result = mysql_query("SELECT * FROM `product_option4_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$currentoption = 0; 
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option4" . $count;
			$currentoption = ($_POST["$spot"]);
			if ($currentoption == $id) {
				$optionslist4 .= "$currentoption" . ",";
			}
			$count += 1;
		}
		$optionslist4 = substr($optionslist4, 0, -1);
	}
        
        //Get Options for #5
	$count = 1;
	$optionslist5 = "";
	$result = mysql_query("SELECT * FROM `product_option5_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$currentoption = 0; 
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option5" . $count;
			$currentoption = ($_POST["$spot"]);
			if ($currentoption == $id) {
				$optionslist5 .= "$currentoption" . ",";
			}
			$count += 1;
		}
		$optionslist5 = substr($optionslist5, 0, -1);
	}
	
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
	if (empty($_POST['ounces'])) {
		header("Location: editproduct3.php?error=1&id=$productid");
		exit;
	}

	mysql_query("UPDATE `products` SET `category`='$category', `subcategory`='$subcategory', `name`='$name', `description`='$description', `price`='$price', `quantity`='$quantity', `featured`='$featured', `ounces`='$ounces', `option1`='$optionslist1', `option2`='$optionslist2', `option3`='$optionslist3', `option4`='$optionslist4', `option5`='$optionslist5', `metatitle`='$metatitle', `metadescription`='$metadescription', `metakeywords`='$metakeywords', `suggested1`='$suggested1', `suggested2`='$suggested2', `suggested3`='$suggested3', `suggested4`='$suggested4'  WHERE `id` = '$productid' ");
	
	require('includes/smarturls.php');
	
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
$metatitle = ($r2['metatitle']);
$metadescription = ($r2['metadescription']);
$metakeywords = ($r2['metakeywords']);
$price = ($r2['price']);
$quantity = ($r2['quantity']);
$featured = ($r2['featured']);
$pic1 = ($r2['pic1']);
$cad = ($r2['cad']);
$part = ($r2['partnumber']);
$optionslist1 = ($r2['option1']);
$optionslist2 = ($r2['option2']);
$optionslist3 = ($r2['option3']);
$optionslist4 = ($r2['option4']);
$optionslist5 = ($r2['option5']);
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
$brand = ($r2['brand']);
$suggested1 = ($r2['suggested1']);
$suggested2 = ($r2['suggested2']);
$suggested3 = ($r2['suggested3']);
$suggested4 = ($r2['suggested4']);



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
echo"
<tr>
<td class=\"editpageleft\">Edit Product Gallery:</td>
<td class=\"editpageright\">";
	$_SESSION['gallerytable'] = $tablename;
	$_SESSION['cellblock'] = "picorder";
	
	echo'<div id="sortlist" width="100%" style="border:0px;">';
				
	$count = 0;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `picorder` ASC");
	while ($r = mysql_fetch_array($result)) {
		$photoid = ($r['id']);
		$photoid2 = "pictureId_" . ($r['id']);
		$filename = ($r['filename']);
		$caption = ($r['caption']);

		echo "<div class='sorting' id='$photoid2'><a href=\"../productpics/$tablename/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"../productpics/$tablename/thumbs/$filename\" class='galleryimage'/></a><br /><a href=\"deleteproductphoto.php?tablename=$tablename&photoid=$photoid&filename=$filename&productid=$productid\">Delete</a></div>";
		
	}
	
	echo"</div>";
	echo"<div style='clear:both;'></div>";
	echo"<div style='text-align:center; width:600px;'>";
	echo"<br /><a href=\"addproductphoto.php?tablename=$tablename&productid=$productid\">Add New Photo</a>";
	if ($error == 1) { echo"You can only upload image files!"; }
	echo"</div>";

echo"
</td>
<td class=\"editpagehints\">
Edit the images which display in this product's photo gallery.
</td>
</tr>";

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
 



echo"
<tr>
<td class=\"editpageleft\">Other Categories:</td>
<td class=\"editpageright\">";
echo"<a href='ghostcategory.php?productid=$productid'>Add New Category</a><br />";
$result2 = mysql_query("SELECT * FROM `products` WHERE `ghost` = '$productid'");
while ($r2 = mysql_fetch_array($result2)) {
	$ghostid = ($r2['id']);
	$catid= ($r2['category']);
	$subid = ($r2['subcategory']);
	$brandid = ($r2['brand']);
	$result = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$catid'");
	$r = mysql_fetch_array($result);
	$catname = ($r['name']);
	$result = mysql_query("SELECT * FROM `store_subcategories` WHERE `id` = '$subid'");
	$r = mysql_fetch_array($result);
	$subname = ($r['name']);

	echo"<a href='deleteghost.php?productid=$productid&ghostid=$ghostid' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this extra category set?');\">X</a> &nbsp;&nbsp;&nbsp; $catname - $subname - $brandname <br />";
}

echo"</td><td class=\"editpagehints\">
These are other categories this product is displayed in.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">SEO Title:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"metatitle\" name=\"metatitle\">$metatitle</textarea>
<script type='text/javascript'>
CKEDITOR.replace( 'metatitle' );
</script>";
echo"</td><td class=\"editpagehints\">
This is the title of the page. This will help with SEO.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">SEO Description:</td>
<td class=\"editpageright\">";
echo"
<textarea id=\"metadescription\" name=\"metadescription\">$metadescription</textarea>
<script type='text/javascript'>
CKEDITOR.replace( 'metadescription' );
</script>";
echo"</td><td class=\"editpagehints\">
This is the description of the page. This will help with SEO.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">SEO URL:</td>
<td class=\"editpageright\">
<textarea id=\"metakeywords\" name=\"metakeywords\" cols=\"62\" rows=\"5\">$metakeywords</textarea>
</td>
<td class=\"editpagehints\">
This will be the SEO safe URL for this page.
</td>
</tr>";

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
<textarea id=\"description\" name=\"description\">$description</textarea>
<script type='text/javascript'>
CKEDITOR.replace( 'description' );
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
	echo"<br /><a href='addoption.php?productid=$productid&option=1'>Add New Option</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='reorderoption.php?productid=$productid&option=1'>Reorder Options</a>";

	echo'<div class="optionbox">';
	
	$result = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option1" . $count;
			$price = ($r['price']);
			if ($price == "") { $price = "0.00"; }
			
			$photoid2 = "SpotID1_" . ($r['id']);
			
			$optionarray = explode(",", $optionslist1);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			$result2 = mysql_query("SELECT * FROM `product_option1_pics` WHERE `productid` = '$productid' AND `optionid` = '$id' ");
			$r2 = mysql_fetch_array($result2);
			$pic = ($r2['pic']);
			$picid = ($r2['id']);
			//Make Thumb
			$thumb = "thumb" . $spot . ".jpg";
			square_crop("../productpics/$pic", "$thumb", 150);
			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
			echo"<table width='100%' cellpadding='3px' cellspacing='0'>";
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option1_list'>$option</a>";
			echo"</td>";
			
			echo"<td width='120px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			if ($pic == "") {
				echo"<a href='addoptionpic.php?optionid=$id&productid=$productid&tablename=product_option1_pics'>Add Picture</a>";
			} else {
				echo"<a href='../productpics/$pic' class='highslide' onclick='return hs.expand(this)'><img src='$thumb' width='75px' height='75px'/></a><br /><a href='removeoptionpic.php?productid=$productid&picid=$picid&filename=$pic&tablename=product_option1_pics' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this picture?');\">Delete Picture</a>";
			}
			echo"</td>";
			
			echo"<td width='100px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"Extra Charge? <br /><br />";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option1_list'>$$price</a>";
			echo"</td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td colspan='4' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<br /><a href='removeoption.php?productid=$productid&option=1&optionid=$id' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Click here to delete this option.</a>";
			echo"</td>";
			echo"</tr>";
			echo"</table>";
			echo"</div>";
			$count += 1;
		}
	} else {
		echo"<br /><br />There are no options...";
	}
	
	echo"</div>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";



$count = 1;
$result = mysql_query("SELECT * FROM `product_option2`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 2: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
	echo"<br /><a href='addoption.php?productid=$productid&option=2'>Add New Option</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='reorderoption.php?productid=$productid&option=2'>Reorder Options</a>";

	echo'<div class="optionbox">';
	
	$result = mysql_query("SELECT * FROM `product_option2_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option2" . $count;
			$price = ($r['price']);
			if ($price == "") { $price = "0.00"; }
			
			$photoid2 = "SpotID2_" . ($r['id']);
			
			$optionarray = explode(",", $optionslist2);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			$result2 = mysql_query("SELECT * FROM `product_option2_pics` WHERE `productid` = '$productid' AND `optionid` = '$id' ");
			$r2 = mysql_fetch_array($result2);
			$pic = ($r2['pic']);
			$picid = ($r2['id']);
			//Make Thumb
			$thumb = "thumb" . $spot . ".jpg";
			square_crop("../productpics/$pic", "$thumb", 150);
			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
			echo"<table width='100%' cellpadding='3px' cellspacing='0'>";
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option2_list'>$option</a>";
			echo"</td>";
			
			echo"<td width='120px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			if ($pic == "") {
				echo"<a href='addoptionpic.php?optionid=$id&productid=$productid&tablename=product_option2_pics'>Add Picture</a>";
			} else {
				echo"<a href='../productpics/$pic' class='highslide' onclick='return hs.expand(this)'><img src='$thumb' width='75px' height='75px'/></a><br /><a href='removeoptionpic.php?productid=$productid&picid=$picid&filename=$pic&tablename=product_option2_pics' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this picture?');\">Delete Picture</a>";
			}
			echo"</td>";
			
			echo"<td width='100px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"Extra Charge? <br /><br />";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option2_list'>$$price</a>";
			echo"</td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td colspan='4' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<br /><a href='removeoption.php?productid=$productid&option=2&optionid=$id' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Click here to delete this option.</a>";
			echo"</td>";
			echo"</tr>";
			echo"</table>";
			echo"</div>";
			$count += 1;
		}
	} else {
		echo"<br /><br />There are no options...";
	}
	
	echo"</div>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";



$count = 1;
$result = mysql_query("SELECT * FROM `product_option3`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 3: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
	echo"<br /><a href='addoption.php?productid=$productid&option=3'>Add New Option</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='reorderoption.php?productid=$productid&option=3'>Reorder Options</a>";

	echo'<div class="optionbox">';
	
	$result = mysql_query("SELECT * FROM `product_option3_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option3" . $count;
			$price = ($r['price']);
			if ($price == "") { $price = "0.00"; }
			
			$photoid2 = "SpotID3_" . ($r['id']);
			
			$optionarray = explode(",", $optionslist3);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			$result2 = mysql_query("SELECT * FROM `product_option3_pics` WHERE `productid` = '$productid' AND `optionid` = '$id' ");
			$r2 = mysql_fetch_array($result2);
			$pic = ($r2['pic']);
			$picid = ($r2['id']);
			//Make Thumb
			$thumb = "thumb" . $spot . ".jpg";
			square_crop("../productpics/$pic", "$thumb", 150);
			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0'>";
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option3_list'>$option</a>";
			echo"</td>";
			
			echo"<td width='120px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			if ($pic == "") {
				echo"<a href='addoptionpic.php?optionid=$id&productid=$productid&tablename=product_option3_pics'>Add Picture</a>";
			} else {
				echo"<a href='../productpics/$pic' class='highslide' onclick='return hs.expand(this)'><img src='$thumb' width='75px' height='75px'/></a><br /><a href='removeoptionpic.php?productid=$productid&picid=$picid&filename=$pic&tablename=product_option3_pics' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this picture?');\">Delete Picture</a>";
			}
			echo"</td>";
			
			echo"<td width='100px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"Extra Charge? <br /><br />";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option3_list'>$$price</a>";
			echo"</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td colspan='4' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<br /><a href='removeoption.php?productid=$productid&option=3&optionid=$id' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Click here to delete this option.</a>";
			echo"</td>";
			echo"</tr>";
			echo"</table>";
			echo"</div>";
			$count += 1;
		}
	} else {
		echo"<br /><br />There are no options...";
	}
	
	echo"</div>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";


$count = 1;
$result = mysql_query("SELECT * FROM `product_option4`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 4: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
	echo"<br /><a href='addoption.php?productid=$productid&option=4'>Add New Option</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='reorderoption.php?productid=$productid&option=4'>Reorder Options</a>";

	echo'<div class="optionbox">';
	
	$result = mysql_query("SELECT * FROM `product_option4_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option4" . $count;
			$price = ($r['price']);
			if ($price == "") { $price = "0.00"; }
			
			$photoid2 = "SpotID4_" . ($r['id']);
			
			$optionarray = explode(",", $optionslist4);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			$result2 = mysql_query("SELECT * FROM `product_option4_pics` WHERE `productid` = '$productid' AND `optionid` = '$id' ");
			$r2 = mysql_fetch_array($result2);
			$pic = ($r2['pic']);
			$picid = ($r2['id']);
			//Make Thumb
			$thumb = "thumb" . $spot . ".jpg";
			square_crop("../productpics/$pic", "$thumb", 150);
			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0'>";
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option4_list'>$option</a>";
			echo"</td>";
			
			echo"<td width='120px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			if ($pic == "") {
				echo"<a href='addoptionpic.php?optionid=$id&productid=$productid&tablename=product_option4_pics'>Add Picture</a>";
			} else {
				echo"<a href='../productpics/$pic' class='highslide' onclick='return hs.expand(this)'><img src='$thumb' width='75px' height='75px'/></a><br /><a href='removeoptionpic.php?productid=$productid&picid=$picid&filename=$pic&tablename=product_option4_pics' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this picture?');\">Delete Picture</a>";
			}
			echo"</td>";
			
			echo"<td width='100px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"Extra Charge? <br /><br />";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option4_list'>$$price</a>";
			echo"</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td colspan='4' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<br /><a href='removeoption.php?productid=$productid&option=4&optionid=$id' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Click here to delete this option.</a>";
			echo"</td>";
			echo"</tr>";
			echo"</table>";
			echo"</div>";
			$count += 1;
		}
	} else {
		echo"<br /><br />There are no options...";
	}
	
	echo"</div>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";


$count = 1;
$result = mysql_query("SELECT * FROM `product_option5`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 5: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
	echo"<br /><a href='addoption.php?productid=$productid&option=5'>Add New Option</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='reorderoption.php?productid=$productid&option=5'>Reorder Options</a>";

	echo'<div class="optionbox">';
	
	$result = mysql_query("SELECT * FROM `product_option5_list` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option5" . $count;
			$price = ($r['price']);
			if ($price == "") { $price = "0.00"; }
			
			$photoid2 = "SpotID5_" . ($r['id']);
			
			$optionarray = explode(",", $optionslist5);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			$result2 = mysql_query("SELECT * FROM `product_option5_pics` WHERE `productid` = '$productid' AND `optionid` = '$id' ");
			$r2 = mysql_fetch_array($result2);
			$pic = ($r2['pic']);
			$picid = ($r2['id']);
			//Make Thumb
			$thumb = "thumb" . $spot . ".jpg";
			square_crop("../productpics/$pic", "$thumb", 150);
			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0'>";
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
			echo"</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option5_list'>$option</a>";
			echo"</td>";
			
			echo"<td width='120px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			if ($pic == "") {
				echo"<a href='addoptionpic.php?optionid=$id&productid=$productid&tablename=product_option5_pics'>Add Picture</a>";
			} else {
				echo"<a href='../productpics/$pic' class='highslide' onclick='return hs.expand(this)'><img src='$thumb' width='75px' height='75px'/></a><br /><a href='removeoptionpic.php?productid=$productid&picid=$picid&filename=$pic&tablename=product_option5_pics' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this picture?');\">Delete Picture</a>";
			}
			echo"</td>";
			
			echo"<td width='100px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"Extra Charge? <br /><br />";
			echo"<a href='editoptionname.php?optionid=$id&productid=$productid&tablename=product_option5_list'>$$price</a>";
			echo"</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td colspan='4' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<br /><a href='removeoption.php?productid=$productid&option=5&optionid=$id' style='color:#ff0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Click here to delete this option.</a>";
			echo"</td>";
			echo"</tr>";
			echo"</table>";
			echo"</div>";
			$count += 1;
		}
	} else {
		echo"<br /><br />There are no options...";
	}
	
	echo"</div>";
echo"</td><td class=\"editpagehints\">
Check all options that you want users to be able to choose from.
</td></tr>";


echo"
<tr>
<td class=\"editpageleft\">Suggested Item 1:</td>
<td class=\"editpageright\">";
	echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	echo"<tr>";
	echo"<td align='left' valign='top'>";
	echo"<select name='suggested1'>";
	echo"<option value='0'>not selected</option>";
	$result = mysql_query("SELECT * FROM `products` ORDER BY `name` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			echo"<option value='$id'"; if ($id == $suggested1) { echo"selected='selected'"; } echo">$option</option>";
		}
	} else {
		echo"<br /><br />There are no products...";
	}
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Select the item you want to be suggested to users on your site who are looking at this product.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Suggested Item 2:</td>
<td class=\"editpageright\">";
	echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	echo"<tr>";
	echo"<td align='left' valign='top'>";
	echo"<select name='suggested2'>";
	echo"<option value='0'>not selected</option>";
	$result = mysql_query("SELECT * FROM `products` ORDER BY `name` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			echo"<option value='$id'"; if ($id == $suggested2) { echo"selected='selected'"; } echo">$option</option>";
		}
	} else {
		echo"<br /><br />There are no products...";
	}
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Select the item you want to be suggested to users on your site who are looking at this product.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Suggested Item 3:</td>
<td class=\"editpageright\">";
	echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	echo"<tr>";
	echo"<td align='left' valign='top'>";
	echo"<select name='suggested3'>";
	echo"<option value='0'>not selected</option>";
	$result = mysql_query("SELECT * FROM `products` ORDER BY `name` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			echo"<option value='$id'"; if ($id == $suggested3) { echo"selected='selected'"; } echo">$option</option>";
		}
	} else {
		echo"<br /><br />There are no products...";
	}
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Select the item you want to be suggested to users on your site who are looking at this product.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Suggested Item 4:</td>
<td class=\"editpageright\">";
	echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	echo"<tr>";
	echo"<td align='left' valign='top'>";
	echo"<select name='suggested4'>";
	echo"<option value='0'>not selected</option>";
	$result = mysql_query("SELECT * FROM `products` ORDER BY `name` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$option = ($r['name']);
			$id = ($r['id']);
			echo"<option value='$id'"; if ($id == $suggested4) { echo"selected='selected'"; } echo">$option</option>";
		}
	} else {
		echo"<br /><br />There are no products...";
	}
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Select the item you want to be suggested to users on your site who are looking at this product.
</td></tr>";




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




