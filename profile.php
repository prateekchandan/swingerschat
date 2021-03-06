<?php
require ('includes/dbconnect.php');
$title = "Profile";
require ('includes/head.php');
?>

<style type="text/css">
	.diy-slideshow{
	  position: relative;
	  display: block;
	  overflow: hidden;
	}
	figure{
	  position: absolute;
	  opacity: 0;
	  text-align: center;
	  transition: 1s opacity;
	}
	figure img{
		max-height: 400px;
	}
	figcaption{
	  position: absolute;
	  font-family: sans-serif;
	  font-size: .8em;
	  bottom: .75em;
	  right: .35em;
	  padding: .25em;
	  color: #fff;
	  background: rgba(0,0,0, .25);
	  border-radius: 2px;
	}
	figcaption a{
	  color: #fff;
	}
	figure.show{
	  opacity: 1;
	  position: static;
	  transition: 1s opacity;
	}
	.next, .prev{
	  color: #fff;
	  position: absolute;
	  background: rgba(0,0,0, .6);
	  top: 50%;
	  z-index: 1;
	  font-size: 2em;
	  margin-top: -.75em;
	  opacity: .3;
	  user-select: none;
	}
	.next:hover, .prev:hover{
	  cursor: pointer;
	  opacity: 1;
	}
	.next{
	  right: 0;
	  padding: 10px 5px 15px 10px;
	  border-top-left-radius: 3px;
	  border-bottom-left-radius: 3px;
	}
	.prev{
	  left: 0;
	  padding: 10px 10px 15px 5px;
	  border-top-right-radius: 3px;
	  border-bottom-right-radius: 3px;
	}
	p{
	  margin: 10px 20px;
	  color: #fff;
	}
</style>


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
					if (isset($_SESSION['memberloggedin']) && $_GET['userid']!=$_SESSION['memberloggedin']) {
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
							if($_POST['post_type']=="ADD_Favorite"){
								$frndid = $_POST['userid'];
								$userid = $_SESSION['memberloggedin'];
								mysql_query("INSERT INTO `friends`
									(`memberid` , `friendid`,`status`) values
									('$userid','$frndid',1)");

							}
							if($_POST['post_type']=="DELETE_Favorite"){
								$frndid = $_POST['userid'];
								$userid = $_SESSION['memberloggedin'];
								mysql_query("DELETE FROM `friends` where
									`memberid` = '$userid' && `friendid`='$frndid'");

							}
							header("Location:./profile.php?userid=$frndid");
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
								    <input type="hidden" name="post_type" value="ADD_Favorite">
									<button class="btn btn-primary"  style="color:#fff">
										<span class="glyphicon glyphicon-plus" ></span>
										Add to Favorites
									</button>
								</form>
								<?php
									}else{
								?>
									<form method="POST" action="./profile.php?userid=<?php echo $_GET['userid']?>" style="display: inline-block;">
									<input type="hidden" name="userid" value="<?php echo $_GET['userid']?>">
								    <input type="hidden" name="post_type" value="DELETE_Favorite">
									<button class="btn btn-danger"  style="color:#fff">
										<span class="glyphicon glyphicon-plus" ></span>
										Remove From Favorites
									</button>
								</form>
								<?php } ?>
								<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#messageBox" aria-expanded="false" aria-controls="messageBox">
								 	Send Message
								</button>
								<div class="collapse" id="messageBox">
								  <div class="well">
								    <form action="./profile.php?userid=<?php echo $_GET['userid']?>"  id="SEND_MESSAGE" onsubmit="return sendMessage();" method="POST">
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
					echo"<h1>My Gallery</h1><hr>";
					$home_dir = "./images/users/".$userid."/";
					$files = glob($home_dir.'*.*');
					?>
					<div class="diy-slideshow">
					<?php foreach($files as $key=> $file) { ?>
					<figure <?php if($key==0) echo 'class="show"'; ?>>
				        <img src="<?php echo $file;?>" />
				    </figure>
				    <?php } ?>
					  <span class="prev">&laquo;</span>
					  <span class="next">&raquo;</span>
					</div>
					
					<?php
						
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
<script type="text/javascript">
	(function(){
  
		var counter = 0, // to keep track of current slide
		    $items = document.querySelectorAll('.diy-slideshow figure'), // a collection of all of the slides, caching for performance
		    numItems = $items.length; // total number of slides

		// this function is what cycles the slides, showing the next or previous slide and hiding all the others
		var showCurrent = function(){
		  var itemToShow = Math.abs(counter%numItems);// uses remainder (aka modulo) operator to get the actual index of the element to show  
		  
		  // remove .show from whichever element currently has it 
		  // http://stackoverflow.com/a/16053538/2006057
		  [].forEach.call( $items, function(el){
		    el.classList.remove('show');
		  });
		  
		  // add .show to the one item that's supposed to have it
		  $items[itemToShow].classList.add('show');    
		};

		// add click events to prev & next buttons 
		document.querySelector('.next').addEventListener('click', function() {
		     counter++;
		     showCurrent();
		  }, false);

		document.querySelector('.prev').addEventListener('click', function() {
		     counter--;
		     showCurrent();
		  }, false);
		  
		})();  
</script>
<?php require('includes/footer.php'); ?>
<script type="text/javascript">
function sendMessage(){
	var data=jQuery('#SEND_MESSAGE').serializeArray();
	id = parseInt(data[0].value);
	jQuery('#SEND_MESSAGE')[0].reset();
	jQuery.ajax({
		url:'profile.php',
		data : data,
		type : "POST",
		success:function(){
			if(openedArr.indexOf(id)==-1){
				jQuery('#msg-cut-'+id).click();
			}	
			if(minArr.indexOf(id)!=-1){
				jQuery('#msg-hide-'+id).click();
			}
		}
	})
	return false;

}
</script>
</body>
</html>


<?php
ob_end_flush();
?>
