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

if (isset($_GET['pagetype'])) {
	$pagetype = ($_GET['pagetype']);
}

//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}

require ('includes/head.php');

//HOME PAGE SLIDESHOW SIGN UP BOX
if ($pagetype == "Home Page") {
	?>
	<!--slider-->
	<div class="main-content clearfix">
	       <div class="container clearfix">
		   <div class="row">
	       <div class="col-md-12">
				 <div class="slider">
			<div class="col-md-6">
			</div>
			<div class="col-md-6">
			    <div class="form">
			    <div class="form_content">
				<div class="form-head"> Create Your Profile </div>
					<form action="signup.php" name="profile" method='post'>
					<label> Username </label> <input border="0" name="username" type="text" placeholder=" ">  
					<label> Email </label> <input border="0" name="email" type="text" placeholder=" ">
					<label> Password </label> <input border="0" name="password" type="password" placeholder=" ">
					<label> Confirm Password </label> <input border="0" name="password2" type="password" placeholder=" ">
					<input value="Join Now" name='submit' type="submit" style="" class="button"/>  
				    </form>
				</div>
			    </div>
			</div>
			</div>
		</div>
		    </div>
		</div>
	      </div>
	</div>
	<!--slider-->
	<?php
}
?>


<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<?php
				if ($pagetype == "Home Page") {
					?>
						<div class="mem_text"> Meet our newest members. </div>
						<div class="clearfix"></div>
						<div class="images">
							<div class="col-md-6">
								<?php
								$result = mysql_query("SELECT * FROM `members` WHERE `admin` != '1' AND `photo` != '' ORDER BY `id` DESC LIMIT 0,3");
								while ($r = mysql_fetch_array($result)) {
									$memberid = ($r['id']);
									$memberphoto = ($r['photo']);
									echo"<a href='profile.php?userid=$memberid'><img src='members/$memberphoto' width='120px' height='120px' /></a>";	
								}
								?>
						       </div> 
						       
							<div class="col-md-6">
								<?php
								$result = mysql_query("SELECT * FROM `members` WHERE `admin` != '1' AND `photo` != '' ORDER BY `id` DESC LIMIT 3,3");
								while ($r = mysql_fetch_array($result)) {
									$memberid = ($r['id']);
									$memberphoto = ($r['photo']);
									echo"<a href='profile.php?userid=$memberid'><img src='members/$memberphoto' width='120px' height='120px' /></a>";	
								}
								?>
						       </div> 
							
						</div>
					<?php
				} else {
					echo"<div class='divmain'>";
					require('includes/content.php');
					echo"</div>";
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require('includes/footer.php'); ?>
</body>
</html>


<?php
ob_end_flush();
?>
