<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$rid = $_GET['rid'];

mysql_query("UPDATE `productreviews` SET `approved`='1' WHERE `id` = '$rid' ");


header ("Location: productreviews.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




