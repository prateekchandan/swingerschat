<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
<?php
$pic1 = ($_GET['pic1']);
$id = ($_GET['id']);

mysql_query("UPDATE `events_places` SET `photo`='noimage.jpg' WHERE `id` = '$id' ");

unlink("../eventplaces/$pic1");
unlink("../eventplaces/thumbs/$pic1");

header("Location: editeventplace.php?id=$id");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




