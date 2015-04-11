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
$action_id = ($_GET['action_id']);

$result = mysql_query('SELECT * FROM newsletter_send');
while ($r = mysql_fetch_array($result)) {
	$action = ($r['action']);
	$message_id = ($r['id']);
	
	if ($action == $action_id) {
		$query = "DELETE FROM `newsletter_send` WHERE `id` = '$message_id'";
		$results = mysql_query($query);
	}

}

$query = "DELETE FROM `newsletter_actions` WHERE `id` = '$action_id'";
$results = mysql_query($query);

header("Location: newsletter.php");
exit;

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




