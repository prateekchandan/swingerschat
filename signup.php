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
					$type = mysql_real_escape_string($_POST['type']);
					$email = mysql_real_escape_string($_POST['email']);
					$username = mysql_real_escape_string($_POST['username']);
					$password = mysql_real_escape_string($_POST['password']);
					$password2 = mysql_real_escape_string($_POST['password2']);
					$age = mysql_real_escape_string($_POST['age']);
					
					$returnvalues = "&type=$type&email=$email&age=$age";
					
					if (empty($_POST['email'])) {
						header("Location: signup.php?error=1 $returnvalues");
						exit;
					}
				
					if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
						header("Location: signup.php?error=5 $returnvalues");
						exit;
					}
					
					if (empty($_POST['password'])) {
						header("Location: signup.php?error=1 $returnvalues");
						exit;
					}
					if (empty($_POST['password2'])) {
						header("Location: signup.php?error=1 $returnvalues");
						exit;
					}
					if (($_POST['password']) != ($_POST['password2'])) {
						header("Location: signup.php?error=2 $returnvalues");
						exit;
					}
					$result = mysql_query('SELECT * FROM members WHERE email = "'.$email.'"');
					$rows = mysql_num_rows($result);
					if ($rows > 0) {
						header("Location: signup.php?error=3 $returnvalues");
						exit;
					}
				
				
					$sql="INSERT INTO members (email, username, type, age, password, approved) VALUES('$email','$username','$type','$age','$password','1')";
					if (!mysql_query($sql,$dbc)) {
						die('Error: ' . mysql_error());
					}
					$result = mysql_query("SELECT * FROM `members` WHERE `email` = '$email' ");
					$r = mysql_fetch_array($result);
					$memberid = ($r['id']);
					$_SESSION['memberloggedin'] = "$memberid";
					
					//SEND EMAIL
					$sitelogo = $baseurl . "images/logo.png";
					$RecipientEmail = $email;
					$RecipientName = $username;
					$SenderEmail = $adminemail; 
					$SenderName = $sitename;
					$cc = "";
					$bcc = "";
					$subject = "You are now a member of $sitename";
					$message = "<div style='width:500px;'>
					
					<span style='color:#276db8; font-size:22px;'>Congratulations! Your Membership is now active.</span> <br /><br />
					
					The following is important information. Please save in a safe place.<br />
					
					Your e-mail is: $email <br />
					
					Your password is: $password <br /><br />
					
					
					
					We are excited to have you as our new member!<br /><br />
					
					Best wishes from,<br />
					$sitename Staff!<br /><br />
					
					NOTE: This email was automatically generated from $sitename<br />
					($baseurl).<br /><br />
					</div>";
					
					$attachments = "";
					$priority = ""; //low, high or blank
					$type = ""; //leave blank for HTML or type plain for text
					
					$sent = Email($RecipientEmail, $RecipientName, $SenderEmail, $SenderName, $cc, $bcc, $subject, $message, $attachments, $priority, $type);
					
				
					echo"<center>";
					echo"<p>You have successfully signed up and logged in.</p>";
					echo"<p><a href='members.php'>GO TO YOUR ACCOUNT</a></p>";
					echo"</center>";
				
				} else {
					
				if (isset($_GET['error'])) {
					$error = ($_GET['error']);
					$type = ($_GET['type']);
					$age = ($_GET['age']);
					$email = ($_GET['email']);
				} else {
					$type = "";
					$age = "";
					$email = "";
				}
				
				echo"
				<center>
				<h1>Create your account and start chatting!</h1><br /><br />
				</center>
					<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"500px\" style=\"border:2px solid #e1e1e1; margin:0 auto;\">
					<form enctype=\"multipart/form-data\" action=\"signup.php\" method=\"post\">";
					
					if ($error == 1) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogrighte'>
						Please fill in all *required fields.
						</td>
						</tr>";
					}
					if ($error == 2) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogrighte'>
						Your passwords did not match.
						</td>
						</tr>";
					}
					if ($error == 3) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogrighte'>
						That e-mail is already being used.
						</td>
						</tr>";
					}
					if ($error == 4) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogrighte'>
						That username is already being used.
						</td>
						</tr>";
					}
					if ($error == 5) {
						echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td class='blogrighte'>
						Your email is not in the correct format.
						</td>
						</tr>";
					}
					
				echo"	
					<tr>
					<td class='blogleft'>*Username:</td>
					<td>
					<input type=\"text\" name=\"username\" size=\"50\" maxlength=\"50\" value='$username' />
					</td>
					</tr>
					
					<tr>
					<td class='blogleft'>*E-mail:</td>
					<td>
					<input type=\"text\" name=\"email\" size=\"50\" maxlength=\"50\" value='$email' />
					</td>
					</tr>
					
					<tr>
					<td class='blogleft'>*Password:</td>
					<td>
					<input type=\"password\" name=\"password\" size=\"50\" maxlength=\"50\"/>
					</td>
					</tr>
					
					<tr>
					<td class='blogleft'>*Confirm Password:</td>
					<td>
					<input type=\"password\" name=\"password2\" size=\"50\" maxlength=\"50\"/>
					</td>
					</tr>
				
					<tr>
					<td class='blogleft'></td>
					<td align=\"left\" valign=\"top\">
					<input type=\"submit\" name=\"submit\" value=\"Sign Up\" />
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
