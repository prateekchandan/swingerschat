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
$fileid = ($_GET['fileid']);
$filename = ($_GET['filename']);

$query = "DELETE FROM files WHERE id = $fileid";
$results = mysql_query($query);
unlink("../files/$filename");

header("Location: files.php");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




