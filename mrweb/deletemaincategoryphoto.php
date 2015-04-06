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
$pic2 = ($_GET['pic2']);
$tablename = ($_GET['tablename']);
$categoryid = ($_GET['categoryid']);

mysql_query("UPDATE `store_categories` SET `mainimage`='noimage.jpg' WHERE `id` = '$categoryid' ");

unlink("../categories_main/$pic2");

header("Location: editstorecategory.php?id=$categoryid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




