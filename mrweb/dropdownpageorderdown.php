<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$pageid = ($_GET['pageid']);
$pageorder = ($_GET['dropdownpageorder']);
$tablename = ($_GET['tablename']);
$dropdowntableid = ($_GET['dropdowntableid']);

$result = mysql_query("SELECT * FROM $tablename");
$rows = mysql_num_rows($result);

if ($pageorder == $rows) {
	header ("Location: editpage.php?pageid=$pageid");
	exit();
}
$newpageorder = ($pageorder + 1);
$result = mysql_query("SELECT * FROM $tablename WHERE pageorder = $newpageorder");
$r = mysql_fetch_array($result);
$newdropdowntableid = ($r['id']);

mysql_query("UPDATE `$tablename` SET `pageorder`='$newpageorder' WHERE `id` = '$dropdowntableid' ");
mysql_query("UPDATE `$tablename` SET `pageorder`='$pageorder' WHERE `id` = '$newdropdowntableid' ");

header ("Location: editpage.php?pageid=$pageid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




