<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$blogid = $_GET['blogid'];
$query = "DELETE FROM blog WHERE id = $blogid";
$results = mysql_query($query);

$tablename = "Blog_" . $blogid;
$query ="DROP TABLE $tablename";
$results = mysql_query($query);

$query = "DELETE FROM `blogcomments` WHERE `id` = $blogid";
$results = mysql_query($query);


header ('Location: adminhome.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




