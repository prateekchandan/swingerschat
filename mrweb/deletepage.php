<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$pageid = $_GET['pageid'];
$pagetype = ($_GET['pagetype']);
$result = mysql_query("SELECT * FROM `pages` WHERE `id` = '$pageid'");
$r = mysql_fetch_array($result);
$deletable = ($r['deletable']);

if ($deletable == "0") {
	header ('Location: adminhome.php?message=6');
	exit();
}

$query = "DELETE FROM pages WHERE id = $pageid";
$results = mysql_query($query);


if ($pagetype == "Album Page") {
	$tablename = "Album_" . $pageid;
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
}


if ($pagetype == "Photo Gallery") {
	$tablename = "Gallery_" . $pageid;
	$result = mysql_query("SELECT * FROM $tablename");
	while ($r = mysql_fetch_array($result)) {
		$id = ($r['id']);
		$filename = ($r['filename']);
		unlink("../$tablename/$filename");
		unlink("../$tablename/thumbs/$filename");
	}
	rmdir('../'.$tablename.'/thumbs');
	rmdir('../'.$tablename);
	
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
}

if ($pagetype == "Contact Form") {
	$tablename = "Contact_" . $pageid;
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
}

if ($pagetype == "Service Page") {
	$tablename = "ServiceCategories_" . $pageid;
	$tablename2 = "Services_" . $pageid;
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
	$query ="DROP TABLE $tablename2";
	$results = mysql_query($query);
}

if ($pagetype == "Profile Page") {
	$tablename = "Profile_" . $pageid;
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
}

if ($pagetype == "Dropdown Menu") {
	$tablename = "Dropdown_" . $pageid;
	$query ="DROP TABLE $tablename";
	$results = mysql_query($query);
}

$tablename = "HitCounter_". $pageid;
$query ="DROP TABLE $tablename";
$results = mysql_query($query);

$tablename = "HitCounterRef_". $pageid;
$query ="DROP TABLE $tablename";
$results = mysql_query($query);


$count = 1;
$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
while ($r = mysql_fetch_array($result)) {
	$pageid = ($r['id']);
	$ordernumber = ($r['pageorder']);
	mysql_query("UPDATE `pages` SET `pageorder`='$count' WHERE `id` = '$pageid' ");
	$count += 1;
}
header ('Location: adminhome.php');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




