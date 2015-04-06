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
$sql="INSERT INTO newsletter_actions (messages) VALUES ('1')";
if (!mysql_query($sql,$dbc)) {
	die('Error: ' . mysql_error());
}
$result = mysql_query("SELECT * FROM `newsletter_actions` ORDER BY `id` DESC");
$r = mysql_fetch_array($result);
$action_id = ($r['id']);


// Get Active Mailing List		
$result = mysql_query("SELECT * FROM `newsletter_lists` WHERE `active` = '1'");
$r = mysql_fetch_array($result);
$list_id = ($r['id']);
$list_name = ($r['name']);

if ($list_id == 2) {
	$result = mysql_query("SELECT * FROM `newsletter` WHERE `status` = '1'");
	$rows = mysql_num_rows($result);
	while ($r = mysql_fetch_array($result)) {
		$member_id = ($r['id']);
		$member_email = ($r['email']);
	
		$sql="INSERT INTO newsletter_send (memberid, email, action) VALUES ('$member_id','$member_email','$action_id')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
} else {
	$tablename = "newsletter_list_" . $list_id;

	$result = mysql_query("SELECT * FROM `$tablename`");
	$rows = mysql_num_rows($result);
	while ($r = mysql_fetch_array($result)) {
		$member_id = ($r['memberid']);
		$member_email = ($r['email']);
	
		$sql="INSERT INTO newsletter_send (memberid, email, action) VALUES ('$member_id','$member_email','$action_id')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
}

//Get Active Newsletter Template
$result = mysql_query("SELECT * FROM `newsletter_templates` WHERE `active` = '1'");
$r = mysql_fetch_array($result);
$template_id = ($r['id']);
$frommail = ($r['frommail']);
$subject = ($r['subject']);

$message = ($r['message']);
$message .= "\n\nTo Unsubscribe: http://www.scenergy-dating.com/newsletterunsubscribe.php";
$message2 = ($r['message2']);
$message2 .= "\n\n<a href=\"http://www.scenergy-dating.com/newsletterunsubscribe.php\">Unsubscribe from this mailing list.</a>";
$textmail = ($r['textmail']);
$htmlmail = ($r['htmlmail']);
$template_name = ($r['name']);

//Update the Newsletter Action Process
mysql_query("UPDATE `newsletter_actions` SET `messages` = '$rows', `template`='$template_name', `list`='$list_name', `frommail`='$frommail', `subject`='$subject', `message`='$message', `message2`='$message2', `textmail`='$textmail',`htmlmail`='$htmlmail' WHERE `id` = '$action_id' ");

header("Location: newsletter.php");
exit;


?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




