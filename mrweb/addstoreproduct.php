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
	$category = ($_POST['category']);
	$subcategory = ($_POST['subcategory']);
	$name =  ($_POST['name']);
	$description = ($_POST['description']);
	$wearing = ($_POST['wearing']);
	$metatitle = ($_POST['metatitle']);
	$metadescription = ($_POST['metadescription']);
	$metakeywords = ($_POST['metakeywords']);
	$_SESSION['s1'] = ($_POST['description']);
	$_SESSION['s5'] = ($_POST['wearing']);
	$_SESSION['s2'] = ($_POST['metatitle']);
	$_SESSION['s3'] = ($_POST['metadescription']);
	$_SESSION['s4'] = ($_POST['metakeywords']);
	$price = ($_POST['price']);
	$quantity = ($_POST['quantity']);
	$featured = ($_POST['featured']);
	$recipe1 = ($_POST['recipe1']);
	$recipe2 = ($_POST['recipe2']);
	$part = ($_POST['part']);
	$ounces = ($_POST['ounces']);
	
	
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
	
	$returnvalues = "&category=$category&name=$name&price=$price&quantity=$quantity&featured=$featured&part=$part&ounces=$ounces&subcategory=$subcategory&option1=$option1&option2=$option2&option3=$option3&option4=$option4&option5=$option5&option6=$option6&option7=$option7&option8=$option8&option9=$option9&option10=$option10&option11=$option11&option12=$option12&option13=$option13&option14=$option14&option15=$option15&option16=$option16&option17=$option17&option18=$option18&option19=$option19&option20=$option20";
	
	

	
	if (empty($_POST['category'])) {
		header("Location: addstoreproduct.php?error=1" . $returnvalues);
		exit;
	}

	if (empty($_POST['name'])) {
		header("Location: addstoreproduct.php?error=1" . $returnvalues);
		exit;
	}
	if (empty($_POST['price'])) {
		header("Location: addstoreproduct.php?error=1" . $returnvalues);
		exit;
	}
	if (empty($_POST['ounces'])) {
		header("Location: addstoreproduct.php?error=1" . $returnvalues);
		exit;
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
	$ext = findexts ($_FILES['pic1']['name']) ; 
	
	$pic1 = $date . "." . $ext;
	$target = "../productpics/$pic1";
	
	if (($_FILES["pic1"]["type"] == "image/gif") || ($_FILES["pic1"]["type"] == "image/jpeg") 
	|| ($_FILES["pic1"]["type"] == "image/pjpeg") || ($_FILES["pic1"]["type"] == "image/jpg") || ($_FILES["pic1"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/x-png"))
	{
		//check file size
		$filesize = filesize($_FILES['pic1']['tmp_name']);
		$mb = 1048576;
		$twomb = ($mb * 2);
		if ($filesize > $twomb) {
			header("Location: addstoreproduct.php?error=3" . $returnvalues);
			exit;
		}
	
		$sql="INSERT INTO `products` (category, subcategory, name, description, price, quantity, featured, pic1, ounces, option1, option2, option3, option4, option5, metatitle, metadescription, metakeywords, type) VALUES('$category','$subcategory','$name','$description','$price','$quantity','$featured','$pic1','$ounces','$optionslist1','$optionslist2','$optionslist3','$optionslist4','$optionslist5','$metatitle','$metadescription','$metakeywords','$type')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		move_uploaded_file($_FILES['pic1']['tmp_name'], $target);
		/*
		if (move_uploaded_file($_FILES['pic2']['tmp_name'], $target2)) {
			
		} else {
			mysql_query("UPDATE `products` SET `cad`='nocad' WHERE `id` = '$productid' ");
		}
		*/
		
		//create thumbnail
		$save = "../productpics/thumbs/$pic1"; //This is the new file you saving
			
		list($width, $height) = getimagesize($target) ; 
		if ($width > 500) {
				$divider = 500 / $width;
				$newwidth = 500;
				$newheight = $divider * $height;
			}	
			
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		$image = imagecreatefromjpeg($target) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		
		if ($_FILES["pic1"]["type"] == "image/gif") {
			$image = imagecreatefromgif($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			imagegif($tn, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/jpeg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			imagejpeg($tn, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/jpg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			imagejpeg($tn, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/png") {
			$image = imagecreatefrompng($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			imagepng($tn, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/x-png") {
			$image = imagecreatefrompng($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			imagepng($tn, $save, 100) ; 
		}
		if ($_FILES["pic1"]["type"] == "image/pjpeg") {
			$image = imagecreatefromjpeg($target) ; 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
			imagepng($tn, $save, 100) ; 
		}

		
		//Create Folders and Table
		$result = mysql_query("SELECT * FROM `products` ORDER BY `id` DESC");
		$r = mysql_fetch_array($result);
		$productid = ($r['id']);
		$tablename = "ProductGallery_" . $productid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, filename varchar(200),caption varchar(1000), picorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		mkdir("../productpics/$tablename");
		mkdir("../productpics/$tablename/thumbs");
		
		require('includes/smarturls.php');
		
		header("Location: store.php?message=2");
		exit;
	} else {
		$pic1 = "noimage.jpg";
		$sql="INSERT INTO `products` (category, subcategory, name, description, price, quantity, featured, pic1, ounces, option1, option2, option3, option4, option5, metatitle, metadescription, metakeywords, type) VALUES('$category','$subcategory','$name','$description','$price','$quantity','$featured','$pic1','$ounces','$optionslist1','$optionslist2','$optionslist3','$optionslist4','$optionslist5','$metatitle','$metadescription','$metakeywords','$type')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		
		if (move_uploaded_file($_FILES['pic2']['tmp_name'], $target2)) {
			
		} else {
			mysql_query("UPDATE `products` SET `cad`='nocad' WHERE `id` = '$productid' ");
		}
		
		//Create Folders and Table
		$result = mysql_query("SELECT * FROM `products` ORDER BY `id` DESC");
		$r = mysql_fetch_array($result);
		$productid = ($r['id']);
		$tablename = "ProductGallery_" . $productid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, filename varchar(200),caption varchar(1000), picorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		mkdir("../productpics/$tablename");
		mkdir("../productpics/$tablename/thumbs");
		
		require('includes/smarturls.php');
		
		header("Location: store.php?message=2");
		exit;
	}
	
} else {

$error = ($_GET['error']);
$category = ($_GET['category']);
$subcategory = ($_GET['subcategory']);
$name = ($_GET['name']);
$description = ($_SESSION['s1']);
$wearing = ($_SESSION['s5']);
$metatitle = ($_SESSION['s2']);
$metadescription = ($_SESSION['s3']);
$metakeywords = ($_SESSION['s4']);
$price = ($_GET['price']);
$quantity = ($_GET['quantity']);
$featured = ($_GET['featured']);
$recipe1 = ($_GET['text1']);
$recipe2 = ($_GET['text2']);
$part = ($_GET['partnumber']);
$ounces = ($_GET['ounces']);
$optionslist1 = ($_GET['option1']);
$optionslist2 = ($_GET['option2']);
$optionslist3 = ($_GET['option3']);
$optionslist4 = ($_GET['option4']);
$optionslist5 = ($_GET['option5']);
$optionslist6 = ($_GET['option6']);
$option6 = ($_GET['option6']);
$option7 = ($_GET['option7']);
$option8 = ($_GET['option8']);
$option9 = ($_GET['option9']);
$option10 = ($_GET['option10']);
$option11 = ($_GET['option11']);
$option12 = ($_GET['option12']);
$option13 = ($_GET['option13']);
$option14 = ($_GET['option14']);
$option15 = ($_GET['option15']);
$option16 = ($_GET['option16']);
$option17 = ($_GET['option17']);
$option18 = ($_GET['option18']);
$option19 = ($_GET['option19']);
$option20 = ($_GET['option20']);
$option21 = ($_GET['option21']);
$option22 = ($_GET['option22']);
$option23 = ($_GET['option23']);
$option24 = ($_GET['option24']);
$option25 = ($_GET['option25']);
$option26 = ($_GET['option26']);
$option27 = ($_GET['option27']);
$option28 = ($_GET['option28']);
$option29 = ($_GET['option29']);
$option30 = ($_GET['option30']);

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

if ($error == 3) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
<td class=\"editpageright\">Your image can not be larger than 2 MB.
</td>
<td class=\"editpagehints\">
</td>
</tr>";
}
	
echo"<form enctype='multipart/form-data' action=\"addstoreproduct.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">*Category:</td>
<td class=\"editpageright\">";
echo'<select name="category">';
$result = mysql_query('SELECT * FROM `store_categories` ORDER BY `pageorder` ASC');
while ($r = mysql_fetch_array($result)) {
	$categoryname = ($r['name']);
	$categoryid = ($r['id']);
	if ($category == $categoryname) {
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

/*
echo"
<tr>
<td class=\"editpageleft\">Part Number:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"part\" value=\"$part\" size=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the part number for the product.
</td></tr>";
*/

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
</td></tr>

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
	echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	$result = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `id` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option1" . $count;
			
			$optionarray = explode(",", $optionslist1);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
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



$count = 1;
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
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option2" . $count;
			
			$optionarray = explode(",", $optionslist2);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
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



$count = 1;
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
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option3" . $count;
			
			$optionarray = explode(",", $optionslist3);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
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


$count = 1;
$result = mysql_query("SELECT * FROM `product_option4`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 4: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
	echo"<table width='100%' cellpadding='0' cellspacing='0'>";
	$result = mysql_query("SELECT * FROM `product_option4_list` ORDER BY `id` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option4" . $count;
			
			$optionarray = explode(",", $optionslist4);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			
			echo"<tr>";
			echo"<td width='30px' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<input type='checkbox' name='$spot' value='$id' "; if ($foundit == 1) {echo"checked='checked'";} echo"/>";
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



echo"
<tr>
<td class=\"editpageleft\">Product Image: <br /><span style='font-size:10px;'>Max File Size: 2MB</span></td>
<td class=\"editpageright\">";
echo"<input type='file' name=\"pic1\" />";
echo"</td><td class=\"editpagehints\">
This is the image for this product.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"submit\" name=\"submit\" value=\"Add Product\" />
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




