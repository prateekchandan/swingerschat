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
$picid = ($_GET['picid']);
$filename = ($_GET['filename']);

$query = "DELETE FROM `product_option1_pics` WHERE id = $picid";
$results = mysql_query($query);
unlink("../productpics/$filename");
unlink("../productpics/thumbs/$filename");

header("Location: editproduct3.php?id=$productid");
exit;
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




