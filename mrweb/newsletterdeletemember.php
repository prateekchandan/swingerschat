<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$emailid = $_GET['emailid'];
$email = $_GET['email'];
$query = "DELETE FROM newsletter WHERE id = $emailid";
$results = mysql_query($query);

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


header ('Location: newsletter.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




