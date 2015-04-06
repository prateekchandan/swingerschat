<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$pageid = ($_GET['pageid']);
$fieldorder = ($_GET['fieldorder']);
$tablename = ($_GET['tablename']);
$fieldid = ($_GET['fieldid']);

$result = mysql_query("SELECT * FROM $tablename");
$rows = mysql_num_rows($result);

if ($fieldorder == $rows) {
	header ("Location: editpage.php?pageid=$pageid");
	exit();
}
$newfieldorder = ($fieldorder + 1);
$result = mysql_query("SELECT * FROM $tablename WHERE fieldorder = $newfieldorder");
$r = mysql_fetch_array($result);
$newfieldid = ($r['id']);

mysql_query("UPDATE `$tablename` SET `fieldorder`='$newfieldorder' WHERE `id` = '$fieldid' ");
mysql_query("UPDATE `$tablename` SET `fieldorder`='$fieldorder' WHERE `id` = '$newfieldid' ");

header ("Location: editpage.php?pageid=$pageid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




