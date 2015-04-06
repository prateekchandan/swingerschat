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
$blogid = ($_GET['blogid']);
$pic1 = ($_GET['pic1']);

mysql_query("UPDATE `blog` SET `picture`='noimage.jpg' WHERE `id` = '$blogid' ");

unlink("../articlepictures/$pic1");

header("Location: editblogentry.php?blogid=$blogid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




