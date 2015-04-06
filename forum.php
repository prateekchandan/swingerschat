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
	<table align="center" cellpadding="0px" cellspacing="0px" width="850px">
    <tr>
    <td class='text6' colspan='2'>
    <div class='div6'>
    <?php
	echo"<strong>Choose a category</strong><br /><br />"; 
	?>
		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
	<?php
		echo"
		<tr>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		CATEGORY
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		TOTAL POSTS
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; background-color:#F7F7F7;'>
		LAST POST
		</td>
		</tr>";
		
	$result = mysql_query("SELECT * FROM `F_Categories` ORDER BY `name` ASC");
	while ($r = mysql_fetch_array($result)) {	
		$categoryid = ($r['id']);
		$name = ($r['name']);
		$tablename = "F_" . $categoryid;
		$result2 = mysql_query("SELECT * FROM `$tablename` ORDER BY `lastpost` DESC");
		$rows2 = mysql_num_rows($result2);
		$r2 = mysql_fetch_array($result2);
		$lastpost = ($r2['lastpost']);
		echo"
		<tr>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;'>
		<a href=\"forum2.php?categoryid=$categoryid\">$name</a>
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;'>
		$rows2
		</td>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;'>
		$lastpost
		</td>
		</tr>";
	}
		echo"</table>";
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
