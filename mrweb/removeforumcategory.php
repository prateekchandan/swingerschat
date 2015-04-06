<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$categoryid = $_GET['id'];

$tablename = "F_" . $categoryid;
$result = mysql_query("SELECT * FROM `$tablename`");
$rows = mysql_num_rows($result);
if ($rows > 0) {
	while ($r = mysql_fetch_array($result)) {	
		$postid = ($r['id']);
		$tablename2 = "F_" . $categoryid . "_" . $postid;
		$result2 = mysql_query("SELECT * FROM `$tablename2`");
		$rows2 = mysql_num_rows($result2);
		if ($rows2 > 0) {
			$query ="DROP TABLE $tablename2";
			$results = mysql_query($query);
		}
	}
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
}

$query = "DELETE FROM `F_Categories` WHERE id = $categoryid";
$results = mysql_query($query);

header ('Location: forum.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




