<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">
<?php
$memberid = $_GET['memberid'];
$foldername = "member_" . $memberid;

$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r = mysql_fetch_array($result);
$photo = ($r['photo']);
unlink("../members/$foldername/$photo");
unlink("../members/$foldername/thumbs/$photo");

$query = "DELETE FROM members WHERE id = $memberid";
$results = mysql_query($query);

$newtable = "MemberComments" . "_" . $memberid;
$query ="DROP TABLE $newtable";
$results = mysql_query($query);

$newtable = "MemberFriends" . "_" . $memberid;
$query ="DROP TABLE $newtable";
$results = mysql_query($query);

$newtable = "MemberMessages" . "_" . $memberid;
$query ="DROP TABLE $newtable";
$results = mysql_query($query);

$newtable = "MemberGallery" . "_" . $memberid;
$result = mysql_query("SELECT * FROM `$newtable`");
while ($r = mysql_fetch_array($result)) {
	$id = ($r['id']);
	$filename = ($r['filename']);
	
	unlink("../members/$foldername/$filename");
	unlink("../members/$foldername/thumbs/$filename");

	$newertable = "MemberGallery" . "_" . $memberid . "_" . $id;
	$query ="DROP TABLE $newertable";
	$results = mysql_query($query);
}
rmdir('../members/'.$foldername.'/thumbs');
rmdir('../members/'.$foldername);
$query ="DROP TABLE $newtable";
$results = mysql_query($query);

$query ="DROP TABLE $foldername";
$results = mysql_query($query);

header ('Location: adminhome.php?message=8');
exit();

?>
</td>
</tr>


<?php
require ('includes/footer.php');
?>




