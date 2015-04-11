<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$pageid = ($_GET['pageid']);
$pageorder = ($_GET['pageorder']);

if ($pageorder == 1) {
	header ('Location: adminhome.php');
	exit();
}

$newpageorder = ($pageorder - 1);

$result = mysql_query("SELECT * FROM pages WHERE pageorder = $newpageorder");
$r = mysql_fetch_array($result);
$newpageid = ($r['id']);

mysql_query("UPDATE `pages` SET `pageorder`='$newpageorder' WHERE `id` = '$pageid' ");
mysql_query("UPDATE `pages` SET `pageorder`='$pageorder' WHERE `id` = '$newpageid' ");

header ('Location: adminhome.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




