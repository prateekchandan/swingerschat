<?php
require ('includes/dbconnect.php');
require ('includes/head.php');
?>


<!--Body -->
<tr>
<td class="bodytable">
	<table align="center" cellpadding="5px" cellspacing="0px" width="100%" style='margin-top:10px;'>
    <tr>
	<td class='search'>
    <?php require ('includes/search.php'); ?>
    </td>
    
	<td class='maincell'>
    
    	<table align="center" cellpadding="5px" cellspacing="0px" width="100%">
        <tr>
        <td class='text1'>
        <div class='div1'>
        	<table align="center" cellpadding="0px" cellspacing="0px" border="0" class='bodycontenttable'>
            <tr>
            <td class='bodycontenttop1'></td>
            </tr>
            
            <tr>
            <td class='bodycontentmiddle1'>
            <div class='div3'>
        <?php 
		if (isset ($_POST['submit'])) {
			$memberid = ($_SESSION['memberloggedin']);
			
			$username = mysql_real_escape_string($_POST['username']);
			$first = mysql_real_escape_string($_POST['first']);
			$last = mysql_real_escape_string($_POST['last']);
			$email = mysql_real_escape_string($_POST['email']);
			$password = mysql_real_escape_string($_POST['password']);
			$password2 = mysql_real_escape_string($_POST['password2']);
			$city = mysql_real_escape_string($_POST['city']);
			$state = mysql_real_escape_string($_POST['state']);
			$age = mysql_real_escape_string($_POST['age']);
			$height = mysql_real_escape_string($_POST['height']);
			$height2 = mysql_real_escape_string($_POST['height2']);
			$gender = mysql_real_escape_string($_POST['gender']);
			$kids = mysql_real_escape_string($_POST['kids']);
			$relationship = mysql_real_escape_string($_POST['relationship']);
			$profession = mysql_real_escape_string($_POST['profession']);
			$ethnicity = mysql_real_escape_string($_POST['ethnicity']);
			$faith = mysql_real_escape_string($_POST['faith']);
			$eyes = mysql_real_escape_string($_POST['eyes']);
			$hair = mysql_real_escape_string($_POST['hair']);
			$bodytype = mysql_real_escape_string($_POST['bodytype']);
			$education = mysql_real_escape_string($_POST['education']);
			$smoking = mysql_real_escape_string($_POST['smoking']);
			$firstdate = mysql_real_escape_string($_POST['firstdate']);
			$feature1 = mysql_real_escape_string($_POST['feature1']);
			$feature2 = mysql_real_escape_string($_POST['feature2']);
			$music1 = mysql_real_escape_string($_POST['music1']);
			$music2 = mysql_real_escape_string($_POST['music2']);
			$book = mysql_real_escape_string($_POST['book']);
			$movie = mysql_real_escape_string($_POST['movie']);
			$food = mysql_real_escape_string($_POST['food']);
			$drink = mysql_real_escape_string($_POST['drink']);
			$establishment1 = mysql_real_escape_string($_POST['establishment1']);
			$establishment2 = mysql_real_escape_string($_POST['establishment2']);
			$establishment3 = mysql_real_escape_string($_POST['establishment3']);
			$politics = mysql_real_escape_string($_POST['politics']);
			$whoiam = mysql_real_escape_string($_POST['whoiam']);
			$whoiseek = mysql_real_escape_string($_POST['whoiseek']);
			$whoiam = str_replace("\r\n", "<br />", $whoiam);
			$whoiseek = str_replace("\r\n", "<br />", $whoiseek);
			
			$origemail = $_SESSION['origemail'];
			$origusername = $_SESSION['origusername'];
			$origpass = $_SESSION['origpass'];
			
			$returnvalues = "username=$username&first=$first&last=$last&email=$email&password=$origpass&age=$age&height=$height&height2=$height2&city=$city&state=$state&gender=$gender&relationship=$relationship&kids=$kids&profession=$profession&ethnicity=$ethnicity&faith=$faith&eyes=$eyes&hair=$hair&bodytype=$bodytype&education=$education&smoking=$smoking&firstdate=$firstdate&feature1=$feature1&feature2=$feature2&music1=$music1&music2=$music2&book=$book&movie=$movie&food=$food&drink=$drink&establishment1=$establishment1&establishment2=$establishment2&establishment3=$establishment3&politics=$politics&whoiam=$whoiam&whoiseek=$whoiseek";
			
			if ((empty($_POST['username'])) || (empty($_POST['email'])) || (empty($_POST['password'])) || (empty($_POST['password2']))) {
				header("Location: socialeditprofile.php?error=1& $returnvalues");
				exit;
			}

			if (($_POST['password']) != ($_POST['password2'])) {
				header("Location: socialeditprofile.php?error=2& $returnvalues");
				exit;
			}
			$result = mysql_query('SELECT * FROM members WHERE email = "'.$email.'"');
			$rows = mysql_num_rows($result);
			if ($rows > 0) {
				if ($email != ($_SESSION['origemail'])) {
					header("Location: socialeditprofile.php?error=3& $returnvalues");
					exit;
				}
			}
			$result = mysql_query('SELECT * FROM members WHERE username = "'.$username.'"');
			$rows = mysql_num_rows($result);
			if ($rows > 0) {
				if ($username != ($_SESSION['origusername'])) {
					header("Location: socialeditprofile.php?error=4& $returnvalues");
					exit;
				}
			}
			
			mysql_query("UPDATE `members` SET `username`='$username', `first`='$first', `last`='$last', `email`='$email', `password`='$password', `age`='$age', `height`='$height', `height2`='$height2', `gender`='$gender', `city`='$city', `state`='$state', `relationship`='$relationship', `kids`='$kids', `profession`='$profession', `ethnicity`='$ethnicity', `faith`='$faith', `eye`='$eyes', `hair`='$hair', `body`='$bodytype', `education`='$education', `smoking`='$smoking', `firstdate`='$firstdate', `feature1`='$feature1', `feature2`='$feature2', `music1`='$music1', `music2`='$music2', `book`='$book', `movie`='$movie', `food`='$food', `drink`='$drink', `establishment1`='$establishment1', `establishment2`='$establishment2', `establishment3`='$establishment3', `politics`='$politics', `whoiam`='$whoiam', `whoiseek`='$whoiseek' WHERE `id` = '$memberid' ");
			
			header("Location: socialeditprofile.php?message=1");
			exit;
			
		} else {
		
		$message = ($_GET['message']);
		
		if (isset($_GET['error'])) {
			$error = ($_GET['error']);
			$username = ($_GET['username']);
			$first = ($_GET['first']);
			$last = ($_GET['last']);
			$email = ($_GET['email']);
			$password = ($_GET['password']);
			$city = ($_GET['city']);
			$state = ($_GET['state']);
			if ($state == "") { $state = "TX";}
			$age = ($_GET['age']);
			$height = ($_GET['height']);
			$height2 = ($_GET['height2']);
			$gender = ($_GET['gender']);
			$kids = ($_GET['kids']);
			$relationship = ($_GET['relationship']);
			$profession = ($_GET['profession']);
			$ethnicity = ($_GET['ethnicity']);
			$faith = ($_GET['faith']);
			$eyes = ($_GET['eyes']);
			$hair = ($_GET['hair']);
			$bodytype = ($_GET['bodytype']);
			$education = ($_GET['education']);
			$smoking = ($_GET['smoking']);
			$firstdate = ($_GET['firstdate']);
			$feature1 = ($_GET['feature1']);
			$feature2 = ($_GET['feature2']);
			$music1 = ($_GET['music1']);
			$music2 = ($_GET['music2']);
			$book = ($_GET['book']);
			$movie = ($_GET['movie']);
			$food = ($_GET['food']);
			$drink = ($_GET['drink']);
			$establishment1 = ($_GET['establishment1']);
			$establishment2 = ($_GET['establishment2']);
			$establishment3 = ($_GET['establishment3']);
			$politics = ($_GET['politics']);
			$whoiam = ($_GET['whoiam']);
			$whoiseek = ($_GET['whoiseek']);
		} else {
			$memberid = ($_SESSION['memberloggedin']);
			$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
			$r = mysql_fetch_array($result);
			$username = ($r['username']);
			$first = ($r['first']);
			$last = ($r['last']);
			$email = ($r['email']);
			$password = ($r['password']);
			$photo = ($r['photo']);
			$city = ($r['city']);
			$state = ($r['state']);
			$description = stripslashes($r['description']);
			$gender = ($r['gender']);
			$relationship = ($r['relationship']);
			$college = ($r['college']);
			$age = ($r['age']);
			$height = ($r['height']);
			$height2 = ($r['height2']);
			$status = ($r['status']);
			$kids = ($r['kids']);
			$relationship = ($r['relationship']);
			$profession = ($r['profession']);
			$ethnicity = ($r['ethnicity']);
			$faith = ($r['faith']);
			$eyes = ($r['eye']);
			$hair = ($r['hair']);
			$bodytype = ($r['body']);
			$education = ($r['education']);
			$smoking = ($r['smoking']);
			$firstdate = ($r['firstdate']);
			$feature1 = ($r['feature1']);
			$feature2 = ($r['feature2']);
			$music1 = ($r['music1']);
			$music2 = ($r['music2']);
			$book = ($r['book']);
			$movie = ($r['movie']);
			$food = ($r['food']);
			$drink = ($r['drink']);
			$establishment1 = ($r['establishment1']);
			$establishment2 = ($r['establishment2']);
			$establishment3 = ($r['establishment3']);
			$politics = ($r['politics']);
			$whoiam = ($r['whoiam']);
			$whoiseek = ($r['whoiseek']);
			
			$_SESSION['origemail'] = "$email";
			$_SESSION['origusername'] = "$username";
			$_SESSION['origpass'] = "$password";
		}
		
		echo"
			<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"600px\" style=\"border:2px solid #c0c1c3;\">
			<form enctype=\"multipart/form-data\" action=\"socialeditprofile.php\" method=\"post\">";
			
			if ($error == 1) {
				echo"	
				<tr>
				<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
				<td class='blogright'>
				Please fill in all *required fields.
				</td>
				</tr>";
			}
			if ($error == 2) {
				echo"	
				<tr>
				<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
				<td class='blogright'>
				Your passwords did not match.
				</td>
				</tr>";
			}
			if ($error == 3) {
				echo"	
				<tr>
				<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
				<td class='blogright'>
				That e-mail is already being used.
				</td>
				</tr>";
			}
			if ($error == 4) {
				echo"	
				<tr>
				<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
				<td class='blogright'>
				That username is already being used.
				</td>
				</tr>";
			}
			if ($message == 1) {
				echo"	
				<tr>
				<td class='blogleft' style='background-color:#baf4c5;'>SUCCESS:</td>
				<td class='blogright'>
				You successfully updated your profile.
				</td>
				</tr>";
			}
			
			//Personal Info
			
		echo"	
			<tr>
			<td colspan='2' class='blogheader'>PERSONAL INFORMATION:</td>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*Username:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"username\" size=\"50\" value='$username' maxlength=\"50\"/>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>First Name:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"first\" size=\"50\" value='$first' maxlength=\"50\"/>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Last Name:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"last\" size=\"50\" value='$last' maxlength=\"50\"/>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>City:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"city\" size=\"50\" value='$city' maxlength=\"50\"/>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*State:</td>
			<td class='blogright'>";
			?>
			<select name="state" size="1" class="formfields" style="width: 49; height: 19">
            <option value="AL" <?php if ($state == "AL") { echo"selected='selected'"; } ?> >AL</option>
            <option value="AK" <?php if ($state == "AK") { echo"selected='selected'"; } ?> >AK</option>
            <option value="AZ" <?php if ($state == "AZ") { echo"selected='selected'"; } ?> >AZ</option>
            <option value="AR" <?php if ($state == "AR") { echo"selected='selected'"; } ?> >AR</option>
            <option value="CA" <?php if ($state == "CA") { echo"selected='selected'"; } ?> >CA</option> 
            <option value="CO" <?php if ($state == "CO") { echo"selected='selected'"; } ?> >CO</option> 
            <option value="CT" <?php if ($state == "CT") { echo"selected='selected'"; } ?> >CT</option> 
            <option value="DE" <?php if ($state == "DE") { echo"selected='selected'"; } ?> >DE</option> 
            <option value="DC" <?php if ($state == "DC") { echo"selected='selected'"; } ?> >DC</option> 
            <option value="FL" <?php if ($state == "FL") { echo"selected='selected'"; } ?> >FL</option> 
            <option value="GA" <?php if ($state == "GA") { echo"selected='selected'"; } ?> >GA</option> 
            <option value="HI" <?php if ($state == "HI") { echo"selected='selected'"; } ?> >HI</option> 
            <option value="ID" <?php if ($state == "ID") { echo"selected='selected'"; } ?> >ID</option> 
            <option value="IL" <?php if ($state == "IL") { echo"selected='selected'"; } ?> >IL</option> 
            <option value="IN" <?php if ($state == "IN") { echo"selected='selected'"; } ?> >IN</option> 
            <option value="IA" <?php if ($state == "IA") { echo"selected='selected'"; } ?> >IA</option> 
            <option value="KS" <?php if ($state == "KS") { echo"selected='selected'"; } ?> >KS</option> 
            <option value="KY" <?php if ($state == "KY") { echo"selected='selected'"; } ?> >KY</option> 
            <option value="LA" <?php if ($state == "LA") { echo"selected='selected'"; } ?> >LA</option> 
            <option value="ME" <?php if ($state == "ME") { echo"selected='selected'"; } ?> >ME</option> 
            <option value="MD" <?php if ($state == "MD") { echo"selected='selected'"; } ?> >MD</option> 
            <option value="MA" <?php if ($state == "MA") { echo"selected='selected'"; } ?> >MA</option> 
            <option value="MI" <?php if ($state == "MI") { echo"selected='selected'"; } ?> >MI</option> 
            <option value="MN" <?php if ($state == "MN") { echo"selected='selected'"; } ?> >MN</option> 
            <option value="MS" <?php if ($state == "MS") { echo"selected='selected'"; } ?> >MS</option> 
            <option value="MO" <?php if ($state == "MO") { echo"selected='selected'"; } ?> >MO</option> 
            <option value="MT" <?php if ($state == "MT") { echo"selected='selected'"; } ?> >MT</option> 
            <option value="NE" <?php if ($state == "NE") { echo"selected='selected'"; } ?> >NE</option> 
            <option value="NV" <?php if ($state == "NV") { echo"selected='selected'"; } ?> >NV</option> 
            <option value="NH" <?php if ($state == "NH") { echo"selected='selected'"; } ?> >NH</option> 
            <option value="NJ" <?php if ($state == "NJ") { echo"selected='selected'"; } ?> >NJ</option> 
            <option value="NM" <?php if ($state == "NM") { echo"selected='selected'"; } ?> >NM</option> 
            <option value="NY" <?php if ($state == "NY") { echo"selected='selected'"; } ?> >NY</option> 
            <option value="NC" <?php if ($state == "NC") { echo"selected='selected'"; } ?> >NC</option> 
            <option value="ND" <?php if ($state == "ND") { echo"selected='selected'"; } ?> >ND</option> 
            <option value="OH" <?php if ($state == "OH") { echo"selected='selected'"; } ?> >OH</option> 
            <option value="OK" <?php if ($state == "OK") { echo"selected='selected'"; } ?> >OK</option> 
            <option value="OR" <?php if ($state == "OR") { echo"selected='selected'"; } ?> >OR</option> 
            <option value="PA" <?php if ($state == "PA") { echo"selected='selected'"; } ?> >PA</option> 
            <option value="RI" <?php if ($state == "RI") { echo"selected='selected'"; } ?> >RI</option> 
            <option value="SC" <?php if ($state == "SC") { echo"selected='selected'"; } ?> >SC</option> 
            <option value="SD" <?php if ($state == "SD") { echo"selected='selected'"; } ?> >SD</option> 
            <option value="TN" <?php if ($state == "TN") { echo"selected='selected'"; } ?> >TN</option> 
            <option value="TX" <?php if ($state == "TX") { echo"selected='selected'"; } ?>>TX</option> 
            <option value="UT" <?php if ($state == "UT") { echo"selected='selected'"; } ?> >UT</option> 
            <option value="VT" <?php if ($state == "VT") { echo"selected='selected'"; } ?> >VT</option> 
            <option value="VA" <?php if ($state == "VA") { echo"selected='selected'"; } ?> >VA</option> 
            <option value="WA" <?php if ($state == "WA") { echo"selected='selected'"; } ?> >WA</option> 
            <option value="WV" <?php if ($state == "WV") { echo"selected='selected'"; } ?> >WV</option> 
            <option value="WI" <?php if ($state == "WI") { echo"selected='selected'"; } ?> >WI</option> 
            <option value="WY" <?php if ($state == "WY") { echo"selected='selected'"; } ?> >WY</option>
            </select>
            <?php
			echo"
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*Gender:</td>
			<td class='blogright'>
			<select name='gender'>
			<option value='Male' "; if ($gender == "Male") {echo"selected='selected'";} echo">Male</option>
			<option value='Female' "; if ($gender == "Female") {echo"selected='selected'";} echo">Female</option>
			</select>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*Age:</td>
			<td class='blogright'>
			<select name='age'>";
			$count = 21;
			while ($count < 99) {
				if ($age == $count) {
					echo"<option value='$count' selected='selected'>$count</option>";
				} else {
					echo"<option value='$count'>$count</option>";
				}
				$count += 1;
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Height:</td>
			<td class='blogright'>
			<select name='height'>";
			$count = 1;
			while ($count < 10) {
				if ($height == $count) {
					echo"<option value='$count' selected='selected'>$count</option>";
				} else {
					echo"<option value='$count'>$count</option>";
				}
				$count += 1;
			}
			echo"
			</select> FT.
			
			<select name='height2'>";
			$count = 0;
			while ($count < 12) {
				if ($height2 == $count) {
					echo"<option value='$count' selected='selected'>$count</option>";
				} else {
					echo"<option value='$count'>$count</option>";
				}
				$count += 1;
			}
			echo"
			</select> in.
			</td>
			</tr>";
			
			//Parameters
			
			echo"
		    <tr>
			<td colspan='2' class='blogheader'>PARAMETERS:</td>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Relationship Status:</td>
			<td class='blogright'>
			<select name='relationship'>";
			$result = mysql_query('SELECT * FROM `relationship`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $relationship) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Kids:</td>
			<td class='blogright'>
			<select name='kids'>";
			$result = mysql_query('SELECT * FROM `kids`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $kids) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Profession:</td>
			<td class='blogright'>
			<select name='profession'>";
			$result = mysql_query('SELECT * FROM `professions`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $profession) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Ethinicity:</td>
			<td class='blogright'>
			<select name='ethnicity'>";
			$result = mysql_query('SELECT * FROM `ethnicity`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $ethnicity) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Faith:</td>
			<td class='blogright'>
			<select name='faith'>";
			$result = mysql_query('SELECT * FROM `faith`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $faith) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Eye Color:</td>
			<td class='blogright'>
			<select name='eyes'>";
			$result = mysql_query('SELECT * FROM `eyes`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $eyes) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Hair Color:</td>
			<td class='blogright'>
			<select name='hair'>";
			$result = mysql_query('SELECT * FROM `hair`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $hair) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Body Type:</td>
			<td class='blogright'>
			<select name='bodytype'>";
			$result = mysql_query('SELECT * FROM `bodytype`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $bodytype) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Education:</td>
			<td class='blogright'>
			<select name='education'>";
			$result = mysql_query('SELECT * FROM `education`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $education) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Smoking:</td>
			<td class='blogright'>
			<select name='smoking'>";
			$result = mysql_query('SELECT * FROM `smoking`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $smoking) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			
			echo"
			<tr>
			<td class='blogleft'>*First Date:</td>
			<td class='blogright'>
			<select name='firstdate'>";
			$result = mysql_query('SELECT * FROM `firstdate`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $firstdate) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Physical Features: <br /><span style='font-size:10px;'>(1st choice)</span></td>
			<td class='blogright'>
			<select name='feature1'>";
			$result = mysql_query('SELECT * FROM `features`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $feature1) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			
			echo"
			<tr>
			<td class='blogleft'>*Physical Features: <br /><span style='font-size:10px;'>(2nd choice)</span></td>
			<td class='blogright'>
			<select name='feature2'>";
			$result = mysql_query('SELECT * FROM `features`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $feature2) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Music: <br /><span style='font-size:10px;'>(1st choice)</span></td>
			<td class='blogright'>
			<select name='music1'>";
			$result = mysql_query('SELECT * FROM `music`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $music1) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>*Music: <br /><span style='font-size:10px;'>(2nd choice)</span></td>
			<td class='blogright'>
			<select name='music2'>";
			$result = mysql_query('SELECT * FROM `music`');
			while ($r = mysql_fetch_array($result)) {
				$name = ($r['name']);
				if ($name == $music2) {
					echo"<option value='$name' selected='selected'>$name</option>";
				} else {
					echo"<option value='$name'>$name</option>";
				}
			}
			echo"
			</select>
			</td>
			</tr>";
			
			//Extra Parameters
			
			echo"
			<tr>
			<td colspan='2' class='blogheader'>EXTRA PARAMERTERS: <span style='font-size:10px;text-decoration:italic;'>(These can be filled out later.)</span></td>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Book:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"book\" size=\"50\" value='$book' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Movie:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"movie\" size=\"50\" value='$movie' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Food:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"food\" size=\"50\" value='$food' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Drink:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"drink\" size=\"50\" value='$drink' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Local Establishment: <br /><span style='font-size:10px;'>(1st choice)</span></td>
			<td class='blogright'>
			<input type=\"text\" name=\"establishment1\" size=\"50\" value='$establishment1' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Local Establishment: <br /><span style='font-size:10px;'>(2nd choice)</span></td>
			<td class='blogright'>
			<input type=\"text\" name=\"establishment2\" size=\"50\" value='$establishment2' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Favorite Local Establishment: <br /><span style='font-size:10px;'>(3rd choice)</span></td>
			<td class='blogright'>
			<input type=\"text\" name=\"establishment3\" size=\"50\" value='$establishment3' maxlength=\"50\"/>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Politics:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"politics\" size=\"50\" value='$politics' maxlength=\"50\"/>
			</td>
			</tr>";
			
			$whoiam = str_replace("<br />", "\r\n", $whoiam);
			$whoiseek = str_replace("<br />", "\r\n", $whoiseek);
			
			echo"
			<tr>
			<td class='blogleft'>Who I am:</td>
			<td class='blogright'>
			<textarea name='whoiam' rows='10' cols='46'>$whoiam</textarea>
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class='blogleft'>Who I seek:</td>
			<td class='blogright'>
			<textarea name='whoiseek' rows='10' cols='46'>$whoiseek</textarea>
			</td>
			</tr>";
			
			//Login Info
			
			echo"
			
			<tr>
			<td colspan='2' class='blogheader'>LOGIN INFORMATION:</td>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*E-mail:</td>
			<td class='blogright'>
			<input type=\"text\" name=\"email\" size=\"50\" value='$email' maxlength=\"50\"/>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*Password:</td>
			<td class='blogright'>
			<input type=\"password\" name=\"password\" value='$password' size=\"50\" maxlength=\"50\"/>
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>*Confirm Password:</td>
			<td class='blogright'>
			<input type=\"password\" name=\"password2\" value='$password' size=\"50\" maxlength=\"50\"/>
			</td>
			</tr>
		
			<tr>
			<td class='blogleft'></td>
			<td class='blogright'>
			<input type=\"submit\" name=\"submit\" value=\"SAVE CHANGES\" />
			<input type=\"reset\" name=\"reset\" value=\"Reset\" />
			<br /><br />
			</form>
			</td>
			</tr>
			</table>";
		}
		
		
		?>
        	</div>
        	</td>
            </tr>
            
            <tr>
            <td class='bodycontentbottom1'></td>
            </tr>
            </table>
            
        </div>
        </td>
        </tr>
        
        <tr>
        <td class='text2'>
        <div class='div2'>
        </div>
        </td>
        </tr>
        </table>
    
    </td>
    </tr>
    </table>
    
</td>
</tr>
</table>

<?php
require ('includes/footer.php');
?>



</body>
</html>

<?php
ob_end_flush();
?>
