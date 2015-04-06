<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$blogid = $_GET['blogid'];
$commentid = $_GET['commentid'];
$tablename = "Blog_" . $blogid;

$query = "DELETE FROM `blogcomments` WHERE `id` = $commentid";
$results = mysql_query($query);

$query = "DELETE FROM `blogcomments` WHERE `reply` = $commentid";
$results = mysql_query($query);

header ("Location: editblogcomments.php?blogid=$blogid");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




