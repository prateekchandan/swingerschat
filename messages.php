<?php
require ('includes/dbconnect.php');
$title = "My Messages";
require ('includes/head.php');

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
    header('Location: login.php');
    exit();
}

$memberid = ($_SESSION['memberloggedin']);
if(isset($_POST['post_type'])){
	if($_POST['post_type']=="DELETE_FAVOURITE"){
		
	}
}
if(!isset($_GET['userid'])){
?>

<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<div class='row'>
					<div class='col-md-12' style='padding:10px'>
						<div class='Searchfilters'>
							<h2 style="font-size:2em;"><u>All Messages</u></h2>
						</div>
					</div>
				</div>
				<div class='cl'></div>
				<?php
				echo"<div class='searchfilters'>";
				$result = mysql_query("SELECT * FROM `members` WHERE `id` IN 
					(SELECT friendid from `messages` where `memberid` = '$memberid')
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
					<div class="text-center" style="margin-bottom:5px">
							<a class="btn btn-success btn-xs" href="./messages.php?userid=<?php echo $userid;?>" style="color:#fff">
										See Messages
							</a>
					</div>
					<div class="text-center" style="margin-bottom:5px">
					<form method="POST" action="./myfavourites.php" style="float:none;">
							<input type="hidden" name="userid" value="<?php echo $userid;?>">
							<input type="hidden" name="post_type" value="DELETE_FAVOURITE">
							<button class="btn btn-danger btn-xs"  style="color:#fff">
							<span class="glyphicon glyphicon-plus" ></span>
										Delete All Messages
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

<?php
}
else{
	$userid = ($_GET['userid']);
	if(isset($_POST['post_type'])){
		if($_POST['post_type']=="DELETE_MESSAGE"){
			$msgid = $_POST['msgid'];
			mysql_query("DELETE FROM `messages` where
				`id` = '$msgid'");
		}
		if($_POST['post_type']=="SEND_MESSAGE"){
			$message = $_POST['message'];
			$frndid = $_POST['userid'];
			$userid = $_SESSION['memberloggedin'];
			mysql_query("INSERT INTO `messages`
				(`memberid` , `friendid` , `comment` ,`timestamp` ,`new` ,`messageid`) values
				('$userid','$frndid' ,'$message',current_timestamp,1,'')");
			$message_sent = 1;

		}
		$userid = ($_GET['userid']);
		header("Location:./messages.php?userid=$userid");
	}
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
	$messages = mysql_query("SELECT * FROM `messages` WHERE 
		(`memberid` = '$memberid' && `friendid` = '$userid') ||
		(`memberid` = '$userid' && `friendid` = '$memberid')
		order by `timestamp` desc
		");

	?>
<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<div class='row'>
					<div class='col-md-12' style='padding:10px'>
						<div class='Searchfilters'>
							<h2 style="font-size:2em;"><u>All Messages from <?php echo $username; ?></u></h2>
						</div>
					</div>
				</div>
				<div class='cl'></div>
				<div class='row'><div class='col-md-12 well' style='color:#666'>
					<form action="./messages.php?userid=<?php echo $_GET['userid']?>" method="POST">
						<input type="hidden" name="userid" value="<?php echo $_GET['userid']?>">
						<input type="hidden" name="post_type" value="SEND_MESSAGE">
						<textarea class="form-control" name="message" required></textarea>
						<br>
						<button class="btn btn-success">Send</button>
					</form>
				</div></div>
				<?php
				while ($r = mysql_fetch_array($messages)) {
					$comment = $r['comment'];
					if($r['memberid'] == $memberid)
						$name = "Me";
					else
						$name = $username;
					$time = date('h:i a F d, Y', strtotime($r['timestamp']));;
					echo "<div class='row'><div class='col-md-12 well' style='color:#666'>";
					echo "<b>".$name."</b> : ";
					echo $comment;
					echo "<br>Sent at : ".$time;
					echo "<br>";
					?>
					<form method="POST" action="./messages.php?userid=<?php echo $userid;?>" style="float:none;">
							<input type="hidden" name="msgid" value="<?php echo $r['id'];?>">
							<input type="hidden" name="post_type" value="DELETE_MESSAGE">
							<button class="btn btn-danger btn-xs"  style="color:#fff">
							<span class="glyphicon glyphicon-plus" ></span>
										Delete
							</button>
					</form>
					<?php
					echo "</div></div>";

				}?>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
}
?>
<?php
require ('includes/footer.php');
?>



</body>
</html>

<?php
ob_end_flush();
?>
