<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<?php
$tablename = $_GET['tablename'];

$result = mysql_query("SELECT * FROM $tablename");
while ($r=mysql_fetch_array($result)) {
	$referrerid = ($r['id']);
	$query = "DELETE FROM $tablename WHERE id = $referrerid";
	$results = mysql_query($query);
}

header("Location: hitcounter.php");
exit;
?>



</td>
</tr>


<?php
require ('includes/footer.php');
?>




