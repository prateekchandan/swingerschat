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
$pagetype = ($r['type']);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);
$membersonly = ($r['membersonly']);

//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}

require ('includes/head.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>


<tr>
<td class="bodytable1">


<?php
$pageid = ($_POST['pageid']);
$tablename = ($_POST['tablename']);
$contactemail = ($_POST['contactemail']);
$code = ($_POST['code']);
$usercode = ($_POST['usercode']);

//Get Page Name
$result = mysql_query("SELECT * FROM pages WHERE id = $pageid");
$r = mysql_fetch_array($result);
$pagename = ($r['name']);


$required = 0;
	
$result = mysql_query("SELECT * FROM $tablename ORDER BY fieldorder ASC");
while ($r = mysql_fetch_array($result)) {
	$name = ($r['name']);
	$fieldid = ($r['id']);
	$formid = "form" . $fieldid;
	$_SESSION["$formid"] = ($_POST["$fieldid"]);
	$fieldtype = ($r['type']);
	$plaintext = ($r['plaintext']);
	$fieldcontent = stripslashes($_POST["$fieldid"]);
	$contenttest = substr("$name", 0, 1);
	//Check for required
	if (($contenttest == "*") && ($fieldcontent == "")) {
		$required = 1;
	}
	
	if ($fieldtype == "text") {
		
	}
	if ($fieldtype == "plaintext") {
		$content .= "$plaintext <br />";	
	} else {
		$content .= "$name : $fieldcontent <br />";
	}
	
	
	if ($fieldtype == "checkbox") {
		$tablename2 = $tablename . "_" . $fieldid;
		$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
		while ($r2 = mysql_fetch_array($result2)) {
			$boxid = ($r2['id']);
			$boxname = ($r2['name']);
			$boxorder = ($r2['fieldorder']);
			$identifier = $fieldid . "_" . $boxid;
			$checkbox = ($_POST["$identifier"]);
			if ($checkbox == 1) {
				$content .= "  - $boxname \n";
				$_SESSION["$identifier"] = $boxname;
			} else {
				unset($_SESSION["$identifier"]);
			}
		}
	}
	if ($fieldtype == "radio") {
		$identifier = "radio_" . $fieldid;
		$boxname = ($_POST["$identifier"]);
		$content .= "  - $boxname \n";
		$_SESSION["$identifier"] = $boxname;
	}
	if ($fieldtype == "dropdown") {
		$identifier = "dropdown_" . $fieldid;
		$boxname = ($_POST["$identifier"]);
		$content .= "  - $boxname \n";
		$_SESSION["$identifier"] = $boxname;
	}
}
	
	
if (($usercode == 4) || ($usercode == "four") || ($usercode == "Four") || ($usercode == "FOUR")) {
	if ($required == 1) {
		header( "Location: index.php?id=$pageid&error=2" ) ;
		exit;
	}
	
	$sitelogo = $baseurl . "images/logo.png";
	$RecipientEmail = $contactemail;
	$RecipientName = $username;
	$SenderEmail = $adminemail; 
	$SenderName = $sitename;
	$cc = "";
	$bcc = "";
	$subject = "Contact Form Results";
	$message = "<div style='width:500px;'>
	
	<span style='color:#276db8; font-size:22px;'>Form - $pagename</span><br />
	----------------------------------------------
	<br /><br />
	
	$content
	</div>";
	
	$attachments = "";
	$priority = ""; //low, high or blank
	$type = ""; //leave blank for HTML or type plain for text
	
	$sent = Email($RecipientEmail, $RecipientName, $SenderEmail, $SenderName, $cc, $bcc, $subject, $message, $attachments, $priority, $type);
		
	
	//Unset Sessions
	$result = mysql_query("SELECT * FROM $tablename ORDER BY fieldorder ASC");
	while ($r = mysql_fetch_array($result)) {
		$fieldid = ($r['id']);
		$formid = "form" . $fieldid;
		unset($_SESSION["$formid"]);

		if ($fieldtype == "checkbox") {
			$tablename2 = $tablename . "_" . $fieldid;
			$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
			while ($r2 = mysql_fetch_array($result2)) {
				$boxid = ($r2['id']);
				$identifier = $fieldid . "_" . $boxid;
				unset($_SESSION["$identifier"]);
			}
		}
		if ($fieldtype == "radio") {
			$identifier = "radio_" . $fieldid;
			unset($_SESSION["$identifier"]);
		}
		if ($fieldtype == "dropdown") {
			$identifier = "dropdown_" . $fieldid;
			unset($_SESSION["$identifier"]);
		}
	}

} else {
	header( "Location: index.php?id=$pageid&error=1" ) ;
	exit;
}



header( "Location: index.php?id=$pageid&sentform=1" ) ;
exit;


?>

</td>
</tr>

<?php
require ('includes/footer.php');
?>
</table>
</body>
</html>

<?php
ob_end_flush();
?>
