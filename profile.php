<?php
require ('includes/dbconnect.php');
$title = "Profile";
require ('includes/head.php');
?>


<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<!--    START TEMPLATE    -->
				<?php
				$userid = ($_GET['userid']);
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$userid'");
				$r = mysql_fetch_array($result);
				$first = ($r['first']);
				$last = ($r['last']);
				$username = ($r['username']);
				$email = ($r['email']);
				$phone = ($r['phone']);
				$password = ($r['password']);
				$billingcountry = ($r['country']);
				$billingaddress = ($r['address']);
				$billingaddress2 = ($r['address2']);
				$billingcity = ($r['city']);
				$billingstate = ($r['state']);
				$billingzip = ($r['zip']);
				$shippingcountry = ($r['shippingcountry']);
				$shippingaddress = ($r['shippingaddress']);
				$shippingaddress2 = ($r['shippingaddress2']);
				$shippingcity = ($r['shippingcity']);
				$shippingstate = ($r['shippingstate']);
				$shippingzip = ($r['shippingzip']);
				$type = ($r['type']);
				$age = ($r['age']);
				$photo = ($r['photo']);
				$age = ($r['age']);
				$sex = ($r['sex']);
				$bio = stripslashes($r['bio']);
				$bio = str_replace("\n", "<br />", $bio);
				echo"<div class='profileleft'>";
				echo"<img src='members/$photo' class='profilepicture' />";
				echo"</div>";
				
				echo"<div class='profileright'>";
				echo"<h1>$username</h1>";
				
				$result = mysql_query("SELECT * FROM `user_type` WHERE `id` = '$type'");
				$r = mysql_fetch_array($result);
				$typename = ($r['name']);
				echo"<p><strong>I am a</strong> $typename</p>";
				
				echo"<p><strong>Age:</strong> $age</p>";
				
				echo"<p><strong>Sex:</strong> $sex</p>";
		    
				echo"<p><strong>Country:</strong> $billingcountry</p>";
		    
				echo"<p><strong>State:</strong> $billingstate</p>";
				
				echo"<p><strong>City:</strong> $billingcity</p>";
					
				echo"</div>";
				
				echo"<div class='profileright2'>";
				echo"<h1>My Bio</h1>";
				
				echo"<p>$bio</p>";
					
				echo"</div>";
				?>
				<div class='cl'></div>
				<!--    END TEMPLATE   -->
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
