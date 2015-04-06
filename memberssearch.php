<?php
require ('includes/dbconnect.php');
$title = "Search Members";
require ('includes/head.php');
?>


<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<!--    START TEMPLATE    -->
				<?php
				$searchstring = "";
				if (isset($_SESSION['memberloggedin'])) {
					$memberid = ($_SESSION['memberloggedin']);
					$searchstring .= "AND `id` != '$memberid'";
				}
				if ($_POST['filtersex']) {
					$filtersex = ($_POST['filtersex']);
					$searchstring .= "AND `sex` = '$filtersex' ";
				}
				echo"<div class='searchfilters'>";
				echo"<form action='memberssearch.php' method='post'>";
				echo"<p>Sex: </p>";
				echo"<select name='filtersex'>";
				echo"<option value='Male' "; if ($filtersex = "Male") { echo"selected"; } echo">Male</option>";
				echo"<option value='Female' "; if ($filtersex = "Female") { echo"selected"; } echo">Female</option>";
				echo"</select>";
				echo"<input type='submit' name='submit' value='SET FILTER' />";
				echo"</form>";
				echo"</div>";
				
				echo"<div class='cl'></div>";
				
				echo"<div class='searchfilters'>";
				$result = mysql_query("SELECT * FROM `members` WHERE `setup`='1' AND `approved`='1' $searchstring");
				while ($r = mysql_fetch_array($result)) {
					$userid = ($r['id']);
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
					echo"<div class='memberpicbox'>";
					echo"<a href='profile.php?userid=$userid'><img src='members/$photo' /></a>";
					echo"</div>";
				}
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
