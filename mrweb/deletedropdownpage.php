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
$dropdowntableid = ($_GET['dropdowntableid']);
$query = "DELETE FROM $tablename WHERE id = $dropdowntableid";
$results = mysql_query($query);

$count = 1;
$result = mysql_query("SELECT * FROM $tablename ORDER BY pageorder ASC");
while ($r = mysql_fetch_array($result)) {
	$dropdownpageid = ($r['id']);
	$pageorder = ($r['pageorder']);
	mysql_query("UPDATE `$tablename` SET `pageorder`='$count' WHERE `id` = '$dropdownpageid' ");
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




