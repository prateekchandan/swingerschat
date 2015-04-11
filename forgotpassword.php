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
					$email = ($_POST['email']);
					
					if (empty($_POST['email'])) {
						header("Location: forgotpassword.php?error=1");
						exit;
					}
					
					$result = mysql_query("SELECT * FROM `members` WHERE `email` = '$email'");
					$rows = mysql_num_rows($result);
					if ($rows > 0) {
						$r = mysql_fetch_array($result);
						$realpassword = ($r['password']);
						
						mail( "$email", "Account Info", "Here is the login info you requested. \n---------------------------------------------- \n\nE-mail: $email \nPassword: $realpassword", "From: $adminemail" ) ;
						
					$sitelogo = $baseurl . "images/logo.png";
					$RecipientEmail = $email;
					$RecipientName = $username;
					$SenderEmail = $adminemail; 
					$SenderName = $sitename;
					$cc = "";
					$bcc = "";
					$subject = "Password Retrieval";
					$message = "<div style='width:500px;'>
					
					<span style='color:#276db8; font-size:22px;'>Here is your login info.</span> <br /><br />
					
					The following is important information. Please save in a safe place.<br />
					
					Your e-mail is: $email <br />
					
					Your password is: $realpassword <br /><br />
					
					Best wishes from,<br />
					$sitename Staff!<br /><br />
					
					NOTE: This email was automatically generated from $sitename<br />
					($baseurl).<br /><br />
					<a href='$baseurl'><img src='$sitelogo'></a> <br /><br />
					</div>";
					
					$attachments = "";
					$priority = ""; //low, high or blank
					$type = ""; //leave blank for HTML or type plain for text
					
					$sent = Email($RecipientEmail, $RecipientName, $SenderEmail, $SenderName, $cc, $bcc, $subject, $message, $attachments, $priority, $type);
						
						echo"<center><h1>We have sent you an e-mail with your login info. </h1><br /><br /><a href=\"login.php\">Click here to return to the login screen.</a></center><br /><br /><br />";
					} else {
						header("Location: forgotpassword.php?error=2");
						exit;
					}
					
				} else {
				$blogid = ($_GET['blogid']);
				$error = ($_GET['error']);
				echo"<center><h1>Enter the e-mail address for your account below.</h1><br /><a href='login.php'>Back to login screen.</a><br /><br /></center>";
				echo"
					<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"550px\" style=\"border:2px solid #c0c1c3;\">
					<form enctype=\"multipart/form-data\" action=\"forgotpassword.php\" method=\"post\">";
					
					if ($error == 1) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogright'>
						You must enter your e-mail address.
						</td>
						</tr>";
					}
					if ($error == 2) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogright'>
						There are no accounts with that e-mail address.
						</td>
						</tr>";
					}
					
				echo"
					
					<tr>
					<td class='blogleft'>Enter E-mail:</td>
					<td>
					<input type=\"text\" name=\"email\" size=\"50\" maxlength=\"50\"/>
					</td>
					</tr>
				
					<tr>
					<td class='blogleft'></td>
					<td align=\"left\" valign=\"top\">
					<input type=\"submit\" name=\"submit\" value=\"Get Password\" />
					<input type=\"reset\" name=\"reset\" value=\"Reset\" />
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
