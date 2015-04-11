<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$optiontable = $_GET['optiontable'];
$id = ($_GET['id']);
$query = "DELETE FROM $optiontable WHERE id = $id";
$results = mysql_query($query);


header ("Location: store.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




