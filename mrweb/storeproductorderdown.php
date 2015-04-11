<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$productid = ($_GET['productid']);
$categoryid = ($_GET['categoryid']);
$category = ($_GET['category']);
$count = 0;
$newproductid = 0;
$productid2 = 0;
$newproductid2 = 0;

$result = mysql_query("SELECT * FROM `products` WHERE `category` = '$categoryid' ORDER BY `id` ASC");
while (($r = mysql_fetch_array($result)) && ($count == 0)) {
	$newproductid = ($r['id']);
	if ($newproductid > $productid) {
		$productid2 = $newproductid;
		$newproductid2 = $productid;
		$count = 1;
	}
}

$foldername1 = "../productpics/ProductGallery_" . $productid;
$foldername2 = "../productpics/ProductGallery_" . $newproductid;
$tempfoldername1 = "../productpics/ProductGallery_4";
$tempfoldername2 = "../productpics/ProductGallery_5";

$tablename1 = "ProductGallery_" . $productid;
$tablename2 = "ProductGallery_" . $newproductid;
$temptablename1 = "ProductGallery_4";
$temptablename2 = "ProductGallery_5";

if ($count == 1) {
	mysql_query("UPDATE `products` SET `id`='4' WHERE `id` = '$productid' ");
	mysql_query("UPDATE `products` SET `id`='5' WHERE `id` = '$newproductid' ");
	mysql_query("UPDATE `products` SET `id`='$productid2' WHERE `id` = '4' ");
	mysql_query("UPDATE `products` SET `id`='$newproductid2' WHERE `id` = '5' ");
	rename("$foldername1", "$tempfoldername1");
	rename("$foldername2", "$tempfoldername2");
	rename("$tempfoldername1", "$foldername2");
	rename("$tempfoldername2", "$foldername1");
	mysql_query("RENAME TABLE $tablename1 TO $temptablename1");
	mysql_query("RENAME TABLE $tablename2 TO $temptablename2");
	mysql_query("RENAME TABLE $temptablename1 TO $tablename2");
	mysql_query("RENAME TABLE $temptablename2 TO $tablename1");
} else {
	$count = 1;
	$done = 0;
	while (($count < $productid) && ($done == 0)) {
		$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$count'");
		$rows = mysql_num_rows($result);
		if ($rows < 1) {
			mysql_query("UPDATE `products` SET `id`='$count' WHERE `id` = '$productid' ");
			$newfoldername = "../productpics/ProductGallery_" . $count;
			rename("$foldername1", "$newfoldername");
			$newtablename = "ProductGallery_" . $count;
			mysql_query("RENAME TABLE $tablename1 TO $newtablename");
			$done = 1;
		}
		$count += 1;
	}
}


header ("Location: editproduct2.php?categoryid=$categoryid&category=$category");
exit();



?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




