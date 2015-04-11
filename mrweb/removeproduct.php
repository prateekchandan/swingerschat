<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$productid = $_GET['id'];
$url = ($_GET['url']);


$query = "DELETE FROM `products` WHERE `id` = '$productid'";
$results = mysql_query($query);

$tablename = "ProductGallery_" . $productid;

$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$id'");
$r = mysql_fetch_array($result);
$pic1 = ($r['pic1']);
if ($pic1 != "noimage.jpg") {
	unlink("../productpics/$pic1");
	unlink("../productpics/thumbs/$pic1");
}

$result = mysql_query("SELECT * FROM $tablename");
while ($r = mysql_fetch_array($result)) {
	$filename = ($r['filename']);
	unlink("../productpics/$tablename/$filename");
	unlink("../productpics/$tablename/thumbs/$filename");
}
rmdir('../productpics/'.$tablename.'/thumbs');
rmdir('../productpics/'.$tablename);

$query ="DROP TABLE $tablename";
$results = mysql_query($query);

header ("Location: $url");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




