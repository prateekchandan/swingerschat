<?php
require ('includes/dbconnect.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='text2' colspan='2'>
    <div class='div2'>
    <?php echo"$text1"; ?>
    </div>
    </td>
    </tr>
    
    <tr>
	<td class='text3'>
    <div class='div3'>
    <?php
	$tablename = "ServiceCategories_" . $pageid;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
		while ($r = mysql_fetch_array($result)) {
			$categoryid = ($r['id']);
			$category = ($r['name']);
			$categoryorder = ($r['fieldorder']);
			echo"<a href='faq.php?serviceid=$categoryid&id=$pageid'>$category</a> <br />";
		}
		
	?>
    </div>
    </td>
    
    <td class='text4'>
    <div class='div4'>
    <?php
	$tablename2 = "Services_" . $pageid;
	
	if (isset($_GET['serviceid'])) {
		$serviceid = ($_GET['serviceid']);
		$result2 = mysql_query("SELECT * FROM `$tablename2` WHERE `category`='$serviceid' ORDER BY `fieldorder` ASC");	
	} else {
		$result2 = mysql_query("SELECT * FROM `$tablename2` ORDER BY `fieldorder` ASC LIMIT 1");	
	}
	
	
	while ($r2 = mysql_fetch_array($result2)) {
		$serviceid = ($r2['id']);
		$servicename = ($r2['name']);
		$servicecategory = ($r2['category']);
		$serviceorder = ($r2['fieldorder']);
		
		$result = mysql_query("SELECT * FROM `$tablename` WHERE `id`='$servicecategory'");
		$r = mysql_fetch_array($result);
		$category = ($r['name']);
		echo"<strong>$category</strong> <br /><br /> $servicename";
		
	}


		
	?>
    </div>
    </td>
    </tr>
	</table>
</td>
</tr>
<?php
require ('includes/footer.php');
?>
</table>
</body>
</html>

<?php
ob_end_flush();
?>
