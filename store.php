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
require ('includes/head.php');
?>
<div class="bottom-container container" style="box-shadow:-38px 0px 90px -48px #000;">
	<img src="images/left.png" class="cat-img"/>
		<div class="pull-left left-side">
		<?php require('includes/leftcolumn.php'); ?>
		</div>
		<div class="pull-right">
			<div class='div1'>
			<?php
			if (isset($_POST['keyword'])) {
				$keyword = ($_POST['keyword']);
			}
			if (isset($_GET['catid'])) {
				$catid = ($_GET['catid']);
				$result = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$catid'");
				$r = mysql_fetch_array($result);
				$catname = ($r['name']);
			}
			if (isset($_GET['subid'])) {
				$subid = ($_GET['subid']);
				$result = mysql_query("SELECT * FROM `store_subcategories` WHERE `id` = '$subid'");
				$r = mysql_fetch_array($result);
				$subname = ($r['name']);
			}
				
			$url = $_SERVER['PHP_SELF'];
			// if $_GET['page'] defined, use it as page number
			if(isset($_GET['page'])){
			    $pageNum = $_GET['page'];
			} else {
			    $pageNum = 1;
			}
			$rowsPerPage = "6";	
			// counting the offset
			$offset = ($pageNum - 1) * $rowsPerPage;
		
			$catlist = "<a href='store.php'>FAVORITES</a>";
		
			if ((isset($_POST['keyword'])) OR (isset($_GET['keyword']))) {
				if (isset($_POST['keyword'])) {$keyword = ($_POST['keyword']); }
				if (isset($_GET['keyword'])) {$keyword = ($_GET['keyword']); }
				$keyword2 = "%" . $keyword . "%"; 
				$result = mysql_query("SELECT * FROM `products` WHERE (`name` LIKE '$keyword2' OR `description` LIKE '$keyword2') AND `quantity` > '0' ORDER BY picorder ASC LIMIT $offset, $rowsPerPage");
				$result2 = mysql_query("SELECT * FROM `products` WHERE (`name` LIKE '$keyword2' OR `description` LIKE '$keyword2') AND `quantity` > '0'");
				$rows2 = mysql_num_rows($result2);
				$returnvalues="keyword=$keyword";
			} else if ((isset($_GET['catid'])) && (isset($_GET['subid']))) { 
				$result = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid' AND `subcategory`='$subid' AND `quantity` > '0' ORDER BY picorder ASC LIMIT $offset, $rowsPerPage");
				$result2 = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid' AND `subcategory`='$subid' AND `quantity` > '0'");
				$rows2 = mysql_num_rows($result2);
				$returnvalues="catid=$catid&subid=$subid";
				$catlist .= " - <a href='store.php?catid=$catid'>$catname</a>- $subname";
			} else if (isset($_GET['catid'])) { 
				$result = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid' AND `quantity` > '0' ORDER BY picorder ASC LIMIT $offset, $rowsPerPage");
				$result2 = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid' AND `quantity` > '0'");
				$rows2 = mysql_num_rows($result2);
				$returnvalues="catid=$catid";
				$catlist .= " - $catname ";
			} else {
				$result = mysql_query("SELECT * FROM `products` WHERE `featured`='1' AND `quantity` > '0' ORDER BY picorder ASC LIMIT $offset, $rowsPerPage");
				$result2 = mysql_query("SELECT * FROM `products` WHERE `featured`='1' AND `quantity` > '0'");
				$rows2 = mysql_num_rows($result2);
			}
			
			//This will show full list of categories
			/*
			$catlist = "<a href='store.php'>ALL ITEMS</a>";
			$result3 = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder`");
			while ($r3 = mysql_fetch_array($result3)) {
				$catid = ($r3['id']);
				$catname = ($r3['name']);
				$catlist .= " - <a href='store.php?catid=$catid'>$catname</a>";
			}
			*/
		
			echo"<p>";
			echo"$catlist";
			echo"</p>";
		
			$count = 0;
			$count2 = 0;
				
			if ($rows2 < 1) {
				if (isset($_POST['keyword'])) {
					echo"<p align='center'><br /><br />Sorry, we could not find any results.<br /><br /></p>";
				} else {
					echo"<p align='center'><br /><br />New products will be added soon.<br /><br /></p>";
				}
				
				
			}
			while ($r = mysql_fetch_array($result)) {
				$ghost = ($r['ghost']);
				if ($ghost != 0) {
					$result5 = mysql_query("SELECT * FROM `products` WHERE `id` = '$ghost'");
					$r5 = mysql_fetch_array($result5);
					$productid = ($r5['id']);
					$catid = ($r5['category']);
					$result3 = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$catid'");
					$r3 = mysql_fetch_array($result3);
					$category = ($r3['name']);
					$categorytext = ($r3['text']);
					$categoryimage = ($r3['mainimage']);
					$subid = ($r5['subcategory']);
					$name = ($r5['name']);
					$pic1 = ($r5['pic1']);
					$price = ($r5['price']);
					$featured = ($r5['featured']);
				} else {
					$productid = ($r['id']);
					$catid = ($r['category']);
					$result3 = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$catid'");
					$r3 = mysql_fetch_array($result3);
					$category = ($r3['name']);
					$categorytext = ($r3['text']);
					$categoryimage = ($r3['mainimage']);
					$subid = ($r['subcategory']);
					$name = ($r['name']);
					$pic1 = ($r['pic1']);
					$price = ($r['price']);
					$featured = ($r['featured']);	
				}
				
				
				$picsize = getimagesize("productpics/$pic1");
                                $picx = $picsize[0];
                                $picy = $picsize[1];

                                if ($picy / $picx > 1) { //if image is taller than it is wide
                                    $divider = ($picy / 190);
                                    $picy = 190;
                                    $picx = ($picx / $divider) . "px";
                                } else { //if image is wider than tall
                                    $divider = ($picx / 190);
                                    $picx = 190;
                                    $picy = ($picy / $divider) . "px";
                                }
                                
                                echo"<div class='productdiv'>";
                                //echo"<div class='proprice'><span class= 'propricespan'>$$price</span></div>";
                                echo"<a href='storeproduct.php?productid=$productid&catid=$catid&subid=$subid'>";
                                echo"<img src='productpics/$pic1' style='display: block; float: none; width: $picx; height: $picy; margin:40px auto 0px auto;' />";
                                echo"</a>";
                                echo"<div class='protitle'>";
                                echo"<span class= 'protitlespan'>$name</span>";
                                echo"</div>";
                                echo"</div>";
				
			}
			
		
			
			// how many pages we have when using paging?
			$maxPage = ceil($rows2/$rowsPerPage);
			$maxPage1 = ($maxPage + 1);
			
		
			// print the link to access each page
			$self = $_SERVER['PHP_SELF'];
			$nav  = '';
			
			$lastpageNum = $pageNum + 10;
			$firstpageNum = $pageNum - 10;
			$maxPage2 = $maxPage1 + 1;
			
			for($page = $firstpageNum; $page < $lastpageNum; $page++){
			    if ($page == $pageNum){
				$nav .= "$page"; // no need to create a link to current page
			    } else {
				if (($page > 0) && ($page < $maxPage1)) {
					$nav .= " <a href=\"$self?page=$page&$returnvalues\">$page</a> ";
				}
			    }
			}
		
		
			// creating previous and next link
			// plus the link to go straight to
			// the first and last page
		
			if ($pageNum > 1){
				$page  = $pageNum - 1;
				$prev  = " <a href='$self?pageid=$pageid&page=$page&$returnvalues'>[Prev]</a> ";
		
				$first = " <a href='$self?pageid=$pageid&page=1&$returnvalues'>[First Page]</a> ";
			} else {
				$prev  = "<span >[Prev]</span>"; // we're on page one, don't print previous link
				$first = "<span >[First Page]</span>"; // nor the first page link
			}
		
		
			if ($pageNum < $maxPage){
				$page = $pageNum + 1;
				$next = "  <a href='$self?pageid=$pageid&page=$page&$returnvalues'>[Next]</a> ";
		
				$last = "  <a href='$self?pageid=$pageid&page=$maxPage&$returnvalues'>[Last Page]</a>  ";
			} else {
				$next = "<span>[Next]</span>"; // we're on the last page, don't print next link
				$last = "<span>[Last Page]</span>"; // nor the last page link
			}
		
			// print the navigation link
			echo"<div class='clear'></div>";
			echo"<div class=\"catalogfooternav\" style='text-align:center; width:700px;'>";
			echo"$first . $prev . $nav . $next . $last";
			echo "</div>";
			?>
			</div>
		</div>
	<a href='index.php?id=74'><img src="images/right.png" class="contact-img"/></a>
	<div class="clear"></div>
</div>
<?php require('includes/footer.php'); ?>
</body>
</html>


<?php
ob_end_flush();
?>
