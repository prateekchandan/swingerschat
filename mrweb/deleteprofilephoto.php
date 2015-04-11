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
$pageid = ($_GET['pageid']);
$tablename = ($_GET['tablename']);
$fieldid = ($_GET['fieldid']);
$pic = ($_GET['pic']);

mysql_query("UPDATE `$tablename` SET `pic`= 'noimage.jpg' WHERE `id` = '$fieldid' ");

unlink("../profilepics/$pic");
unlink("../profilepics/thumbs/$pic");

header("Location: editprofile.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




