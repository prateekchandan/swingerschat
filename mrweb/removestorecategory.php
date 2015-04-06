<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$id = $_GET['id'];

$result = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$id'");
$r = mysql_fetch_array($result);
$pic1 = ($r['pic1']);
if ($pic1 != "noimage.jpg") {
	unlink("../categories/$pic1");
}

$query = "DELETE FROM `store_categories` WHERE id = $id";
$results = mysql_query($query);

$count = 1;
$result = mysql_query("SELECT * FROM `store_categories` ORDER BY pageorder ASC");
while ($r = mysql_fetch_array($result)) {
	$pageid = ($r['id']);
	$ordernumber = ($r['pageorder']);
	mysql_query("UPDATE `store_categories` SET `pageorder`='$count' WHERE `id` = '$pageid' ");
	$count += 1;
}
header ('Location: store.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




