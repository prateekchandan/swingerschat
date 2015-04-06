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

$list_id = ($_GET['id']);

$query = "DELETE FROM newsletter_lists WHERE id = $list_id";
$results = mysql_query($query);

$tablename = "newsletter_list_" . $list_id;

$query ="DROP TABLE $tablename";
$results = mysql_query($query);


header("Location: newsletter.php");
exit;
	

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




