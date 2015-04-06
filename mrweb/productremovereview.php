<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$rid = $_GET['rid'];

$query = "DELETE FROM `productreviews` WHERE `id` = '$rid'";
$results = mysql_query($query);


header ("Location: productreviews.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




