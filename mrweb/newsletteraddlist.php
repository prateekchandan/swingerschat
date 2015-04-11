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
	$name = ($_POST['name']);
	
	if (empty($_POST['name'])) {
		header("Location: newsletteraddlist.php?error=1");
		exit;
	}
	
	$sql="INSERT INTO newsletter_lists (name) VALUES('$name')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	$result = mysql_query("SELECT * FROM `newsletter_lists` ORDER BY `id` DESC");
	$r = mysql_fetch_array($result);
	$list_id = ($r['id']);
	
	$tablename = "newsletter_list_" . $list_id;
	$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, memberid int, email text, PRIMARY KEY (id))";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	$result = mysql_query("SELECT * FROM `newsletter`");
	while ($r = mysql_fetch_array($result)) {
		$memberid = ($r['id']);
		$member_email = ($r['email']);
		$member_id = ($_POST["$memberid"]);
		if ($member_id == 1) {
			$sql="INSERT INTO $tablename (memberid, email) VALUES('$memberid','$member_email')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: ' . mysql_error());
			}
		}
	}

	header("Location: newsletter.php");
	exit;
	
} else {

$error = ($_GET['error']);



echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"newsletteraddlist.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"You must enter a name for the list";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";

}

if ($error == 2) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"There is already a member with that e-mail address.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";

}

if ($error ==3) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"The e-mail address is not in the correct format.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";

}

echo"
<tr>
<td class=\"editpageleft\">Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the list.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">Add Members:</td>
<td class=\"editpageright\">";
	
	$count = 1;
	echo"<table width='100%' cellpadding='2px' cellspacing='2px' border='0'>";
	$result = mysql_query("SELECT * FROM `newsletter` WHERE `status` = '1' ORDER BY `first`");
	while ($r = mysql_fetch_array($result)) {
		$member_id = ($r['id']);
		$member_first = ($r['first']);
		$member_last = ($r['last']);
		$member_email = ($r['email']);
		if ($count == 2) {
			echo"<tr>";
			echo"<td align='left' valign='top' style='background-color:#d6e2e7;'>";
			echo"<input type='checkbox' name='$member_id' value='1' />";
			echo"</td>";
			echo"<td align='left' valign='top' style='background-color:#d6e2e7;'>";
			echo"$member_first $member_last";
			echo"</td>";
			echo"<td align='left' valign='top' style='background-color:#d6e2e7;'>";
			echo"$member_email";
			echo"</td>";
			echo"</tr>";
			$count = 1;
		} else {
			echo"<tr>";
			echo"<td align='left' valign='top' style='background-color:#e1edf2;'>";
			echo"<input type='checkbox' name='$member_id' value='1' />";
			echo"</td>";
			echo"<td align='left' valign='top' style='background-color:#e1edf2;'>";
			echo"$member_first $member_last";
			echo"</td>";
			echo"<td align='left' valign='top' style='background-color:#e1edf2;'>";
			echo"$member_email";
			echo"</td>";
			echo"</tr>";
			$count += 1;
		}
		
	}
	echo"</table>";

echo"</td><td class=\"editpagehints\">
Check the box next to all the members you want in this list. You can go back and edit this later.
</td></tr>";



echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"submit\" name=\"submit\" value=\"Add New List\" />
<a href=\"newsletter.php\">Cancel</a>
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




