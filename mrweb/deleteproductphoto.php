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
$photoid = ($_GET['photoid']);
$tablename = ($_GET['tablename']);
$productid = ($_GET['productid']);

$query = "DELETE FROM `$tablename` WHERE `id` = '$photoid'";
$results = mysql_query($query);
unlink("../productpics/$tablename/$filename");
unlink("../productpics/$tablename/thumbs/$filename");

header("Location: editproduct3.php?id=$productid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




