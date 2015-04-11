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
$pagetype = "Other";
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

$membersonly = 1;
//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		$_SESSION['returnurl'] = $_SERVER['PHP_SELF'];
		header ('Location: login.php?error=3');
		exit();
	}
}

require ('includes/head.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='leftcolumn'>
		<table align="center" cellpadding="0px" cellspacing="0px" class="lefttable">
		<tr>
		<td class='text1'>
		<div class='div1'>
		<a href='socialmessages.php'>Back to messages.</a><br />
			<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
			<?php
			$userid = ($_GET['userid']);
			$memberid = ($_SESSION['memberloggedin']);
			$result = mysql_query("SELECT * FROM `messages` WHERE (`memberid` = '$memberid' AND `friendid`='$userid') || (`memberid`='$userid' AND `friendid`='$memberid') ORDER BY `id` ASC");
			while ($r = mysql_fetch_array($result)) {
			    $commentid = ($r['id']);
			    $posterid = ($r['memberid']);
			    $comment = stripslashes($r['comment']);
			    $comment = str_replace("\n", "<br />", $comment);
			    if ($posterid != $memberid) {
				mysql_query("UPDATE `messages` SET `new`='1' WHERE `id` = '$commentid' ");
			    }
			    
			    $result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$posterid'");
			    $r2 = mysql_fetch_array($result2);
			    $rows2 = mysql_num_rows($result2);
			    $photo = ($r2['photo']);
			    $username = ($r2['username']);
				echo "<tr><td class='socialcommentcell'>";
				if ($rows2 > 0) {
					echo"$username<br /><a href=\"socialprofile.php?memberid=$userid\"><img src='members/$photo' width='100px' height='100px'></a>";
				} else {
					echo"PROFILE <br /> DELETED ";
				}
				echo"</td><td class='socialcommentcell2'><br />$comment <br /><br /><a href='socialmessages2.php?userid=$userid'>View Conversation</a></td>";
				echo"<td class='socialcommentcell3'><a href=\"socialsendmessage.php?userid=$userid\">REPLY TO MESSAGE</a><br /><a href=\"socialremovemessage.php?commentid=$commentid\" onclick=\"return confirm('Are you sure you want to delete this message?');\" style='color:#ff0000;'>DELETE MESSAGE</a></div>";
				echo"</td></tr>";
			}
			?>
			</table>
		</div>
		</td>
		</tr>
		</table>
	</td>
	
	<td class='rightcolumn'>
	<div class="righttable"'>
	<?php require('includes/rightcolumn.php'); ?>
	</div>
	</td>
	</tr>
	</table>
</td>
</tr>

<?php
require ('includes/footer.php');
?>

</body>
</html>

<?php
ob_end_flush();
?>
