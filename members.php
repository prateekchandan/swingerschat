<?php
require ('includes/dbconnect.php');
$title = "Member Pages";
require ('includes/head.php');

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
    header('Location: login.php');
    exit();
}
$memberid = ($_SESSION['memberloggedin']);

//FIND OUT IF APPROVED & ACCOUNT COMPLETED IN SETUP PGASE
$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid' ");
$r = mysql_fetch_array($result);
$membersetup = ($r['setup']);
$memberapproved = ($r['approved']);

//GET MEMBER BIO INFO
$first = ($r['first']);
$last = ($r['last']);
$username = ($r['username']);
$originalusername = $username;
$email = ($r['email']);
$originalemail = $email;
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
$sex = ($r['sex']);
$bio1 = stripslashes($r['bio']);
$bio = str_replace("\n", "<br />", $bio1);
?>


<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<!--    START TEMPLATE    -->
				<?php
				echo"<div class='notifications'>";
				echo"<h1>NOTIFICATIONS</h1>";
				if ($membersetup == 0) {
					echo"<p><img src='images/notification.png' />Finish <a href='members.php?location=2'>creating</a> your profile to unlock all your other features.</p>";
				}
				if ($memberapproved == 0) {
					echo"<p><img src='images/notification.png' />Your account has not been approved yet.</p>";
				}
				echo"</div>";
				

				echo"<div class='membersmain'>";

					echo"<div class='membersdiv'>
					<p class='membersnav'>
					    <a href='members.php'>Account</a>&nbsp;&nbsp;&nbsp;
					    <a href='members.php?location=2'>Edit Account</a>&nbsp;&nbsp;&nbsp;
					    <a href='members.php?location=3'>Profile Picture</a>&nbsp;&nbsp;&nbsp;
					    <a href='myfavorites.php'>favorites</a>&nbsp;&nbsp;&nbsp;
					    <a href='messages.php'>Messages</a>&nbsp;&nbsp;&nbsp;
					    <a href='logout.php'>Logout</a>&nbsp;&nbsp;&nbsp;
					</p>";
					
					$error = ($_GET['error']);
					if (isset($_GET['location'])) {
					    $location = ($_GET['location']);
					} else {
					    $location = 1;
					}
					switch ($location) {
						case"1":
				
						echo"
						<table align=\"left\" class='cartbox'>
				    
						<tr>
						<td class='blogleft'>First Name:</td>
						<td class='blogright'>
						$first
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>Last Name:</td>
						<td class='blogright'>
						$last
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>You are a:</td>
						<td>";
						$result = mysql_query("SELECT * FROM `user_type` WHERE `id` = '$type'");
						$r = mysql_fetch_array($result);
						$typename = ($r['name']);
						echo"$typename
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>Age:</td>
						<td>
						$age
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>Sex:</td>
						<td>
						$sex
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>Username:</td>
						<td class='blogright'>
						$username
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>E-mail:</td>
						<td class='blogright'>
						$email
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>Phone:</td>
						<td class='blogright'>
						$phone
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>Country:</td>
						<td class='blogright'>
						$billingcountry
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>City:</td>
						<td class='blogright'>
						$billingcity
						</td>
						</tr>
				    
						<tr>
						<td class='blogleft'>State:</td>
						<td class='blogright'>
						$billingstate
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>Bio:</td>
						<td>
						$bio
						</td>
						</tr>
						
						</table>";
						break;
				
						case"2":
						$memberid = ($_SESSION['memberloggedin']);
						$error = ($_GET['error']);
				
						echo"
						<table align=\"left\" class='cartbox'>
						<form enctype=\"multipart/form-data\" action=\"membersedit.php\" method=\"post\">";
				
						if ($error == 1) {
						    echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td>
						Please fill in all *required fields.
						</td>
						</tr>";
						}
						if ($error == 2) {
						    echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td>
						Your passwords did not match.
						</td>
						</tr>";
						}
						if ($error == 3) {
						    echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td>
						That e-mail is already being used.
						</td>
						</tr>";
						}
						if ($error == 4) {
						    echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td>
						That username is already being used.
						</td>
						</tr>";
						}
						
						if ($error == 5) {
						    echo"	
						<tr>
						<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
						<td>
						Your email was in the wrong format.
						</td>
						</tr>";
						}
				
						echo"	
						<tr>
						<td class='blogleft'>First Name:</td>
						<td class='blogright'>
						<input type=\"text\" name=\"first\" value=\"$first\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>Last Name:</td>
						<td class='blogright'>
						<input type=\"text\" name=\"last\" value=\"$last\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>*Username:</td>
						<td class='blogright'>
						<input type=\"text\" name=\"username\" value=\"$username\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>*You are a:</td>
						<td>
						<select name='type'>";
						$result = mysql_query("SELECT * FROM `user_type`");
						while ($r = mysql_fetch_array($result)) {
							$typeid = ($r['id']);
							$typename = ($r['name']);
							echo"<option value='$typeid'"; if ($type == $typeid) { echo" selected"; } echo">$typename</option>";	
						}
						echo"
						</select>
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>*Age:</td>
						<td>
						<select name='age'>";
						$count = 18;
						while ($count < 65) {
							echo"<option value='$count' "; if ($age == $count) { echo" selected"; } echo">$count</option>";
							$count += 1;
						}
						echo"
						</select>
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>*Sex:</td>
						<td>
						<select name='sex'>
						<option value='Male' "; if ($sex == 'Male') { echo"selected"; } echo">Male</option>
						<option value='Female' "; if ($sex == 'Female') { echo"selected"; } echo">Female</option>
						</select>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>*E-mail:</td>
						<td class='blogright'>
						<input type=\"text\" name=\"email\" value=\"$email\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>Phone:</td>
						<td class='blogright'>
						<input type=\"text\" name=\"phone\" value=\"$phone\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>*Password:</td>
						<td class='blogright'>
						<input type=\"password\" name=\"password\" value=\"$password\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>*Confirm Password:</td>
						<td class='blogright'>
						<input type=\"password\" name=\"password2\" value=\"$password\" size=\"50\" maxlength=\"50\"/>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>*Country:</td>
						<td class='blogright'>
						<select name='billingcountry' onchange='refreshState(this.value)' style='width:245px;  padding:5px; border:1px solid #ccc;' >";
						$resultCountry = mysql_query("SELECT * FROM `citydb` group by country order by country");
						while ($rCountry = mysql_fetch_array($resultCountry)) {
							$nameCountry = ($rCountry['country']);
							$CountryCode = ($rCountry['country_code']);
							echo"<option value='$nameCountry' "; if ($billingcountry == $nameCountry) { echo"selected"; } echo">$nameCountry</option>";
						}
						echo"
						</select>
						</td>
						</tr>
						
						<tr>
						<td class='blogleft'>*State:</td>
						<td class='blogright'>
						<select name='billingstate' id='state' onchange='refreshCity(this.value)' style='width:245px; padding:5px; border:1px solid #ccc;' >";
			
						$resultState = mysql_query("SELECT * FROM `citydb` where country='$billingcountry' group by state order by state");
							while ($rState = mysql_fetch_array($resultState)) {
								$nameState = ($rState['state']);
								echo"<option value='$nameState' "; if ($billingstate == $nameState) { echo"selected"; } echo">$nameState</option>";
							} 
						echo"
						</select>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>*City:</td>
						<td class='blogright'>
						<select name='billingcity' id='city' style='width:245px; padding:5px; border:1px solid #ccc;'>";
						$resultCity = mysql_query("SELECT * FROM `citydb` where state='$billingstate' group by city order by city");
						while ($rCity = mysql_fetch_array($resultCity)) {
							$nameCity = ($rCity['city']);
							echo"<option value='$nameCity' "; if ($billingcity == $nameCity) { echo"selected"; } echo">$nameCity</option>";
						}
						echo"
						</select>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'>Bio:</td>
						<td class='blogright'>
						<textarea name='bio'>$bio1</textarea>
						</td>
						</tr>
				
						<tr>
						<td class='blogleft'></td>
						<td align=\"left\" valign=\"top\">
						<input type=\"hidden\" name=\"originalemail\" value=\"$originalemail\" />
						<input type=\"hidden\" name=\"originalusername\" value=\"$originalusername\" />
						<input style='float:left;' type=\"submit\" name=\"submit\" value=\"SAVE\" />
						<input style='float:left;' type=\"reset\" name=\"reset\" value=\"Reset\" />
						<br /><br />
						</form>
						</td>
						</tr>
						</table>";
						break;
					
						case"3":
						$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
						$r = mysql_fetch_array($result);
						$photo = ($r['photo']);
						if ($photo == "") {
							$photo = "noimage.jpg";
						}
						
						echo"<p><br /></p>";
						echo"<p><img src='members/$photo' width='115px' height='107px' /></p><br />";
						
						if ($error == 6) { echo"<p style='text-align:left; margin-top:5px;'>You can only upload image files.</p>"; }
						
						echo"<form style='float:left;' enctype='multipart/form-data' action=\"socialaddprofilepic.php\" method='post'>
						<p><input name='pic' type='file' /></p>
						<input type='hidden' name='photo' value='$photo' />
						<input type='submit' name='submit' value='Update' />
						</form>";
					      
						break;
					}
					?>
					</div>
				<div class='cl'></div>
				</div>
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
