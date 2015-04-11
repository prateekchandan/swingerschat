<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$categoryid = ($_GET['categoryid']);

	
mysql_query("UPDATE `products` SET `id`='$productid2' WHERE `id` = '$productid' ");
mysql_query("UPDATE `products` SET `id`='$newproductid2' WHERE `id` = '$newproductid' ");
	


header ("Location: editproduct2.php?categoryid=$categoryid");
exit();



?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




