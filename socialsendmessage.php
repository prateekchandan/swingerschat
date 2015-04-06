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
		<?php
		$memberid = ($_SESSION['memberloggedin']);
		if (isset ($_POST['submit'])) {
			$userid = ($_POST['userid']);
			$text1= ($_POST['text1']);
			
			$sql="INSERT INTO `messages` (memberid, friendid, comment) VALUES('$memberid','$userid','$text1')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: ' . mysql_error());
			}
			echo"<br />You have successfully sent this user a message.<br /><br />";
			echo"<a href='profile.php?userid=$userid'>Click here to go back to user's profile</a><br /><br />";
			
		} else {
			$userid = ($_GET['userid']);
			echo"<a href=\"profile.php?userid=$userid\" style='font-size:10px;'>Back to user's profile</a>";
			
			echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:5px solid #FFFFFF;\">";
		
			echo"<form enctype='multipart/form-data' action='socialsendmessage.php' method='post'>";
			echo"
			
			<tr>
			<td>";
				echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
				echo"<tr><td align='left'>";
				echo"<textarea id=\"text01\" rows='10' cols='40' name=\"text1\"></textarea>";
				echo"</td></tr>";
				echo"</table>";
			echo"
			</td>
			</tr>";
			
			echo"
			<tr>
			<td align=\"left\" valign=\"top\">
			<input type='hidden' name='userid' value=\"$userid\" />
			<input type=\"hidden\" name=\"submit\" value=\"submit\" />
			<input type='submit' name='submit' value='SEND' />
			<br /><br />
			</form>
			</td>
			</tr>
			</table>";
		}
		
		?>

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
