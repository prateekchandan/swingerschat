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

$template_id = ($_GET['id']);

$query = "DELETE FROM newsletter_templates WHERE id = $template_id";
$results = mysql_query($query);


header("Location: newsletter.php");
exit;
	

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




