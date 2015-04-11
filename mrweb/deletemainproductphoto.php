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
$productid = ($_GET['productid']);
$pic1 = ($_GET['pic1']);

mysql_query("UPDATE `products` SET `pic1`='noimage.jpg' WHERE `id` = '$productid' ");

unlink("../productpics/$pic1");
unlink("../productpics/thumbs/$pic1");

header("Location: editproduct3.php?id=$productid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




