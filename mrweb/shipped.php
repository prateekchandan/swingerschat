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
$orderid = ($_GET['orderid']);
$email = ($_GET['email']);

mysql_query("UPDATE `orders` SET `shipped`='1' WHERE `id` = '$orderid' ");

$result = mysql_query('SELECT email FROM members WHERE admin = 1');
$r = mysql_fetch_array($result);
$adminemail = ($r['email']);

mail ("$email", "Items Shipped","

We just wanted to let you know your items have been shipped.

Thank you for choosing $sitename!

","From: $adminemail");
	
header("Location: store.php");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




