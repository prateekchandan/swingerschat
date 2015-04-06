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

if ($pageorder == 1) {
	header ("Location: store.php");
	exit();
}

$newpageorder = ($pageorder - 1);

$result = mysql_query("SELECT * FROM `store_categories` WHERE `pageorder` = '$newpageorder'");
$r = mysql_fetch_array($result);
$newcategoryid = ($r['id']);

mysql_query("UPDATE `store_categories` SET `pageorder`='$newpageorder' WHERE `id` = '$categoryid' ");
mysql_query("UPDATE `store_categories` SET `pageorder`='$pageorder' WHERE `id` = '$newcategoryid' ");

header ("Location: store.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




