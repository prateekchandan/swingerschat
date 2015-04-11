<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$id = $_GET['id'];


$query = "DELETE FROM `store_subcategories` WHERE id = $id";
$results = mysql_query($query);

$count = 1;
$result = mysql_query("SELECT * FROM `store_subcategories` ORDER BY pageorder ASC");
while ($r = mysql_fetch_array($result)) {
	$pageid = ($r['id']);
	$ordernumber = ($r['pageorder']);
	mysql_query("UPDATE `store_subcategories` SET `pageorder`='$count' WHERE `id` = '$pageid' ");
	$count += 1;
}

$result = mysql_query("SELECT * FROM `products` WHERE `subcategory` = '$id'");
while ($r = mysql_fetch_array($result)) {
	$productid = ($r['id']);	
	mysql_query("UPDATE `products` SET `subcategory`='' WHERE `id` = '$productid' ");
}

header ('Location: store.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




