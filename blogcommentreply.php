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
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='leftcolumn'>
		<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
		<tr>
		<td class='text1'>
		<div class='div1'>		
		<?php 
		if (!isset($_SESSION['memberloggedin'])) {
			header('Location: login.php');
			exit();
		}
		$memberid =($_SESSION['memberloggedin']);
		
		$commentid = ($_POST['commentid']);
		$articleid = ($_POST['articleid']);
		
		if (empty($_POST['text1'])) {
			header("Location: blog2.php?articleid=$articleid&error=1#commentbox");
			exit();
		}
		
		$text1 = mysql_real_escape_string($_POST['text1']);
		$date = time();
		
		
		$sql="INSERT INTO blogcomments (blogid, memberid, article, date, reply) VALUES('$articleid','$memberid','$text1','$date','$commentid')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ');
		}
		
		header("Location: blog2.php?articleid=$articleid#$commentid");
		exit();
		
		?>
		</div>
		</td>
		</tr>
		</table>
	</td>
	<td class='rightcolumn'>
	<?php require('includes/rightcolumn.php'); ?>	
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
