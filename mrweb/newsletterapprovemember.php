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
$emailid = ($_GET['emailid']);
$email = ($_GET['email']);
	
$result = mysql_query("SELECT * FROM `newsletter` WHERE `email`= '$email' AND `id` != '$emailid'");
$rows = mysql_num_rows($result);
if ($rows > 0) {
	header("Location: newsletter.php?error=1");
	exit;
}

mysql_query("UPDATE `newsletter` SET `status` = '1', `message` = '' WHERE `id` = '$emailid' ");

header("Location: newsletter.php");
exit;
	




?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




