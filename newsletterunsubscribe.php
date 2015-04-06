<?php
echo"<html>";
echo"<body>";

$dbc = mysql_connect("mrwebpagecms.db.2345800.hostedresource.com","mrwebpagecms","cC1777771"); 
if (!$dbc) {
	die('Could not connect: ' . mysql_error());
} 
mysql_select_db("mrwebpagecms", $dbc);

if (isset ($_POST['submit'])) {
	$email = ($_POST['email']);
	
	mysql_query("UPDATE `newsletter` SET `status` = '3' WHERE `email` = '$email' ");
	
	$result = mysql_query("SELECT * FROM `newsletter_lists`");
	while ($r = mysql_fetch_array($result)) {
		$list_id = ($r['id']);
		$tablename = "newsletter_list_" . $list_id;
		$result2 = mysql_query("SELECT * FROM `$tablename` WHERE `email` = '$email'");
		while ($r2 = mysql_fetch_array($result2)) {
			$listID = ($r2['id']);
			$query = "DELETE FROM $tablename WHERE id = $listID";
			$results = mysql_query($query);
		}
	}
	
	echo"<br /><br />We have removed this e-mail from our mailing list.";
	
} else {
	echo"<form enctype='multipart/form-data' action=\"newsletterunsubscribe.php\" method='post'>";
	
	echo"
	<br /><br />
	<table align='left'>
	<tr>
	<td align='left' valign='top'>Enter the e-mail address you want removed from our mailing list.</td>
	</tr>
	
	<tr>
	<td align='left' valign='top'><input type=\"text\" name=\"email\" size=\"75\" /></td>
	</tr>
	
	<tr>
	<td align='left' valign='top'><input type=\"submit\" name=\"submit\" value=\"UnSubscribe\" /></form></td>
	</tr>
	
	</table>";
}

echo"</html>";
echo"</body>";
?>


