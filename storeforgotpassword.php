<?php
require ('includes/dbconnect.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='search'>
    <?php require ('includes/search.php'); ?>
    </td>
    </tr>
	</table>
</td>
</tr>

<tr>
<td class="bodytable2">   
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='maincell'>
    	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
        <tr>
        <td class='text1' colspan='2'>
        <div class='div1'>
        <?php 
if (isset ($_POST['submit'])) {
	$email = ($_POST['email']);
	
	if (empty($_POST['email'])) {
		header("Location: storeforgotpassword.php?error=1");
		exit;
	}
	
	$result = mysql_query("SELECT * FROM `members` WHERE `email` = '$email'");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		$r = mysql_fetch_array($result);
		$realpassword = ($r['password']);
		
		mail( "$email", "Account Info", "Here is the login info you requested. \n---------------------------------------------- \n\nE-mail: $email \nPassword: $realpassword", "From: $adminemail" ) ;
		
		echo"<br /><br /><br /><center>We have sent you an e-mail with your login info. <br /><br /><a href=\"storelogin.php\">Login?</a></center><br /><br /><br />";
	} else {
		header("Location: storeforgotpassword.php?error=2");
		exit;
	}
	
} else {
$blogid = ($_GET['blogid']);
$error = ($_GET['error']);

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"95%\" style=\"border:2px solid #202120;\">
	<form enctype=\"multipart/form-data\" action=\"storeforgotpassword.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"	
		<tr>
		<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
		<td>
		You must enter your e-mail address.
		</td>
		</tr>";
	}
	if ($error == 2) {
		echo"	
		<tr>
		<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
		<td>
		There are no accounts with that e-mail address.
		</td>
		</tr>";
	}
	
echo"
	<tr>
	<td class='blogleft'></td>
	<td>
	Enter your e-mail address used for logging in.
	</td>
	</tr>
	
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


?>
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
