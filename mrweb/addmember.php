<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
<?php
if (isset ($_POST['submit'])) {
	$name = mysql_real_escape_string($_POST['name']);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $username = mysql_real_escape_string($_POST['username']);
	
	$result = mysql_query('SELECT * FROM members WHERE email = "'.$email.'"');
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		header("Location: addmember.php?error=3");
		exit;
	}
	
	$result = mysql_query('SELECT * FROM members WHERE username = "'.$username.'"');
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		header("Location: addmember.php?error=4");
		exit;
	}
	
	$sql="INSERT INTO members (first, email, password, username) VALUES('$name','$email','$password','$username')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: adminhome.php");
	exit;
	
} else {
	
$error = ($_GET['error']);
$error = substr($error, 0, 5);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"addmember.php\" method='post'>";
echo"
<tr>
<td class=\"editpageleft\">Name:</td>
<td class=\"editpageright\">";
echo"<input type='text' name='name' value=\"$name\" size='70'/>";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Username:</td>
<td class=\"editpageright\">";
echo"<input type='text' name='username' value=\"$username\" size='70'/>";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">E-mail:</td>
<td class=\"editpageright\">";
echo"<input type='text' name='email' value=\"$email\" size='70'/>";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Password:</td>
<td class=\"editpageright\">";
echo"<input type='text' name='password' value=\"$password\" size='70'/>";
echo"</td><td class=\"editpagehints\">
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"submit\" name=\"submit\" value=\"Add New Member\" />
<a href=\"adminhome.php\">Cancel</a>
<br /><br />
</form>
</td>
</tr>
</table>";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




