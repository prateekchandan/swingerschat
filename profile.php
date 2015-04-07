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
					if (isset($_SESSION['memberloggedin'])) {
						if(isset($_POST['post_type'])){
							if($_POST['post_type']=="SEND_MESSAGE"){
								$message = $_POST['message'];
								$frndid = $_POST['userid'];
								$userid = $_SESSION['memberloggedin'];
								mysql_query("INSERT INTO `messages`
									(`memberid` , `friendid` , `comment` ,`timestamp` ,`new` ,`messageid`) values
									('$userid','$frndid' ,'$message',current_timestamp,1,'')");
								$message_sent = 1;

							}
							if($_POST['post_type']=="ADD_FAVOURITE"){
								$frndid = $_POST['userid'];
								$userid = $_SESSION['memberloggedin'];
								mysql_query("INSERT INTO `friends`
									(`memberid` , `friendid`,`status`) values
									('$userid','$frndid',1)");

							}
							if($_POST['post_type']=="DELETE_FAVOURITE"){
								$frndid = $_POST['userid'];
								$userid = $_SESSION['memberloggedin'];
								mysql_query("DELETE FROM `friends` where
									`memberid` = '$userid' && `friendid`='$frndid'");

							}
						}
						$memberid = $_SESSION['memberloggedin'];
						$fav_frnd = mysql_query("SELECT * FROM `friends` where
									`memberid` = '$memberid' && `friendid`='$userid'");
						$is_fav_frnd = mysql_num_rows($fav_frnd);
						var_dump($is_fav_frnd);
						?>
						<div class='profileright'>
							<div class="col-md-12">
								<?php
									if($message_sent==1){
										?>
										<div class="alert alert-success alert-dismissible" role="alert">
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										  Message is Sent
										</div>
										<?php
									}
								?>
								<?php 
									if($is_fav_frnd==0){

								?>
								<form method="POST" action="./profile.php?userid=<?php echo $_GET['userid']?>" style="display: inline-block;">
									<input type="hidden" name="userid" value="<?php echo $_GET['userid']?>">
								    <input type="hidden" name="post_type" value="ADD_FAVOURITE">
									<button class="btn btn-primary"  style="color:#fff">
										<span class="glyphicon glyphicon-plus" ></span>
										Add to Favourites
									</button>
								</form>
								<?php
									}else{
								?>
									<form method="POST" action="./profile.php?userid=<?php echo $_GET['userid']?>" style="display: inline-block;">
									<input type="hidden" name="userid" value="<?php echo $_GET['userid']?>">
								    <input type="hidden" name="post_type" value="DELETE_FAVOURITE">
									<button class="btn btn-danger"  style="color:#fff">
										<span class="glyphicon glyphicon-plus" ></span>
										Remove From Favourites
									</button>
								</form>
								<?php } ?>
								<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#messageBox" aria-expanded="false" aria-controls="messageBox">
								 	Send Message
								</button>
								<div class="collapse" id="messageBox">
								  <div class="well">
								    <form action="./profile.php?userid=<?php echo $_GET['userid']?>" method="POST">
								    	<input type="hidden" name="userid" value="<?php echo $_GET['userid']?>">
								    	<input type="hidden" name="post_type" value="SEND_MESSAGE">
								    	<textarea class="form-control" name="message" required></textarea>
								    	<br>
								    	<button class="btn btn-success">Send</button>
								    </form>
								  </div>
								</div>
							</div>
						</div>
						<?php
					}
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
