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
$template_id = ($_GET['id']);
	
	
$result = mysql_query("SELECT * FROM `newsletter_templates`");
while ($r = mysql_fetch_array($result)) {
	$newid = ($r['id']);
	if ($template_id == $newid) {
		mysql_query("UPDATE `newsletter_templates` SET `active` = '1' WHERE `id` = '$newid' ");
	} else {
		mysql_query("UPDATE `newsletter_templates` SET `active` = '0' WHERE `id` = '$newid' ");
	}
}

header("Location: newsletter.php");
exit;
	


?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




