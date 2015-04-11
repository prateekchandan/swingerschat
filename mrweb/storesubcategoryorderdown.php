<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$categoryid = ($_GET['id']);
$pageorder = ($_GET['order']);

$result = mysql_query("SELECT * FROM `store_subcategories`");
$rows = mysql_num_rows($result);

if ($pageorder == $rows) {
	header ("Location: store.php");
	exit();
}

$newpageorder = ($pageorder + 1);

$result = mysql_query("SELECT * FROM `store_subcategories` WHERE `pageorder` = '$newpageorder'");
$r = mysql_fetch_array($result);
$newcategoryid = ($r['id']);

mysql_query("UPDATE `store_subcategories` SET `pageorder`='$newpageorder' WHERE `id` = '$categoryid' ");
mysql_query("UPDATE `store_subcategories` SET `pageorder`='$pageorder' WHERE `id` = '$newcategoryid' ");

header ("Location: store.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




