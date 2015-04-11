<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$id = ($_GET['id']);
$optiontable = ($_GET['optiontable']);
$count = 0;
$newid = 0;
$productid2 = 0;
$newproductid2 = 0;

$result = mysql_query("SELECT * FROM `$optiontable` ORDER BY `id` DESC");
while (($r = mysql_fetch_array($result)) && ($count == 0)) {
	$newid = ($r['id']);
	if ($newid < $id) {
		$id2 = $newid;
		$newid2 = $id;
		$count = 1;
	}
}



if ($count == 1) {
	mysql_query("UPDATE `$optiontable` SET `id`='-1' WHERE `id` = '$id' ");
	mysql_query("UPDATE `$optiontable` SET `id`='-2' WHERE `id` = '$newid' ");
	mysql_query("UPDATE `$optiontable` SET `id`='$id2' WHERE `id` = '-1' ");
	mysql_query("UPDATE `$optiontable` SET `id`='$newid2' WHERE `id` = '-2' ");
	
}


header ("Location: store.php");
exit();



?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




