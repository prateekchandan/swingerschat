<?php
require ('includes/dbconnect.php');
$title = "Start Chatting!";
require ('includes/head.php');
?>


<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<!--    START TEMPLATE    -->
				<?php
				echo"<div class='divmain'>";
			
				if (isset ($_POST['submit'])) {
					$error = ($_POST['error']);
					/*
					if (empty($_POST['email'])) {
						header("Location: login.php?error=1");
						exit;
					}
					if (empty($_POST['password'])) {
						header("Location: login.php?error=1");
						exit;
					}
					*/
					//Check if same IP has tried to login more than 5 times in last 5 minutes
					$allowed = 1;
					$ip=getenv("REMOTE_ADDR");
					$currenttime = time();
					$result = mysql_query("SELECT * FROM `masslogin` WHERE `ip`='$ip'");
					$rows = mysql_num_rows($result);
					if ($rows > 0) {
						$r = mysql_fetch_array($result);
						$timestamp = ($r['timestamp']);
						$amount = ($r['amount']);
						$elapsedtime = ($currenttime - $timestamp);
						if ($amount > 4) {
							if ($elapsedtime < 300) {
								$allowed = 0;
							} else {
								$query = "DELETE FROM `masslogin` WHERE `ip`='$ip'";
								$results = mysql_query($query);
							}
						}
					}
					
					if ($allowed == 1) {
						$true = 0;
						$userpass = mysql_real_escape_string($_POST['password']);
						$username = mysql_real_escape_string($_POST['email']);
						$result = mysql_query("SELECT * FROM `members` WHERE `email`='$username'");
						$r = mysql_fetch_array($result);
						$realpass = ($r['password']);
						$realid = ($r['id']);
						$result = mysql_query("SELECT * FROM `members` WHERE `password`='$userpass' AND `id` = '$realid'");
						$r = mysql_fetch_array($result);
						$realuser = ($r['email']);
						$result = mysql_query("SELECT * FROM `members` WHERE `email`='$realuser' AND `password`='$realpass' AND `id` = '$realid'");
						$true = mysql_num_rows($result);
						if ($true > 0) {
							$r = mysql_fetch_array($result);
							$memberid = ($r['id']);
							$_SESSION['memberloggedin'] = "$memberid";
							
							//Empty guest cart to member cart
							$result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
							while ($r = mysql_fetch_array($result)) {
								$id = ($r['id']);
								$quantity = ($r['quantity']);
								$productid = ($r['productid']);
								$option1 = ($r['option1']);
								$option2 = ($r['option2']);
								$option3 = ($r['option3']);
								$option4 = ($r['option4']);
								
								mysql_query("UPDATE `cart` SET `memberid`= '$memberid', `ip`='' WHERE `id` = '$id' ");
							
							}
							
							if ($error == 3) {
								$returnurl = ($_SESSION['returnurl']);
								header("Location: $returnurl");
								exit;
							} else {
								header("Location: members.php");
								exit;
							}
					
							
						} else {
							if ($rows > 0) {
								$amount += 1;
								mysql_query("UPDATE `masslogin` SET `amount`='$amount' WHERE `ip` = '$ip' ");	
							} else {
								$sql="INSERT INTO masslogin (ip, timestamp, amount) VALUES('$ip','$currenttime','1')";
								if (!mysql_query($sql)) {
									die('Error: ' . mysql_error());
								}	
							}
							header("Location: login.php?error=2");
							exit;
						}
					} else {
						echo"<p align='center' width='500px'>Login has been locked down for 5 minutes.<br /><br /><a href='forgotpassword.php'>Have you forgot your password?</a>.";
					}
					
				
				} else {
				$error = ($_GET['error']);
				echo"<center><h1>Login using your email and password below.</h1></center><br /><br />";
				echo"
					<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"550px\" style=\"outline:2px solid #ced1d4; margin:0 auto;\">
					<form enctype=\"multipart/form-data\" action=\"login.php\" method=\"post\">";
					
					if ($error == 1) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogright'>
						You must fill out both fields.
						</td>
						</tr>";
					}
					if ($error == 2) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogright'>
						Your login information was incorrect.
						</td>
						</tr>";
					}
					if ($error == 3) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogright'>
						You must login to access features of the members section. If you don't have an account, you can create one by <a href='signup.php'>clicking here</a>.
						</td>
						</tr>";
					}
				echo"	
					<tr>
					<td class='blogleft'>E-mail:</td>
					<td>
					<input type=\"text\" name=\"email\" size=\"50\" maxlength=\"50\"/>
					</td>
					</tr>
					
					<tr>
					<td class='blogleft'>Password:</td>
					<td>
					<input type=\"password\" name=\"password\" size=\"50\" maxlength=\"50\"/>
					</td>
					</tr>
				
					<tr>
					<td class='blogleft'></td>
					<td align=\"left\" valign=\"top\">
					<input type='hidden' name='error' value='$error' />
					<input type=\"submit\" name=\"submit\" value=\"Login\" />
					<input type=\"reset\" name=\"reset\" value=\"Reset\" />
					<a href=\"forgotpassword.php\">Forgot password?</a>
					<br /><br />
					</form>
					</td>
					</tr>
					</table>";
				}
		
		
		
				
				echo"</div>";
				?>
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
