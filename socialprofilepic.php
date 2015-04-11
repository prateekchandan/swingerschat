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
if (!isset($_SESSION['memberloggedin'])) {
	$file = $_SERVER['PHP_SELF'];
	$file = explode('/', $file);
	$file = $file[count($file) - 1];
	$_SESSION['returnurl'] = $file;
	header ('Location: login.php?error=3');
	exit();
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
			// Start Profile Picture
			$memberid =($_SESSION['memberloggedin']);
			$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
			$r = mysql_fetch_array($result);
			$photo = ($r['photo']);
			$gender = ($r['gender']);
			$foldername = 'member_' . $memberid;
				
				
			echo"<table width=\"100%\" align=\"center\" cellpadding=\"0px\" cellspacing=\"0px\" style=\"border:0px solid #202120;\">";
			echo"<tr><td align='center'>";
			echo"<h1>UPDATE YOUR PROFILE PICTURE</h1> <br /><br />";
			
			echo"<img src='members/$photo' width='115px' height='107px' />"; 
	
			echo"<br /><br /></td></tr>";
			
			echo"<tr><td align='center' style=\"border-top:0px solid #202120;\">";
				echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
				echo"<tr><td align='center'>";
				echo"<form enctype='multipart/form-data' action=\"socialaddprofilepic.php\" method='post'>
					<input name='pic' type='file' />
					<input type='hidden' name='photo' value='$photo' />
					<input type='submit' name='submit' value='Update' />
					</form>";
				echo"</td></tr>";
				echo"<tr><td align='center'>";
				if ($message == 1) { echo"You can only upload image files!"; }
				echo"</td></tr>";
				echo"</table>";
			echo"</td></tr>";
			echo"<tr><td align='center'>";
			if ($error == 5) { echo"You can only upload image files!"; }
			echo"</td></tr>";
			echo"</table>";
			?>   
		
		</div>
		</td>
		</tr>
		</table>
	
	</td>
	<td class='rightcolumn'>
	<?php require('includes/rightcolumn2.php'); ?>
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
