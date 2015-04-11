<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<?php
session_start();
unset ($_SESSION);
session_destroy();
header("Location: index.php?message=1");
exit;
?>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




