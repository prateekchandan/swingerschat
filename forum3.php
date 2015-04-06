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
$postid = ($_GET['postid']);
$tablename = "F_" . $categoryid;
$tablename2 = "F_" . $categoryid . "_" . $postid;
$result = mysql_query("SELECT * FROM `F_Categories` WHERE `id` = '$categoryid'");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$adminonly = ($r['adminonly']);
$result = mysql_query("SELECT * FROM `$tablename` WHERE `id` = '$postid'");
$r = mysql_fetch_array($result);
$comment = stripslashes($r['comment']);
$comment = str_replace("\n", "<br />", $comment);
$posterid = ($r['memberid']);
$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$posterid'");
$r = mysql_fetch_array($result);
$first = ($r['first']);
$last = ($r['last']);
echo"<a href='forum.php'>Choose a category</a> - <a href='forum2.php?categoryid=$categoryid'>$name</a><br /><br /><strong>Original Post By:</strong> $first $last<br /><br />
$comment <br /><br />
<br />"; 
?>

	<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
<?php
	echo"
	<tr>
	<td></td>
	<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;' width='200px'>
	REPLY BY
	</td>
	<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;' width='550px'>
	REPLIES
	</td>
	<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
	DATE
	</td>
	</tr>";
	
$result = mysql_query("SELECT * FROM `$tablename2` ORDER BY `date` DESC");
$rows = mysql_num_rows($result);
if ($rows > 0) {
	while ($r = mysql_fetch_array($result)) {	
		$messageid = ($r['id']);
		$memberid = ($r['memberid']);
		$comment = stripslashes($r['comment']);
		$comment = str_replace("\n", "<br />", $comment);
		$date = ($r['date']);
		$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
		$r2 = mysql_fetch_array($result2);
		$rows2 = mysql_num_rows($result2);
		$first = ($r2['first']);
		$last = ($r2['last']);
		echo"
		<tr>
		<td>";
		if ($forumadmin == 1) {
			echo"<a href='forumdeletemessage.php?tablename=$tablename2&messageid=$messageid&categoryid=$categoryid&postid=$postid'><img src='images/deletepost.jpg' /></a>";
		}
		echo"
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>";
		if ($rows2 < 1) {
			echo"Member Deleted";
		} else {
			echo"$first $last";
		}
		
		echo"</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7; background-color:#FFFFFF;'>
		<div style='margin:20px 20px 20px 0px;'>$comment <br /><br /></div>
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:15px solid #F7F7F7;'>
		$date
		</td>
		</tr>";
	}
	
	if ($adminonly != 1) {
		echo"
		<tr>
		<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;' colspan='5'>
		<a href=\"forumreply.php?categoryid=$categoryid&postid=$postid\">Click here to reply to this post.</a>
		</td>
		</tr>";
	} else if ($forumadmin == 1) {
		echo"
		<tr>
		<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;' colspan='5'>
		<a href=\"forumreply.php?categoryid=$categoryid&postid=$postid\">Click here to reply to this post.</a>
		</td>
		</tr>";
	}
	
} else {
	if ($adminonly != 1) {
		echo"
		<tr>
		<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;' colspan='5'>
		<br /><br />Be the first to reply to this post!<br /><br />
		<a href=\"forumreply.php?categoryid=$categoryid&postid=$postid\">Click here to reply to this post.</a>
		</td>
		</tr>";
	} else if ($forumadmin == 1) {
		echo"
		<tr>
		<td align=\"center\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;' colspan='5'>
		<br /><br />Be the first to reply to this post!<br /><br />
		<a href=\"forumreply.php?categoryid=$categoryid&postid=$postid\">Click here to reply to this post.</a>
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
