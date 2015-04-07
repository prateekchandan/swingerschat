<?php
require ('includes/dbconnect.php');
$title = "My Favourites";
require ('includes/head.php');

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
    header('Location: login.php');
    exit();
}

$memberid = ($_SESSION['memberloggedin']);
if(isset($_POST['post_type'])){
	if($_POST['post_type']=="DELETE_FAVOURITE"){
		$frndid = $_POST['userid'];
		$userid = $_SESSION['memberloggedin'];
		mysql_query("DELETE FROM `friends` where
			`memberid` = '$userid' && `friendid`='$frndid'");
	}
}
?>

<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<div class='row'>
					<div class='col-md-12' style='padding:10px'>
						<div class='Searchfilters'>
							<h2 style="font-size:2em;"><u>My Favourites</u></h2>
						</div>
					</div>
				</div>
				<div class='cl'></div>
				<?php
				echo"<div class='searchfilters'>";
				$result = mysql_query("SELECT * FROM `members` WHERE `id` IN 
					(SELECT friendid from `friends` where `memberid` = '$memberid')
					");
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
					echo"<br>";
					?>
					<div class="text-center">
					<form method="POST" action="./myfavourites.php" style="float:none;">
							<input type="hidden" name="userid" value="<?php echo $userid;?>">
							<input type="hidden" name="post_type" value="DELETE_FAVOURITE">
							<button class="btn btn-danger btn-xs"  style="color:#fff">
							<span class="glyphicon glyphicon-plus" ></span>
										Remove
							</button>
					</form>
					</div>
					<?php
					echo "</div>";
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