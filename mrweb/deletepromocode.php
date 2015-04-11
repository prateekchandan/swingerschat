<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$ghostid = $_GET['promoid'];

$query = "DELETE FROM `promocodes` WHERE `id` = '$ghostid'";
$results = mysql_query($query);

header ("Location: store.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




