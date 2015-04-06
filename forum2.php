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

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="850px">
    <tr>
    <td class='text6' colspan='2'>
    <div class='div6'>
    <?php 
	if (isset($_SESSION['memberloggedin'])) {
		$memberid = ($_SESSION['memberloggedin']);
		$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
		$r = mysql_fetch_array($result);
		$forumadmin = ($r['forumadmin']);
	}
	
	$categoryid = ($_GET['categoryid']);
	$result = mysql_query("SELECT * FROM `F_Categories` WHERE `id` = '$categoryid'");
	$r = mysql_fetch_array($result);
	$name = ($r['name']);
	$adminonly = ($r['adminonly']);
	echo"<a href='forum.php'>Choose a category</a> - <strong>$name</strong>"; 
	?>
	
		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
	<?php
		echo"
		<tr>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;' width='400px'>
		POST
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		REPLIES
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		LAST POST
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		POSTED BY
		</td>
		</tr>";
		
	$tablename = "F_" . $categoryid;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `lastpost` DESC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {	
			$postid = ($r['id']);
			$comment = stripslashes($r['comment']);
			$comment = str_replace("\n", "<br />", $comment);
			$posterid = ($r['memberid']);
			$lastpost = ($r['lastpost']);
			$tablename2 = "F_" . $categoryid . "_" . $postid;
			$result2 = mysql_query("SELECT * FROM `$tablename2`");
			$rows2 = mysql_num_rows($result2);
			$result3 = mysql_query("SELECT * FROM `members` WHERE `id` = '$posterid'");
			$r3 = mysql_fetch_array($result3);
			$rows3 = mysql_num_rows($result3);
			$first = ($r3['first']);
			$last = ($r3['last']);
			
			echo"
			<tr>
			<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>
			<a href=\"forum3.php?categoryid=$categoryid&postid=$postid\"><img src='images/comment.jpg' /></a>";
			if ($forumadmin == 1) {
				echo"<br /><a href=\"forumdeletepost.php?tablename=$tablename&messageid=$postid&categoryid=$categoryid\" onclick=\"return confirm('Are you sure you want to delete this post? All comments within this post will be deleted as well.');\"><img src='images/deletepost.jpg' /></a>";
			}
			echo"
			</td>
			<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>
			<div style='margin:20px 20px 20px 0px;'>$comment <br /><br /></div>
			</td>
			<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>
			$rows2
			</td>
			<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>
			$lastpost
			</td>
			<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>";
			if ($rows3 < 1) {
				echo"Member Deleted";
			} else {
				echo"$first $last";
			}
			
			echo"</td>
			</tr>";
		}
		
		if ($adminonly != 1) {
			echo"
			<tr>
			<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-top:5px solid #2984b0;' colspan='5'>
			<a href=\"forumpost.php?categoryid=$categoryid\">Click here to post your message.</a>
			</td>
			</tr>";
		} else if ($forumadmin == 1) {
			echo"
			<tr>
			<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-top:5px solid #2984b0;' colspan='5'>
			<a href=\"forumpost.php?categoryid=$categoryid\">Click here to post your message.</a>
			</td>
			</tr>";
		}
		
	} else {
		if ($adminonly != 1) {
			echo"
			<tr>
			<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;' colspan='5'>
			<br /><br />Be the first to post in this category!<br /><br />
			<a href=\"forumpost.php?categoryid=$categoryid\">Click here to post your message.</a>
			</td>
			</tr>";
		} else if ($forumadmin == 1) {
			echo"
			<tr>
			<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;' colspan='5'>
			<br /><br />Be the first to post in this category!<br /><br />
			<a href=\"forumpost.php?categoryid=$categoryid\">Click here to post your message.</a>
			</td>
			</tr>";
		}
	}
	?>
	</table>
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
