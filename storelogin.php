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
	$blogid = ($_POST['blogid']);
	$email = ($_POST['email']);
	$password = ($_POST['password']);
	
	if (empty($_POST['email'])) {
		header("Location: storelogin.php?error=1");
		exit;
	}
	if (empty($_POST['password'])) {
		header("Location: storelogin.php?error=1");
		exit;
	}
	$result = mysql_query("SELECT * FROM `members` WHERE `email` = '$email'");
	$r = mysql_fetch_array($result);
	$realpassword = ($r['password']);
	$memberid = ($r['id']);
	if ($password == $realpassword) {
		$_SESSION['memberloggedin'] = "$memberid";
	} else {
		header("Location: storelogin.php?error=2");
		exit;
	}
	
	//Empty guest cart to member cart
	$ip=getenv("REMOTE_ADDR");
	$tablename = "member_" . $memberid;
	$result = mysql_query("SELECT * FROM `guests` WHERE `ip` = '$ip'");
	while ($r = mysql_fetch_array($result)) {
		$id = ($r['id']);
		$quantity = ($r['quantity']);
		$productid = ($r['productid']);

		$sql3="INSERT INTO `$tablename` (productid, quantity) VALUES('$productid','$quantity')";
		if (!mysql_query($sql3,$dbc)) {
			die('Error: ' . mysql_error());
		}
		
		$query = "DELETE FROM `guests` WHERE `id` = '$id'";
		$results = mysql_query($query);
	}
	
	header("Location: storeviewcart.php");
	exit;

} else {
$error = ($_GET['error']);

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"95%\" style=\"border:2px solid #202120;\">
	<form enctype=\"multipart/form-data\" action=\"storelogin.php\" method=\"post\">";
	
	if ($error == 1) {
		echo"	
		<tr>
		<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
		<td>
		You must fill out both fields.
		</td>
		</tr>";
	}
	if ($error == 2) {
		echo"	
		<tr>
		<td class='blogleft' style='background-color:#FF0000;'>Error:</td>
		<td>
		Your login information was incorrect.
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
	<input type=\"text\" name=\"password\" size=\"50\" maxlength=\"50\"/>
	</td>
	</tr>

	<tr>
	<td class='blogleft'></td>
	<td align=\"left\" valign=\"top\">
	<input type=\"submit\" name=\"submit\" value=\"Login\" />
	<input type=\"reset\" name=\"reset\" value=\"Reset\" />
	<a href=\"storeforgotpassword.php\">Forgot password?</a>
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
