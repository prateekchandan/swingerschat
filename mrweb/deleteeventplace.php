<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$placeid = $_GET['id'];
$photo = $_GET['photo'];


$query = "DELETE FROM `events_places` WHERE `id` = '$placeid'";
$results = mysql_query($query);

unlink("../eventplaces/thumbs/$photo");
unlink("../eventplaces/$photo");

header ("Location: events.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




