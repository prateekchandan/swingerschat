<?php
require ('includes/dbconnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Blog Page</title>
<META name='description' content='Browse through our blog entries.'>
<META name='keywords' content='blog, blog entries, visit our blog, read our articles'>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
<script src="IE7.js"></script>
<![endif]-->
<SCRIPT type="text/javascript">
function ShowMe(DIV, container){
 if(document.getElementById){
 var tar = document.getElementById(DIV);
 var con = document.getElementById(container).getElementsByTagName("DIV");
  if(tar.className == "hide"){
   tar.className = "show";
  } else {
   tar.className = "hide";
  }
 }
}
</SCRIPT>
<style>
.hide{display:none;}
.show{}
</style>
</head>

<body style="margin:0px 0px 0px 0px;">

<table align="center" cellpadding="0" cellspacing="5px" width="1008px">
<tr>
<td class="headertable" colspan="2">
<?php
$result = mysql_query("SELECT * FROM `logo`");
$r = mysql_fetch_array($result);
$logo = ($r['filename']); 
echo"<img src='logo/$logo' style='float:left; margin-left:20px;'/>"; 
?>
<?php
require ('includes/nav.php');
?>
</td>
</tr>

<!--Body -->
<tr>
<td class="bannertable" colspan="2">
</td>
</tr>

<tr>
<td class="text1">
<?php 
if (isset ($_POST['submit'])) {
	$email = ($_POST['email']);
	
	if (empty($_POST['email'])) {
		header("Location: blogforgotpassword.php?error=1");
		exit;
	}
	
	$result = mysql_query('SELECT * FROM members WHERE email = "'.$email.'"');
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		$r = mysql_fetch_array($result);
		$realpassword = ($r['password']);
		
		mail( "$email", "Account Info", "Here is the login info you requested. \n---------------------------------------------- \n\nE-mail: $email \nPassword: $realpassword", "From: $adminemail" ) ;
		
		echo"<br /><br /><br /><center>We have sent you an e-mail with your login info. <br /><br /><a href=\"blog.php\">Head back to the blog?</a></center><br /><br /><br />";
	} else {
		header("Location: blogforgotpassword.php?error=2");
		exit;
	}
	
} else {
$blogid = ($_GET['blogid']);
$error = ($_GET['error']);

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"95%\" style=\"border:2px solid #202120;\">
	<form enctype=\"multipart/form-data\" action=\"blogforgotpassword.php\" method=\"post\">";
	
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
</td>

<td class="text2">
<center>
<?php
echo"<a href=\"blog.php\">Go back to blog.</a>";
?>
</center>
</td>
</tr>

<tr>
<td class="footer" colspan="2">

<br />
<?php
require ('includes/footernav.php');
?>
<br />

<?php echo"$copyright"; ?>

</td>
</tr>
</table>

</body>
</html>

<?php
ob_end_flush();
?>

