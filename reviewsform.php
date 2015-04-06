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
		?>
		<center>
		<form enctype='multipart/form-data' action="reviewsformsubmit.php" method='post'>
		<table align='center' cellpadding='2px' cellspacing='3px' border='0' style='margin:20px 0px 0px 3px;'>
		<?php
		$reset = 1;
		$error = ($_GET['error']);
		if (isset($_SESSION['review'])) {
			$name = ($_GET['name']);
			$review = stripslashes($_SESSION['review']);
			unset($_SESSION['review']);
			$reset = 0;
		} else {
			$review = "TYPE YOUR REVIEW HERE...";
			$name = "";
		}
		if ($error == 1) {
			echo"<tr><td align='left' style='color:#ff0000; font-size:12px;'>";
			echo"Your answer to the security question at the bottom of the form is incorrect.";
			echo"</td></tr>";
		}
		if ($error == 2) {
			echo"<tr><td align='left' style='color:#ff0000; font-size:12px;'>";
			echo"You must fill in all *required fields.";
			echo"</td></tr>";
		}
		?>
	



		<tr>
		<td align='center' colspan='2'>
		Please feel free to leave a review of our services by filling out this form below.<br /><br />
		</td>
		</tr>

		<tr>
		<td align='center'>
		<textarea name='review' <?php if ($reset == 1) {echo"onfocus='this.value=\"\", this.style.color=\"#000000\"'"; $reset = 0;} ?> style='background-color:#FFFFFF; border:3px solid #6b6a6a; color:#000000; width:400px; height:170px; vertical-align:middle;'><?php echo"$review"; ?></textarea>
		</td>
		</tr>
		
		<tr>
		<td align='center'>
		Name (<span style='font-size:10px; font-style:italic;'>Leave blank to post anonymously</span>)<br />
		<input type='text' name='name' value='<?php echo"$name"; ?>' style='width:400px; height:20px;' />
		</td>
		</tr>
		
		<tr>
		<td align='center'>
		*What is 2 + 2? <br />
		<input type='text' name='code' value='' style='width:400px; height:20px;' />
		</td>
		</tr>
		
		<tr>
		<td align='center'>
		<input type='image' src='images/sendbutton.png' border='0' name='submit' alt='Search!'>
		</td>
		</tr>
		</table>
		</form>
		</center>
		<?php
		
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
