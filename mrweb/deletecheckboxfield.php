<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$pageid = $_GET['pageid'];
$tablename = ($_GET['tablename']);
$fieldid = ($_GET['fieldid']);
$query = "DELETE FROM $tablename WHERE id = $fieldid";
$results = mysql_query($query);

$count = 1;
$result = mysql_query("SELECT * FROM $tablename ORDER BY fieldorder ASC");
while ($r = mysql_fetch_array($result)) {
	$fieldid = ($r['id']);
	$fieldorder = ($r['fieldorder']);
	mysql_query("UPDATE `$tablename` SET `fieldorder`='$count' WHERE `id` = '$fieldid' ");
	$count += 1;
}
	
header ("Location: editpage.php?pageid=$pageid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




