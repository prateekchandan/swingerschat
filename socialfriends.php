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
			<table cellpadding="0" cellspacing="0" border="0" width='100%'>
			<tr>
			<td class='barheader' colspan='5'>PENDING FRIEND REQUESTS</td>
			</tr>
			
			<tr>
			<td colspan='5'><br /></td>
			</tr>
			
			<tr>
			<?php
			$memberid = ($_SESSION['memberloggedin']);
			
			$count = 0;
			$result = mysql_query("SELECT * FROM `friends` WHERE `friendid` = '$memberid' AND `status` = '0'");
			while ($r = mysql_fetch_array($result)) {
				$friendshipid = ($r['id']);
				$friendid = ($r['memberid']);
				$status = ($r['status']);
				$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$friendid'");
				$r2 = mysql_fetch_array($result2);
				$rows2 = mysql_num_rows($result2);
				$username = ($r2['username']);
				$friendpic = ($r2['photo']);
				
				if ($rows2 > 0) {
					echo"<td align=\"center\" valign=\"top\" width=\"75px\" height=\"75px\" class=\"catalog\">";
					echo"$username <br />";
					echo "<a href=\"profile.php?userid=$friendid\"><img src=\"members/$friendpic\" width=\"70px\" height=\"70px\" style='border:3px solid #FFFFFF;'/></a>";
					echo"<br /><a href='socialacceptfriend.php?friendshipid=$friendshipid'>Accept</a> <br /> <a href='socialremovefriend.php?friendshipid=$friendshipid' onclick=\"return confirm('Are you sure you want to decline this request?');\" style='color:#ff0000;'>Decline</a>";
					echo"</td>";
					
					$count += 1;
					if ($count > 5) {
						echo"</tr><tr>";
						$count = 0;
					}
				}
			}
			while ($count < 6) {
				echo"<td class='gallerycell' align=\"center\" width=\"50px\"></td>";
				$count += 1;
			}
			
			
			?>
			</tr>
			
			<tr>
			<td class='barheader' colspan='5'>FRIENDS</td>
			</tr>
			
			<tr>
			<td colspan='5'><br /></td>
			</tr>
			
			<tr>
			<?php
			$memberid = ($_SESSION['memberloggedin']);
			
			$count = 0;
			$result = mysql_query("SELECT * FROM `friends` WHERE (`memberid` = '$memberid' || `friendid` = '$memberid') AND `status` = '1'");
			while ($r = mysql_fetch_array($result)) {
				$friendshipid = ($r['id']);
				$friendid = ($r['friendid']);
				if ($friendid == $memberid) {
					$friendid = ($r['memberid']);
				}
				$status = ($r['status']);
				$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$friendid'");
				$r2 = mysql_fetch_array($result2);
				$rows2 = mysql_num_rows($result2);
				$username = ($r2['username']);
				$friendpic = ($r2['photo']);
				
				if ($rows2 > 0) {
					echo"<td align=\"center\" valign=\"top\" width=\"75px\" height=\"75px\" class=\"catalog\">";
					echo"$username <br />";
					echo "<a href=\"profile.php?userid=$friendid\"><img src=\"members/$friendpic\" width=\"70px\" height=\"70px\" style='border:3px solid #FFFFFF;'/></a>";
					echo"<br /><a href='socialremovefriend.php?friendshipid=$friendshipid' onclick=\"return confirm('Are you sure you want to remove this friend?');\" style='color:#ff0000;'>Decline</a>";
					echo"</td>";
					
					$count += 1;
					if ($count > 5) {
						echo"</tr><tr>";
						$count = 0;
					}
				}
			}
			while ($count < 6) {
				echo"<td class='gallerycell' align=\"center\" width=\"50px\"></td>";
				$count += 1;
			}
			
			
			?>
			</tr>
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
