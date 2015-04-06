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


<tr>
<td class="bodytable1" <?php if (($pagetype != "Home Page") && ($pagetype != "Store")) { echo"style='height:830px; background-image:url(images/bodyback.jpg);background-repeat:no-repeat; background-position:top center;'"; } ?>>
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='text4'>
	<div class='div4'>
	<?php
		$articleid = ($_GET['articleid']);
			
		$url = $_SERVER['PHP_SELF'];
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page'])){
			$pageNum = $_GET['page'];
		} else {
			$pageNum = 1;
		}
		$rowsPerPage = "10";
		// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;
    
		echo"<table cellpadding='0px' cellspacing='0' border='0' width='600px' style='font-size:12px; margin-left:5px;'>";
		$result = mysql_query("SELECT * FROM `blog` WHERE `approved` = '1' ORDER BY `date` DESC LIMIT $offset, $rowsPerPage");
		$result3 = mysql_query("SELECT * FROM `blog` WHERE `approved` = '1' ORDER BY `date` DESC");
		$rows3 = mysql_num_rows($result3);
		while ($r = mysql_fetch_array($result)) {
			$rows = mysql_num_rows($result);
    
			$approved = ($r['approved']);
			$picby = stripslashes($r['picby']);
			$articleid = ($r['id']);
			$articlephoto = ($r['picture']);
			$title = stripslashes($r['title']);
			$title = str_replace("\n", "<br />", $title);
			$title = strtoupper($title);
			$ref = stripslashes($r['ref']);
			$ref = str_replace("\n", "<br />", $ref);
			$vid = stripslashes($r['video']);
			$date = ($r['date']);
			$article = stripslashes($r['text']);
			$article = str_replace("\n", "<br />", $article);
			$article2 = substr($article, 0, 150);
			//$article2 = explode_wrap($article2, 20, 130);
			$article2 = wordwrap($article2,30," ",true);
			$articlearray = explode('.',$article2);
			$article2 = $articlearray[0] . "...";
			$month = date('n',"$date");
			$day = date('j',"$date");
			$year = date('Y',"$date");
			$hour = date('g',"$date");
			$minute = date('i',"$date");
			$meridiem = date('a',"$date");
			$time = $hour . ":" . $minute . " " . $meridiem;
			$time2 = $month . "/" . $day . "/" . $year;
			$author = ($r['authorid']);
			$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$author'");
			$r2 = mysql_fetch_array($result2);
			$authorname = ($r2['username']);
			$photo = ($r2['photo']);
			if ($photo == "") {
				$photo = "noimage.jpg";
			}
			//old photo size 460 x 270
			echo"<tr>";
			echo"<td align='left' valign='top' style='font-size:18px; font-weight:bold; color:#000000; border-top:0px solid #cccccc;'>$title</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td align='left' valign='top' style='font-size:12px; font-weight:400; color:#969292;'><div style='margin-bottom:16px;'>posted at $time on $time2</div></td>";
			echo"</tr>";
			if ($articlephoto != "") {
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:12px; font-weight:bold; color:#000000;'><img src='articlepictures/$articlephoto' width='425px' />";
				echo"</tr>";
			}
			if ($vid != "") {
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:12px; font-weight:bold; color:#000000;'><div style='margin-bottom:16px;'>$vid</div></td>";
				echo"</tr>";
			}
			echo"<tr>";
			echo"<td align='left' valign='top' style='font-size:16px; font-weight:400; color:#000000; border-bottom:0px solid #cccccc;'>$article2</td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td align='left' valign='top' style='font-size:12px; font-weight:400; color:#000000; border-bottom:0px solid #cccccc;'><div style='margin-top:12px; margin-bottom:8px;'><a href='blog2.php?articleid=$articleid'>[more]</a></div></td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td align='left' valign='top' style='height:7px; border-right:1px solid #cccccc;'></td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td align='left' valign='top' style='height:7px; border-right:1px solid #cccccc; border-top:1px solid #cccccc;'></td>";
			echo"</tr>";


		}
	
		
		echo"<tr>";
		echo"<td align='center' valign='top'>";

		
		// how many pages we have when using paging?
		$maxPage = ceil($rows3/$rowsPerPage);
		$maxPage1 = ($maxPage + 1);
		
	
		// print the link to access each page
		$self = $_SERVER['PHP_SELF'];
		$nav  = '';
	
		for($page = 1; $page < $maxPage1; $page++){
			if ($page == $pageNum){
				$nav .= "$page"; // no need to create a link to current page
			} else {
				$nav .= " <a href='index.php?pageid=$pageid&page=$page'>$page</a> ";
			}
		}
	
	
		// creating previous and next link
		// plus the link to go straight to
		// the first and last page
	
		if ($pageNum > 1){
			$page  = $pageNum - 1;
			$prev  = " <a href='index.php?pageid=$pageid&page=$page'>[Prev]</a> ";
	
			$first = " <a href='index.php?pageid=$pageid&page=1'>[First Page]</a> ";
		} else {
			$prev  = "<span style=\"color:#cccccc;\">[Prev]</span>"; // we're on page one, don't print previous link
			$first = "<span style=\"color:#cccccc;\">[First Page]</span>"; // nor the first page link
		}
	
	
		if ($pageNum < $maxPage){
			$page = $pageNum + 1;
			$next = "  <a href='index.php?pageid=$pageid&page=$page'>[Next]</a> ";
	
			$last = "  <a href='index.php?pageid=$pageid&page=$maxPage'>[Last Page]</a>  ";
		} else {
			$next = "<span style=\"color:#cccccc;\">[Next]</span>"; // we're on the last page, don't print next link
			$last = "<span style=\"color:#cccccc;\">[Last Page]</span>"; // nor the last page link
		}
	
		// print the navigation link
		echo"<div class=\"catalogfooternav\" style='text-align:center; margin-top:15px; margin-bottom:70px;'>";
		echo"$first . $prev . $nav . $next . $last";
		echo "</div>";
		echo"</td>";
		echo"</tr>";
		echo"</table>";
	?>
	</div>
	</td>
	
	<td class='text5'>
	<div class='div5'>
	<?php
	require ('includes/blogcolumn.php');
	?>
	</div>
	</td>
	</tr>
	</table>
</td>
</tr>

<?php
require ('includes/footer.php');
?>
</table>
</body>
</html>

<?php
ob_end_flush();
?>
