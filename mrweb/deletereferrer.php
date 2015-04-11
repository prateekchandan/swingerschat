<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<?php
$referrerid = $_GET['referrerid'];
$tablename = $_GET['tablename'];

$query = "DELETE FROM $tablename WHERE id = $referrerid";
$results = mysql_query($query);

header("Location: hitcounter.php");
exit;
?>



</td>
</tr>


<?php
require ('includes/footer.php');
?>




