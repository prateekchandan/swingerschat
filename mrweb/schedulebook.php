<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable" >

<?php
$cageid = $_GET['cageid'];
$productid = ($_GET['productid']);
$date = $_GET['date'];
$month = $_GET['month'];
$year = $_GET['year'];
$datestring = $month . "/" . $date . "/" . $year;
$datestring2 = strtotime($datestring);
$day = date('l',$datestring2);
$time = ($_GET['time']);

$sql="INSERT INTO booked (bartenderid, day, date, time) VALUES('$productid','$day','$datestring','$time')";
if (!mysql_query($sql,$dbc)) {
        header("Location: error.php");
        exit();
}

header ("Location: schedule2.php?month=$month&date=$date&year=$year&productid=$productid");
exit();

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




