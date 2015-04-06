<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable" >

<?php
$cageid = $_GET['cageid'];
$date = $_GET['date'];
$month = $_GET['month'];
$year = $_GET['year'];

$query = "DELETE FROM booked WHERE id = $cageid";
$results = mysql_query($query);

header ("Location: schedule2.php?month=$month&date=$date&year=$year&productid=$productid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




