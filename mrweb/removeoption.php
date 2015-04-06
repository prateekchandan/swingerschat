<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$optionid = $_GET['optionid'];
$productid = $_GET['productid'];
$option = $_GET['option'];

$table = "product_option" . $option . "_list";

$query = "DELETE FROM `$table` WHERE `id` = '$optionid'";
$results = mysql_query($query);

header ("Location: editproduct3.php?id=$productid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




