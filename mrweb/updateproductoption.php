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
$producttable = ($_POST['optiontable']);
$name = ($_POST['name']);
$id = ($_POST['id']);

mysql_query("UPDATE `$producttable` SET `name`= '$name' WHERE `id` = '$id' ");

header("Location: store.php");
exit;
?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




