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

$subject = mysql_real_escape_string($_POST['subject']);	

mysql_query("UPDATE `newsletter_subject` SET `subject`='$subject' ");

header("Location: newsletter.php?message=1");
exit;
	

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




