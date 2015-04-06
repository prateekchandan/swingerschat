<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$id = $_GET['id'];
$tablename = "Events_" . $id;

$query = "DELETE FROM `events` WHERE id = $id";
$results = mysql_query($query);

$query ="DROP TABLE $tablename";
$results = mysql_query($query);

header ("Location: events.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




