<?php
require ('includes/dbconnect.php');

if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$pagetype = ($r['type']);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);
$membersonly = ($r['membersonly']);

$productid = ($_GET['productid']);
$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
$r = mysql_fetch_array($result);
$title = strip_tags($r['metatitle']);
$description = strip_tags($r['metadescription']);
$keywords = strip_tags($r['metakeywords']);


if (isset($_GET['pagetype'])) {
	$pagetype = ($_GET['pagetype']);
}

//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}

require ('includes/head.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>
<!--Container-->
    <div class="container">
	
		<?php
		$productid = ($_GET['productid']);
		$result5 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
		$r5 = mysql_fetch_array($result5);
		$name = ($r5['name']);
		$description = ($r5['description']);
		$price = ($r5['price']);
		$quantity = ($r5['quantity']);
		$featured = ($r5['featured']);
		$pic1 = ($r5['pic1']);
		$optionslist1 = ($r5['option1']);
		$optionslist2 = ($r5['option2']);
		$optionslist3 = ($r5['option3']);
		$optionslist4 = ($r5['option4']);
		$optionslist5 = ($r5['option5']);
		$option6 = ($r5['option6']);
		$option7 = ($r5['option7']);
		$option8 = ($r5['option8']);
		$option9 = ($r5['option9']);
		$option10 = ($r5['option10']);
		$option11 = ($r5['option11']);
		$option12 = ($r5['option12']);
		$option13 = ($r5['option13']);
		$option14 = ($r5['option14']);
		$option15 = ($r5['option15']);
		$option16 = ($r5['option16']);
		$option17 = ($r5['option17']);
		$option18 = ($r5['option18']);
		$option19 = ($r5['option19']);
		$option20 = ($r5['option20']);
		$option21 = ($r5['option21']);
		$option22 = ($r5['option22']);
		$option23 = ($r5['option23']);
		$option24 = ($r5['option24']);
		$option25 = ($r5['option25']);
		$option26 = ($r5['option26']);
		$option27 = ($r5['option27']);
		$option28 = ($r5['option28']);
		$option29 = ($r5['option29']);
		$option30 = ($r5['option30']);
		$catid = ($r5['category']);
		$subid = ($r5['subcategory']);
		$result = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$catid'");
		$r = mysql_fetch_array($result);
		$catname = ($r['name']);
		$result = mysql_query("SELECT * FROM `store_subcategories` WHERE `id` = '$subid'");
		$r = mysql_fetch_array($result);
		$subname = ($r['name']);
		
		
		//Add to Recently Viewed by IP address
		$ip=getenv("REMOTE_ADDR");
		$time = time();
		$result = mysql_query("SELECT * FROM `recent` WHERE `ip` = '$ip' AND `productid` = '$productid'");
		$rows = mysql_num_rows($result);
		if ($rows < 1) {
			$sql="INSERT INTO `recent` (ip, productid, timestamp) VALUES('$ip','$productid','$time')";
			if (!mysql_query($sql,$dbc)) {
				die('Sorry, there was an error. Please try again.');
			}
		}
		//END
		?>
		<table align='left' cellpadding="0" cellspacing="0px" border="0" width="880px">
		<tr>
		<?php
		$catlist = "<a href='store.php'>FEATURED ITEMS</a> - <a href='store.php?catid=$catid'>$catname</a>";
	
		echo"<td align=\"left\" valign=\"top\" colspan='4' class=\"catalog\" style='border-bottom:1px solid #000000;'>";
		echo"$catlist";
		echo"</td>";
		?>
		</tr>
		
		<tr>
		<td colspan="4" align="left">
			<table cellpadding="0px" cellspacing="0px" border="0" width="100%" style='margin:20px;'>
			<tr>
			<td align="left" valign="top" width="220px">
			<?php 
			if ($pic1 != "noimage.jpg") {
				echo"<a href=\"productpics/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='productpics/$pic1' width='200px' /></a>"; 
			} else {
				echo"<img src='productpics/noimage.jpg' width='200px' height='200px'/>";
			}
			?>
            
            <?php
        $tablename = "ProductGallery_" . $productid;
		echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\"><tr>";
		$count = 0;
		$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `picorder`");
		while ($r = mysql_fetch_array($result)) {
			$photoid = ($r['id']);
			$filename = ($r['filename']);
			$caption = ($r['caption']);
	
			echo "<td class='gallerycell'><a href=\"productpics/$tablename/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"productpics/$tablename/thumbs/$filename\" class='galleryimage'/></a></td>";
			
			$count += 1;
			if ($count > 2) {
				echo"</tr><tr>";
				$count = 0;
			}
		}
		while ($count < 3) {
			echo"<td class='gallerycell' align=\"center\" width=\"50px\"></td>";
			$count += 1;
		}
		echo"</tr>";
		echo"</table>";
		?>
			</td>
			
			<td align="left" valign="top" class="storeproductcell" >
			<?php
			echo"<h1>$name</h1>";
			echo"Price: $$price <br /><br />";
			
			echo"<form enctype=\"multipart/form-data\" action=\"storeaddtocart.php\" method=\"post\">";
		
			echo"<table cellpadding='2px'>";
			$result = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `id` ASC");
			$rows = mysql_num_rows($result);
			if (($optionslist1 != "")) {
				$result2 = mysql_query("SELECT name FROM `product_option1`");
				while ($r2 = mysql_fetch_array($result2)) {
					$optionname = ($r2['name']);
					echo"<tr><td align='left' valign='top'>$optionname: </td>";
				}
				$count = 1;
				echo"<td align='left' valign='top'>";
				echo"<select name='option1' onchange=\"changemainpic($productid,this.value, 'mainproductimagepart1', 'product_option1')\";>";
				$result2 = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `picorder` ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$option = ($r2['name']);
					$extracharge = ($r2['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {$chargedisplay .= " - $" . $extracharge . " extra";}
					$optionid = ($r2['id']);
					$spot = "option" . $count;
					$optionarray = explode(",", $optionslist1);
					for ($x = 0; $x < count($optionarray); $x++) {
						$currentoption = $optionarray[$x];
						if ($currentoption == $optionid) {
							echo"<option value='$option'>$option $chargedisplay</option>";
						}
					}
					$count += 1;
				}
				echo"</select>";
				echo"</td></tr>";
			
			}
			//option 2
			$result = mysql_query("SELECT * FROM `product_option2_list` ORDER BY `id` ASC");
			$rows = mysql_num_rows($result);
			if (($optionslist2 != "")) {
				$result2 = mysql_query("SELECT name FROM `product_option2`");
				while ($r2 = mysql_fetch_array($result2)) {
					$optionname = ($r2['name']);
					echo"<tr><td align='left' valign='top'>$optionname: </td>";
				}
				$count = 1;
				echo"<td align='left' valign='top'>";
				echo"<select name='option2' onchange=\"changemainpic($productid,this.value, 'mainproductimagepart2', 'product_option2')\";>";
				$result2 = mysql_query("SELECT * FROM `product_option2_list` ORDER BY `picorder` ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$option = ($r2['name']);
					$extracharge = ($r2['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {$chargedisplay .= " - $" . $extracharge . " extra";}
					$optionid = ($r2['id']);
					$spot = "option2" . $count;
					$optionarray = explode(",", $optionslist2);
					for ($x = 0; $x < count($optionarray); $x++) {
						$currentoption = $optionarray[$x];
						if ($currentoption == $optionid) {
							echo"<option value='$option'>$option $chargedisplay</option>";
						}
					}
					$count += 1;
				}
				echo"</select>";
				echo"</td></tr>";
			
			}
			
			
			//option 3
			$result = mysql_query("SELECT * FROM `product_option3_list` ORDER BY `id` ASC");
			$rows = mysql_num_rows($result);
			if (($optionslist3 != "")) {
				$result2 = mysql_query("SELECT name FROM `product_option3`");
				while ($r2 = mysql_fetch_array($result2)) {
					$optionname = ($r2['name']);
					echo"<tr><td align='left' valign='top'>$optionname: </td>";
				}
				$count = 1;
				echo"<td align='left' valign='top'>";
				echo"<select name='option3' onchange=\"changemainpic($productid,this.value, 'mainproductimagepart3', 'product_option3')\";>";
				$result2 = mysql_query("SELECT * FROM `product_option3_list` ORDER BY `picorder` ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$option = ($r2['name']);
					$extracharge = ($r2['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {$chargedisplay .= " - $" . $extracharge . " extra";}
					$optionid = ($r2['id']);
					$spot = "option3" . $count;
					$optionarray = explode(",", $optionslist3);
					for ($x = 0; $x < count($optionarray); $x++) {
						$currentoption = $optionarray[$x];
						if ($currentoption == $optionid) {
							echo"<option value='$option'>$option $chargedisplay</option>";
						}
					}
					$count += 1;
				}
				echo"</select>";
				echo"</td></tr>";
			
			}
			
			//option 4
			$result = mysql_query("SELECT * FROM `product_option4_list` ORDER BY `id` ASC");
			$rows = mysql_num_rows($result);
			if (($optionslist4 != "")) {
				$result2 = mysql_query("SELECT name FROM `product_option4`");
				while ($r2 = mysql_fetch_array($result2)) {
					$optionname = ($r2['name']);
					echo"<tr><td align='left' valign='top'>$optionname: </td>";
				}
				$count = 1;
				echo"<td align='left' valign='top'>";
				echo"<select name='option4' onchange=\"changemainpic($productid,this.value, 'mainproductimagepart4', 'product_option4')\";>";
				$result2 = mysql_query("SELECT * FROM `product_option4_list` ORDER BY `picorder` ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$option = ($r2['name']);
					$extracharge = ($r2['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {$chargedisplay .= " - $" . $extracharge . " extra";}
					$optionid = ($r2['id']);
					$spot = "option4" . $count;
					$optionarray = explode(",", $optionslist4);
					for ($x = 0; $x < count($optionarray); $x++) {
						$currentoption = $optionarray[$x];
						if ($currentoption == $optionid) {
							echo"<option value='$option'>$option $chargedisplay</option>";
						}
					}
					$count += 1;
				}
				echo"</select>";
				echo"</td></tr>";
			
			}
			
			
			echo"</table>";
			
			
			echo"
			<input type='hidden' name='productid' value=\"$productid\" />
			<button class='custombutton' type='submit'><img src='images/addtocart.png' alt='Add to Cart'  /></button>
			<br /><br />
			</form>
			<a href='storeaddtowishlist.php?productid=$productid'><img src='images/wishlist.png' /></a>
			";
			
			echo"<br />$description";
			
			
			//Product Reviews
			echo"<br /><br />";
			echo"<h1>Product Reviews</h1>";
			if (isset($_SESSION['memberloggedin'])) {
				echo"<a href='storereviewsform.php?productid=$productid'>Click here to write your review.</a>";
			} else {
				echo"<a href='login.php'>Login to write your review.</a></span>";
			}
			
			echo"<br /><br /><hr color='#cccccc' />";
			echo"<strong>Overall Rating</strong> &nbsp;&nbsp;";
			$result3 = mysql_query("SELECT * FROM `productreviews` WHERE `productid`='$productid' AND `approved`='1'");
			$rows3 = mysql_num_rows($result3);
			while ($r3 = mysql_fetch_array($result3)) {
				$starnum += ($r3['stars']);
			}
			if ($rows3 > 0) {
				$startotal = ($starnum / $rows3);
				$startotal = floor($startotal);
				while ($startotal > 0) {
					echo"<img src='images/star.gif' />";
					$startotal -= 1;
				}
			} else {
				echo"(0) <img src='images/star-empty.gif' />";
			}	
			echo"<br /><hr color='#cccccc' /><br /><br />";
			$result5 = mysql_query("SELECT * FROM `productreviews` WHERE `productid`='$productid' AND `approved`='1' ORDER BY `date`");
			while ($r5 = mysql_fetch_array($result5)) {
			    $rid = ($r5['id']);
			    $review = stripslashes($r5['review']);
			    $review = str_replace("\n", "<br />", $review);
			    $name = stripslashes($r5['name']);
			    $stars = ($r5['stars']);
			    $time3 = ($r5['date']);
				$month = date('n',"$time3");
				$day = date('j',"$time3");
				$year = date('Y',"$time3");
				$hour = date('g',"$time3");
				$minute = date('i',"$time3");
				$meridiem = date('a',"$time3");
				$date = $month . "/" . $day . "/" . $year . " at " . $hour . ":" . $minute . " " . $meridiem;
				echo"<div style='margin:20px 50px 20px 50px;'>";
				if ($stars > 0) {
					//echo"($stars)";
					while ($stars > 0) {
						echo"<img src='images/star.gif' />";
						$stars -= 1;
					}
				} else {
					echo"(0) <img src='images/star-empty.gif' />";
				}
			    echo"<div style='font-size:12px; color:#cccccc; text-align:left;'><em>~ Posted by $name on $date</em></div><br /><br />";
			    echo"\"$review\"";
			    echo"<br /><br />";
			    
			    echo"<hr color='#cccccc' /><br /><br />";
			    echo"</div>";
			}
			?>
			</td>

			</tr>
			</table>
		</td>
		</tr>

		</table>
	
        <div class="clr"></div>
        <div class="spacer"></div>
        
    </div>
    <div class="containerBttm"></div>
   
<div class="clr"></div>
</div>
<?php require('includes/footer.php'); ?>
</body>
</html>

<?php
ob_end_flush();
?>
