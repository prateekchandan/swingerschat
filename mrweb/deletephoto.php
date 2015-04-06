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
$pageid = ($_GET['pageid']);
$filename = ($_GET['filename']);

$query = "DELETE FROM $tablename WHERE id = $photoid";
$results = mysql_query($query);
unlink("../$tablename/$filename");
unlink("../$tablename/thumbs/$filename");

header("Location: editpage.php?pageid=$pageid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




