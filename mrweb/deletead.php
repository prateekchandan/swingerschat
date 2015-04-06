<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$adid = $_GET['adid'];
$photo = ($_GET['photo']);
$query = "DELETE FROM ads WHERE id = $adid";
$results = mysql_query($query);

unlink("../ADS/$photo");

header ("Location: adminhome.php");
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




