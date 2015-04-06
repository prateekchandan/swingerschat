<?php
require ('includes/dbconnect.php');

$pagetype = "Reviews";

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
	header ('Location: login.php');
	exit();
}
$memberid = ($_SESSION['memberloggedin']);

require ('includes/head.php');
?>
	<div class="wrapper">
		<div id="sidebar">
		<?php require('includes/leftcolumn.php'); ?>
		</div><!--sidebar-->
		<div id="content">
			<!-- START TEMPLATE -->
			<div class='div1'>
			
			<center>
			<form enctype='multipart/form-data' action="storereviewsformsubmit.php" method='post'>
			<table align='center' width='550px' cellpadding='2px' cellspacing='3px' border='0' style='margin:20px 0px 0px 3px;'>
			<?php
			$reset = 1;
			$productid = ($_GET['productid']);
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
			<td align='center'>
			<?php echo"<a href='videodetails.php?videoid=$productid'>Back to Video Details</a><br />";?>
			<h1 style='width:100%; text-align: center;'>Rate Our Company</h1><br />
			</td> 
			</tr>
			
			<tr>
			<td align='center' style='padding-left:225px;'>
			<input type="hidden" name="stars" value="" id="myRating" readonly="readonly" style='width:100px;'/>
			<script type="text/javascript">
			var s1 = new Stars({
			    maxRating: 5,
			    bindField: 'myRating',
			    imagePath: 'images/',
			    value: 4.5
			});
			  </script>
			</td> 
			</tr>
	
			<tr>
			<td align='center'>
			<textarea name='review' <?php if ($reset == 1) {echo"onfocus='this.value=\"\", this.style.color=\"#000000\"'"; $reset = 0;} ?> style='background-color:#FFFFFF; border:3px solid #6b6a6a; color:#000000; width:400px; height:170px; vertical-align:middle;'><?php echo"$review"; ?></textarea>
			</td>
			</tr>
			
			<tr>
			<td align='center'>
			<?php echo"<input type='hidden' name='productid' value='$productid' />"; ?>
			<input type='submit' name='submit' value='SEND REVIEW' alt='Search!'>
			</td>
			</tr>
			</table>
			</form>
			</center>
		      
			<div class='cl'></div>
			</div>
			<!-- END TEMPLATE -->
		
		</div><!--Content-->
		<?php require('includes/footer.php'); ?>
	</div>
</div>
</body>
</html>


<?php
ob_end_flush();
?>
