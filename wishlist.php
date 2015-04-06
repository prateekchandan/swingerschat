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

if (isset($_GET['pagetype'])) {
	$pagetype = ($_GET['pagetype']);
}

//MEMBERS ONLY CHECK
$membersonly = 1;
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
   
     <div class="contentarea">
       <div class="contentarea_left">
         <div class="category">
           <div class="category_top"></div>
           
           <div class="category_inner">
		<?php require('includes/storenav.php'); ?>
           </div>
         </div>
         
         
         <?php require('includes/follow.php'); ?>
       </div>
       
       <div class="contentarea_right">
	
	<table align="left" cellpadding="0px" cellspacing="0px" width='650px'>
		<tr>
		<?php
		$memberid = ($_SESSION['memberloggedin']);

		$result = mysql_query("SELECT * FROM `wishlist` WHERE `memberid` = '$memberid' ORDER BY id ASC");
		$rows = mysql_num_rows($result);
	
		echo"<td align=\"left\" valign=\"top\" colspan='2' class=\"catalog\" style='border-bottom:1px solid #000000;'>";
		echo"My Wishlist";
		echo"</td>";
	
		$count = 0;
		$count2 = 0;
	
		echo"</tr>";
		echo"<tr>";
			
		if ($rows < 1) {
			echo"<td colspan='2' align='center'><br /><br />There are no items in your wishlist.<br /><br /></td>";
		}
		while ($r = mysql_fetch_array($result)) {
			$productid = ($r['productid']);
			$result5 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
			$r5 = mysql_fetch_array($result5);
			$ghost = ($r5['ghost']);
			if ($ghost != 0) {
				$result6 = mysql_query("SELECT * FROM `products` WHERE `id` = '$ghost'");
				$r6 = mysql_fetch_array($result6);
				$productid = ($r6['id']);
				$name = ($r6['name']);
				$pic1 = ($r6['pic1']);
				$price = ($r6['price']);
				$featured = ($r6['featured']);
			} else {
				$name = ($r5['name']);
				$pic1 = ($r5['pic1']);
				$price = ($r5['price']);
				$featured = ($r5['featured']);
			}
			
			
			echo"<td align=\"center\" valign=\"top\" width=\"225px\" height=\"300px\" class=\"catalog\">";
				echo"<div class='protitle'>$name</div>";
				echo"<a href=\"storeproduct.php?productid=$productid&catid=$catid&subid=$subid\"><img src=\"productpics/$pic1\" width=\"210px\" /></a><br />";
				echo"<div class='proprice'>$$price</div>";
				echo"<div class='prolink'><a href=\"storeproduct.php?productid=$productid&catid=$catid&subid=$subid\">VIEW DETAILS</a></div>";
			echo"</td>";
			$count += 1;
			if ($count > 1) {
				echo"</tr><tr>";
				$count = 0;
			}
		}
		if ($count != 0) {
			while ($count < 2) {
				echo"<td width=\"225px\" class=\"catalog\"></td>";
				$count += 1;
			}
		}
		echo"</tr></table>";
		?>
	
       </div>
    </div>
    
     <div class="footer">
       <p><?php require('includes/footernav.php'); ?></p>
       <p class="copyrighttxt"><?php require('includes/copyright.php'); ?></p>
     </div>
  </div>
</div>
</body>
</html>

<?php
ob_end_flush();
?>
