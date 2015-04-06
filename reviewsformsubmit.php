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
	<?php require('includes/leftcolumn.php'); ?>
	</td>
	
	<td class='rightcolumn'>
		<?php
		echo"
		<table align='center' cellpadding='0px' cellspacing='0px' width='100%'>
		<tr>
		<td class='text1'>
		<div class='div1'>";
	
		$review2 = ($_POST['review']);
		$review = mysql_real_escape_string($_POST['review']);
		$code = ($_POST['code']);
		$name = mysql_real_escape_string($_POST['name']);
		if ($name == "") {
			$name = "Anonymous";
		}
		$timestamp = time();
		
		$_SESSION['review'] = "$review2";
		
		if (($code != "4") && ($code != "four") && ($code != "FOUR") && ($code != "Four")) {
			header("Location: reviewsform.php?error=1&email=$email&name=$name");
			exit;
		}
	
		$sql="INSERT INTO reviews (name, review, date) VALUES('$name','$review','$timestamp')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
			
		
		mail( "$adminemail", "New Review", "There is a new review awaiting your approval.", "From: $adminemail" ) ;
		
		unset($_SESSION['review']);
		
		echo"<center><br /><br /><br />Thank you! <br /><br />Your review will be posted to the site upon approval.</center>";

		echo"    
		</div>
		</td>
		</tr>
		</table>";
		
		?>
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
