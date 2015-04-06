<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$ghostid = $_GET['ghostid'];
$productid = $_GET['productid'];


$query = "DELETE FROM `products` WHERE `id` = '$ghostid'";
$results = mysql_query($query);

header ("Location: editproduct3.php?id=$productid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




