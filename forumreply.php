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


if (isset ($_POST['submit'])) {
	$categoryid = ($_POST['categoryid']);
	$postid = ($_POST['postid']);
	$text1= mysql_real_escape_string($_POST['text1']);
	$yourid =($_SESSION['memberloggedin']);
	$tablename = "F_" . $categoryid;
	$tablename2 = "F_" . $categoryid . "_" . $postid;
	
	$date = date('m');
	$date .= "/";
	$date .= date('d');
	$date .= "/";
	$date .= date('Y');
	$date .= " ";
	$date .= date('g');
	$date .= ":";
	$date .= date('i');
	$date .= date('a');
	
	$sql="INSERT INTO `$tablename2` (memberid, comment, date) VALUES('$yourid','$text1','$date')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	mysql_query("UPDATE `$tablename` SET `lastpost`='$date' WHERE `id` = '$postid' ");

	header("Location: forum3.php?categoryid=$categoryid&postid=$postid");
	exit;
	
} else {
	$categoryid = ($_GET['categoryid']);
	$postid = ($_GET['postid']);
	$tablename = "F_" . $categoryid;
	$tablename2 = "F_" . $categoryid . "_" . $postid;
	$result = mysql_query("SELECT * FROM `F_Categories` WHERE `id` = '$categoryid'");
	$r = mysql_fetch_array($result);
	$name = ($r['name']);
	$result = mysql_query("SELECT * FROM `$tablename` WHERE `id` = '$postid'");
	$r = mysql_fetch_array($result);
	$comment = ($r['comment']);
	$posterid = ($r['memberid']);
	$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$posterid'");
	$r = mysql_fetch_array($result);
	$username = ($r['username']);
	echo"<a href='forum.php'>Forum</a> - <a href='forum2.php?categoryid=$categoryid'>$name</a> - <strong>Reply to post</strong>"; 
	?>
	
		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
	<?php
	$tablename = "F_" . $categoryid;
	if (!isset($_SESSION['memberloggedin'])) {
		echo"<tr><td align='center'><br /><br /><a href='login.php'>You must login to post a message!</a><br /><br /></td></tr>";
	} else {
		echo"<form enctype='multipart/form-data' action='forumreply.php' method='post'>
		
		<tr>
		<td>";
			echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
			echo"<tr><td align='left' colspan='6'>
				<textarea id=\"text01\" name=\"text1\" rows='10' cols='80'></textarea>";

			echo"</td></tr>";
			echo"</table>";
		echo"
		</td>
		</tr>";
		
		echo"
		<tr>
		<td align=\"left\" valign=\"top\">
		<input type='hidden' name='categoryid' value=\"$categoryid\" />
		<input type='hidden' name='postid' value=\"$postid\" />
		<input type='hidden' name='memberid' value=\"$memberid\" />
		<input type=\"submit\" name=\"submit\" value=\"Reply\" />
		</form>
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
